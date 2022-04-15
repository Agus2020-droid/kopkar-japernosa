<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\PengambilanModel;
use App\Exports\PengambilanExport;
use Maatwebsite\Excel\facades\Excel;
use App\Models\PinjamanModel;
use App\Models\SimpananModel;
use App\Models\UsersModel;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use App\Notifications\RepliedToThread;
use App\Imports\PenarikanImport;

class PengambilanController extends Controller

{
    public function __construct()
    {
        $this->PengambilanModel = new PengambilanModel();
        $this->middleware('auth');
    }
    
    public function index()
    {
       $pengambilan = PengambilanModel::orderBy('tgl_pengambilan','desc')
       ->join('pegawai','pengambilan.nik_ktp','=','pegawai.nik_ktp')
       ->get(); 

       return view('v_pengambilanSimpanan', compact('pengambilan'));
    }

    public function indexKetua()
    {
        $pengambilan = PengambilanModel::orderBy('tgl_pengambilan','desc')
        ->join('pegawai','pengambilan.nik_ktp','=','pegawai.nik_ktp')
        ->get(); 
       return view('v_pengambilanSimpananKetua', compact('pengambilan'));
    }

    public function indexBendahara()
    {
        $pengambilan = PengambilanModel::orderBy('tgl_pengambilan','desc')
        ->join('pegawai','pengambilan.nik_ktp','=','pegawai.nik_ktp')
        ->get(); 
       return view('v_pengambilanSimpananBendahara',compact('pengambilan'));
    }

    public function cetakPengambilan($id_pengambilan)
    {
        $pengambilan = $this->PengambilanModel->allData()
        ->where('id_pengambilan', $id_pengambilan); 

        //return $pengambilan;
       return view('v_cetakPengambilan', compact('pengambilan'));
    }
    

    public function pegawai() {
        return $this->belongsTo(Pegawai::class);
     }

     public function pengambilanSaya($nik_ktp)
    {
    //    $data = [
    //        'simpanan' => $this->SimpananModel->allData(),
        
    //    ];
        $user = UsersModel::where('nik_ktp',$nik_ktp)->get();
        $pegawai = Pegawai::where('nik_ktp',$nik_ktp)->get();
        $pengambilan = PengambilanModel::where('nik_ktp',$nik_ktp)->get();
        $jml_pengambilan = PengambilanModel::where('nik_ktp',$nik_ktp)->sum('jumlah_pengambilan');
       //dd ($user,$pegawai,$pengambilan,$jml_pengambilan);
       return view('v_pengambilanSaya',  compact(['pegawai','user','pengambilan','jml_pengambilan']));
    }

    public function tambahpengambilan($nik_ktp) {
        //$pegawai = Pegawai::find($nik_ktp);
        $pengambilan = PengambilanModel::where('nik_ktp',$nik_ktp)->get();
        $pegawai = Pegawai::where('nik_ktp',$nik_ktp)->get();
        $simp_pokok = SimpananModel::where('nik_ktp',$nik_ktp)->sum('simpanan_pokok');
        $simp_wajib = SimpananModel::where('nik_ktp',$nik_ktp)->sum('simpanan_wajib');
        $simp_sukarela = SimpananModel::where('nik_ktp',$nik_ktp)->sum('simpanan_sukarela');
        $ambil_pokok = PengambilanModel::where('nik_ktp',$nik_ktp)->sum('simpanan_pokok');
        $ambil_wajib = PengambilanModel::where('nik_ktp',$nik_ktp)->sum('simpanan_wajib');
        $ambil_sukarela = PengambilanModel::where('nik_ktp',$nik_ktp)->sum('simpanan_sukarela');
   
        // dd ($pengambilan);
        return view('v_tambahPengambilan', compact('pegawai','simp_pokok','simp_wajib','simp_sukarela','ambil_pokok','ambil_wajib','ambil_sukarela','pengambilan'));
    }

    public function store(Request $request)
    {
        $users = User::all()
        ->whereIn('level',[2, 6, 5]);

        Request()->validate([
            'nik_ktp' => 'required',
            'jumlah_pengambilan' => 'required',
            'paklaring' => 'mimes:jpg,jpeg,bmp,png|max:2000',
        ],[
            'nik_ktp.required'=>'Tidak boleh kosong !!!',
            'jumlah_pengambilan.required'=>'Field tidak boleh kosong !!!',
            'paklaring.required'=>'File tidak boleh kosong !!!',
            'paklaring.mimes'=>'file harus berekstensi jpg,jpeg,bmp,png !!!',
            'paklaring.max'=>'maksimal ukuran 2mb !!!',

        ]);


        if (Request()->paklaring<>"") {
            //jika ingin ganti foto
        $file = Request()->paklaring;
        $filename = Request()->nik_ktp.'.'. $file->extension();
        // $request->file('foto_paklaring')->save('public/foto_paklaring/',$filename);
        // $file->move(public_path('foto_paklaring'), $filename);   
        $file->move(public_path('storage/foto_paklaring'), $filename);
        $request = [
            'id_user' => Request()->id_user,
            'id_pengambilan' => Request()->id_pengambilan,
            'nik_ktp' => Request()->nik_ktp,
            'simpanan_pokok' => Request()->simpanan_pokok,
            'simpanan_wajib' => Request()->simpanan_wajib,
            'simpanan_sukarela' => Request()->simpanan_sukarela,
            'jumlah_pengambilan' => Request()->jumlah_pengambilan,
            'notifikasi' => Request()->notifikasi,
            'paklaring' => $filename,
        ];
        $this->PengambilanModel->tambahPengambilan($request);
        } else {
            $request = [
                'id_user' => Request()->id_user,
                'id_pengambilan' => Request()->id_pengambilan,
                'nik_ktp' => Request()->nik_ktp,
                'simpanan_pokok' => Request()->simpanan_pokok,
                'simpanan_wajib' => Request()->simpanan_wajib,
                'simpanan_sukarela' => Request()->simpanan_sukarela,
                'jumlah_pengambilan' => Request()->jumlah_pengambilan,
                'notifikasi' => Request()->notifikasi,
            ];
            $this->PengambilanModel->tambahPengambilan($request);
        }
        Notification::send($users, new RepliedToThread($request));
        return redirect('pengambilanSaya/'.auth()->user()->nik_ktp)->with('success', 'Selamat, pengajuan penarikan dana simpanan anda berhasil dikirim! ');
    }

    public function editPengambilan($id_pengambilan)
    {
        $pengambilan = PengambilanModel::where('id_pengambilan',$id_pengambilan)
        ->join('pegawai','pengambilan.nik_ktp','=','pegawai.nik_ktp')
        ->get();
       
        return view('v_editPengambilan', compact('pengambilan'));
    }

    public function editPengambilanKetua($id_pengambilan)
    {
        // $id_user = PengambilanModel::where('id_pengambilan',$id_pengambilan)
        // ->pluck('id_user');
        
        // $users = User::whereIn('id', $id_user)
        // ->first();

        $pengambilan = PengambilanModel::where('id_pengambilan',$id_pengambilan)
        ->join('pegawai','pengambilan.nik_ktp','=','pegawai.nik_ktp')
        ->get();

        // dd($users);
        return view('v_editPengambilanKetua', compact('pengambilan'));
    }

    public function editPengambilanBendahara($id_pengambilan)
    {
        $pengambilan = PengambilanModel::where('id_pengambilan',$id_pengambilan)
        ->join('pegawai','pengambilan.nik_ktp','=','pegawai.nik_ktp')
        ->get();

        // dd($users);
        return view('v_editPengambilanBendahara', compact('pengambilan'));
    }

    public function update($id_pengambilan)
    {
        $data = [
          
            'status_pengajuan' => Request()->status_pengajuan,
        ];
        $this->PengambilanModel->editPengambilan($id_pengambilan, $data);
        return redirect('/pengambilan')->with('pesan', 'Sukses, pengajuan penarikan dana simpanan anda berhasil diupdate!, Cek !! ');
    }

    public function updatePengambilanKetua(Request $request, $id_pengambilan)
    {
        $id_user = PengambilanModel::where('id_pengambilan',$id_pengambilan)
        ->pluck('id_user');
        

        $users = user::where('id',$id_user)
        ->orWhereIn('level',[2,6])
        ->get();

        $request = [
            'ttd_ketua' => Request()->ttd_ketua,
            'tgl_disetujui_ketua' => Request()->tgl_disetujui_ketua,
            'disetujui_ketua' => Request()->disetujui_ketua,
            'notifikasi' => Request()->notifikasi,
        ];
        $this->PengambilanModel->editPengambilan($id_pengambilan, $request);
        Notification::send($users, new RepliedToThread($request));
        return redirect('/pengambilanKetua')->with('pesan', 'Sukses, pengajuan penarikan dana simpanan anda berhasil diupdate!, Cek !! ');
    }

    public function updatePengambilanBendahara(Request $request, $id_pengambilan)
    {
        $id_user = PengambilanModel::where('id_pengambilan',$id_pengambilan)
        ->pluck('id_user');
        
        $users = user::where('id',$id_user)
        ->orWhereIn('level',[2,5])
        ->get();

        $request = [
            'ttd_bendahara' => Request()->ttd_bendahara,
            'tgl_disetujui_bendahara' => Request()->tgl_disetujui_bendahara,
            'disetujui_bendahara' => Request()->disetujui_bendahara,
            'notifikasi' => Request()->notifikasi,
        ];
        $this->PengambilanModel->editPengambilan($id_pengambilan, $request);
        Notification::send($users, new RepliedToThread($request));
        return redirect('/pengambilanBendahara')->with('pesan', 'Sukses, pengajuan penarikan dana simpanan anda berhasil diupdate!, Cek !! ');
    }

    public function delete($id_pengambilan) 
    {
        $pengambilan= $this->PengambilanModel->detailData($id_pengambilan);
        $this->PengambilanModel->deletePengambilan($id_pengambilan);
        return redirect()->route('v_pengambilanSimpanan')->with('status', 'Data Berhasil Dihapus !!!');
    }

    public function deletePengambilan($id_pengambilan) 
    {
        $pengambilan= $this->PengambilanModel->detailData($id_pengambilan);
        $this->PengambilanModel->deletePengambilan($id_pengambilan);
        return back()->with('success', "Data Berhasil Dihapus !!!");
    }

    public function pengambilanexport() {
        return Excel::download(new PengambilanExport,'Pengambilan.xlsx');
    }

    public function penarikanimportexcel(Request $request) {
        // validasi
		$this->validate($request, [
			'file' => 'required|mimes:xls,xlsx'
		]);
        $import = new PenarikanImport;
        $file = $request->file('file');
        $namaFile = date(date('d-m-Y')).$file->getClientOriginalName();
        $import->import($file);
        $file->move('storage/DataPenarikan', $namaFile);
        

        return back()->with('success','Data berhasil di import');
    }
}