<?php

namespace App\Http\Controllers;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use App\Models\UsersModel;
use App\Models\Pegawai;
use Illuminate\Support\Str;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Hash;
use Auth;
use Image;
class UsersController extends Controller
{
    public function __construct()
    {
        $this->UsersModel = new UsersModel();
        $this->middleware('auth');
    }

    public function index()
    {
        $users = UsersModel::orderBy('last_seen','desc')
        ->get();
        
        // dd($users);
        return view('v_users', compact('users'));
    }

        /**
     * Show user online status.
     */
    public function userOnlineStatus()
    {
        $users = UsersModel::all();
        foreach ($users as $user) {
            if (Cache::has('user-is-online-' . $user->id))
                echo $user->name . " is online. Last seen: " . Carbon::parse($user->last_seen)->diffForHumans() . " <br>";
            else
                echo $user->name . " is offline. Last seen: " . Carbon::parse($user->last_seen)->diffForHumans() . " <br>";
        }
    }

   
    public function updateProfile(Request $request)
    {
        if($request->hasFile('foto_user')) {
            $nik = Auth::user()->nik_ktp;
            $fotouser =  $request->file('foto_user');
            $filename = $nik.'.'.$fotouser->getClientOriginalExtension();
            $request->file('foto_user')->storeAs('public/foto_user/',$filename);
            Image::make($fotouser)->resize(300,300);
            // Image::make($fotouser)->resize(300,300)->move( public_path('foto_user/'. $filename));

            $user = Auth::user();
            $user->foto_user = $filename;
            $user->save();
        }
        // return view('v_editProfile', array('user' => Auth::user()) );
        return back()->with('message','Foto profile berhasil diganti');
    }


    public function ubahPassword($id) {  
        if (!$this->UsersModel->detailData($id)) {
            abort(404);
        }
        $data = [
            'users' => $this->UsersModel->detailData($id), 
        ];
 
        // dd ($decrypted);
        return view('v_editPassword', $data);
    }

    public function updatePassword(Request $request) {  
       
       $request->validate([
           'old_password'=> 'required',
           'password' => ['required', 'string', 'min:8', 'confirmed'],
           
       ]);
       
       $currentPassword = auth()->user()->password;
       $old_password = request('old_password');
       
       if (Hash::check($old_password, $currentPassword)) {
           auth()->user()->update([
               'password' => bcrypt(request('password')),
           ]);
           return back()->with('message',"Password Anda berhasil diubah");
       } else {
           return back()->with('alert', "Password Anda gagal di ubah");
       }
   
    
    }

    public function edit($id) {  
        if (!$this->UsersModel->detailData($id)) {
            abort(404);
        }
        $data = [
            'users' => $this->UsersModel->detailData($id), 
        ];
        return view('v_editusers', $data);
    }

    public function update($id) {
        Request()->validate([ 
            'name' => 'required',
            'telp' => 'required',
            'email' => 'required|email',
        ],[
            'name.required'=>'Nama tidak boleh kosong !!!',
            'email.required'=>' Email tidak boleh kosong !!!',
            'email.email'=>'email tidak valid',
            'telp.required'=>'Nomor telepon harus diisi',
        ]);
        $data = [
            'name' => Request()->name,
            'email' => Request()->email,
            'level' => Request()->level,
            'telp' => Request()->telp,
        ];
       
            $this->UsersModel->editUsers($id, $data);
    
        return redirect('/users')->with('message', 'User berhasil diupdate !!!');
    }

    public function export() 
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

   

    public function store(Request $request) 
    {
        Excel::import(new UsersImport, $request->file('excel'));
        
        return redirect()->back(0);
    }

    public function registrasi()
    {
        $pegawai['data'] = Pegawai::orderBy('nama','asc')
        ->select('nik_ktp','nama')
        ->get();
        // $pegawai = Pegawai::all();
        // dd ($pegawai); 
        return view('v_registerUser', compact('pegawai'));

    }

    public function getnamaUser($nikId=0){
     // Fetch Employees by Departmentid
     $namaData['data'] = Pegawai::orderby("nama","asc")
        ->select('nik_ktp','nama','nik_karyawan')
        ->where('nik_ktp',$nikId)
        ->get();

     return response()->json($namaData);

   }

    public function simpanregistrasi(Request $request)
    {
        // dd($request->all());
            Request()->validate([
                'nik_ktp' => 'required|unique:users',
                'name' => 'required',
                'email' => 'required|unique:users|email',
                'password' => ['required', 'string', 'min:8'],
                'nik_karyawan' => 'required|unique:users',
                'telp' => 'required|unique:users',
            ],[
                'nik_ktp.required'=>'NIK tidak boleh Kosong !!!',
                'nik_ktp.unique'=>'NIK KTP sudah terdaftar !!!',
                'name.required'=>'Nama tidak boleh Kosong !!!',
                'email.required'=>'Email tidak boleh Kosong !!!',
                'email.unique'=>'Email sudah ada!!',
                'email.email'=>'email tidak valid!!',
                'password.required'=>'Password tidak boleh Kosong !!!',
                'password.min'=>'Password minimal 8 karakter !!!',
                'nik_karyawan.required'=>'Nik Karyawan tidak boleh kosong !!!',
                'nik_karyawan.unique'=>'NIK karyawan sudah ada !!!',
                'telp.required'=>'nomor telepon tidak boleh kosong !!!',
                'telp.unique'=>'Nomor telepon yang anda masukan sudah ada !!!',
            ]);
        UsersModel::create([
            'nik_ktp' => $request->nik_ktp,
            'name' => $request->name,
            'level' => '3',
            'email' => $request->email,
            'nik_karyawan' => $request->nik_karyawan,
            'telp' => $request->telp,
            'password' => bcrypt($request->password),
            'remember_token' => Str::random(60),
        ]);
        return redirect('/users')->with('success', '1 User Berhasil Ditambahkan !!!');
    }
    
    public function delete($id) 
    {
        $user= $this->UsersModel->detailData($id);
        $this->UsersModel->deleteUsers($id);
        return redirect()->route('v_users')->with('success', 'User Berhasil Dihapus !!!');
    }

    public function usersimportexcel(Request $request) {
        // validasi
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
        $import = new UsersImport;
        $file = $request->file('file');
        $namaFile = date(date('d-m-Y')).$file->getClientOriginalName();
        $import->import($file);
        $file->move('storage/DataUsers', $namaFile);
        return back()->with('success','File Excel berhasil diimpor');
    }
}
