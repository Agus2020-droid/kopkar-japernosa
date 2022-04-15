<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Exports\PegawaiExport;
use App\Imports\PegawaiImport;
use Excel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Spatie\Permission\Traits\HasRoles;
use App\Http\Requests\CreatePegawaiRequest;
class PegawaiController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->Pegawai = new Pegawai();
        $this->middleware('auth');
    }
    // public function index()
    // {
    //     $pegawai = Pegawai::get();
    //     return view('v_pegawai',compact('pegawai'));
    //    // $data = [
    //     //    'pegawai' => $this->Pegawai->allData(), 
    //     //];
    //    // return view('v_pegawai', $data);
    // }

    public function tambah()
    {
      
        // dd($id_peg);
        return view('v_tambahpegawai');
    }
    
    public function pegawaiexport() {
        return Excel::download(new PegawaiExport,'Pegawai.xlsx');
    }

    public function pegawaiimportexcel(Request $request) {
        // validasi
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
        $import = new PegawaiImport;
        $file = $request->file('file');
        $namaFile = date(date('d-m-Y')).$file->getClientOriginalName();
        $import->import($file);
        $file->move('storage/DataPegawai', $namaFile);
        
        
        // $file = $request->file('file');
        // $namaFile = $file->getClientOriginalName();
        // $file->move('DataPegawai', $namaFile);

        // Excel::import(new PegawaiImport, public_path('/DataPegawai/'.$namaFile));
    
        // $import = new PegawaiImport;
        // $import->import($file);

        // dd($import->errors());

        return redirect('/anggota')->with('pesan','Data berhasil diimpor');
    }

    public function delete($nik_ktp) 
    {
        $pegawai= $this->Pegawai->detailData($nik_ktp);
        $this->Pegawai->deletePegawai($nik_ktp);
        return redirect()->route('v_anggota')->with('success', 'Data Berhasil Dihapus !!!');
    }

    public function store1(CreatePegawaiRequest $request)
    {
        $id = Pegawai::get('id');
            // foreach($id as $value);
            // $idlm = $value->id;
            // $idbr = $idlm + 1;

            // $kd_pegawai = 'KJP-'.$idbr;

            $data = new Pegawai();
            $data->nik_ktp = $request->nik_ktp;
            $data->nama = $request->nama;
            $data->nik_karyawan = $request->nik_karyawan;
            $data->tempat_lahir = $request->tempat_lahir;
            $data->tgl_lahir = $request->tgl_lahir;
            $data->tgl_masuk = $request->tgl_masuk;
            // $data->telp = $request->telp;
            $data->jabatan = $request->jabatan;
            $data->kepengurusan = $request->kepengurusan;
            $data->alamat = $request->alamat;
            $simpan= $data->save();
            if ($simpan) {
                return redirect()->route('v_anggota')->with('success', 'Selamat, Data Berhasil Ditambahkan!!!');
            }

    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Request()->validate([
            'nik_ktp' => 'required|max:16|min:16',
            'nama' => 'required',
            'nik_karyawan' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
           'tgl_masuk' => 'required',
            'jabatan' => 'required',
            'kepengurusan' => 'required',
            
            'alamat' => 'required',
        ],[
            'nik_ktp.required'=>'NIK KTP Wajib Diisi !!!',
            'nik_ktp.max'=>'NIK KTP 16 karakter',
            'nik_ktp.min'=>'NIK KTP 16 karakter',
            'nik_ktp.unique'=>'NIK sudah terdaftar',
            'nama.required'=>'Nama Wajib Diisi !!!',
            'nik_karyawan.required'=>'NIK Karyawan Wajib Diisi !!!',
            'tempat_lahir.required'=>'Tempat Lahir Wajib Diisi !!!',
            'tgl_lahir.required'=>'Tanggal Lahir Wajib Diisi !!!',
           'tgl_masuk.required'=>'Tanggal masuk Wajib Diisi !!!',
            'jabatan.required'=>' Status Karyawan Wajib Diisi !!!',
            'kepengurusan.required'=>'Kepengurusan Wajib Diisi !!!',
            
            'alamat.required'=>'Alamat Wajib Diisi !!!',
        ]);
        // $id = Pegawai::get('id');
        //     foreach($id as $value);
        //     $idlm = $value->id;
        //     $idbr = $idlm + 1;

        //     $kd_pegawai = 'KJP-'.$idbr;

            $data = new Pegawai();
            $data->nik_ktp = $request->nik_ktp;
            $data->nama = $request->nama;
            $data->nik_karyawan = $request->nik_karyawan;
            $data->tempat_lahir = $request->tempat_lahir;
            $data->tgl_lahir = $request->tgl_lahir;
           $data->tgl_masuk = $request->tgl_masuk;
            $data->jabatan = $request->jabatan;
            $data->kepengurusan = $request->kepengurusan;
            $data->alamat = $request->alamat;
            $simpan= $data->save();
            if ($simpan) {
                return redirect()->route('v_anggota')->with('message', 'Selamat, Data Berhasil Ditambahkan!!!');
            }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($nik_ktp)
    {
        $pegawai = Pegawai::find($nik_ktp);
        // $user= UsersModel::where('nik_ktp',$nik_ktp)->get();
 
        //return $pegawai;
        return view('v_editpegawai', compact('pegawai'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $nik_ktp)
    { Request()->validate([
            'nik_ktp' => 'required|max:16',
            'nama' => 'required',
            'nik_karyawan' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'tgl_masuk' => 'required',
            'jabatan' => 'required',
            'kepengurusan' => 'required',
            'status' => 'required',
            'alamat' => 'required',
            'foto_pegawai' => 'mimes:jpg,jpeg,bmp,png|max:1024',
        ],[
            'nik_ktp.required'=>'Wajib Diisi !!!',
            'nik_ktp.max'=>'Max 17 karakter',
            'nama.required'=>'Wajib Diisi !!!',
            'nik_karyawan.required'=>'Wajib Diisi !!!',
            'tempat_lahir.required'=>'Wajib Diisi !!!',
            'tgl_lahir.required'=>'Wajib Diisi !!!',
            'tgl_masuk.required'=>'Wajib Diisi !!!',
            'jabatan.required'=>'Wajib Diisi !!!',
            'kepengurusan.required'=>'Wajib Diisi !!!',
            'status.required'=>'Wajib Diisi !!!',
            'alamat.required'=>'Wajib Diisi !!!',
            'foto_pegawai.required'=>'Wajib Diisi !!!',
        ]);

        //jika validasi tidak ada maka klik tombol simpan data
        if (Request()->foto_pegawai<>"") {
            //jika ingin ganti foto
        $file = Request()->foto_pegawai;
        $filename = Request()->nik_ktp.'.'. $file->extension();
        $request->file('foto_pegawai')->storeAs('public/foto_pegawai/',$filename);
        // $file->move(public_path('foto_pegawai'), $filename);

        $data = [
            'nik_ktp' => Request()->nik_ktp,
            'nama' => Request()->nama,
            'nik_karyawan' => Request()->nik_karyawan,
            'tempat_lahir' => Request()->tempat_lahir,
            'tgl_lahir' => Request()->tgl_lahir,
            'tgl_masuk' => Request()->tgl_masuk,
            'alamat' => Request()->alamat,
            'jabatan' => Request()->jabatan,
            'kepengurusan' => Request()->kepengurusan,
            'status' => Request()->status,
            'foto_pegawai' => $filename,
        ];
        $this->Pegawai->editPegawai($nik_ktp, $data);
        }else {
            //jika tidak ingin ganti foto
            $data = [
            'nik_ktp' => Request()->nik_ktp,
            'nama' => Request()->nama,
            'nik_karyawan' => Request()->nik_karyawan,
            'tempat_lahir' => Request()->tempat_lahir,
            'tgl_lahir' => Request()->tgl_lahir,
            'tgl_masuk' => Request()->tgl_masuk,
            'alamat' => Request()->alamat,
            'jabatan' => Request()->jabatan,
            'kepengurusan' => Request()->kepengurusan,
            'status' => Request()->status,
                
            ];
            $this->Pegawai->editPegawai($nik_ktp, $data);
        }
        return redirect()->route('v_anggota')->with('message', 'Update data sukses!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
