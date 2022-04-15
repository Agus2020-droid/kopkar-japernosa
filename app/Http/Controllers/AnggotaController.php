<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//use App\Models\AnggotaModel;
use App\Models\UsersModel;
use App\Models\Pegawai;
use App\Models\SimpananModel;
use App\Models\PengambilanModel;
use App\Models\PinjamanModel;
use App\Models\AngsuranModel;
use App\Models\PotonggajiModel;
use App\Models\jenissimpanan;
use App\Exports\AnggotaExport;
use App\Imports\AnggotaImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class AnggotaController extends Controller
{
    public function __construct()
    {
        $this->Pegawai = new Pegawai();
        $this->middleware('auth');
    }

    public function index()
    {  
        $pegawai= DB::table('pegawai')
        ->join('users','pegawai.nik_ktp','=','users.nik_ktp')
        ->orderBy('nama','asc')
        ->get();
        
        // dd($pegawai);
        return view('v_anggota',compact('pegawai'));
       
    }

    public function show($nik_ktp)
    {
      
        $pegawais= Pegawai::find($nik_ktp)
        ->join('users','pegawai.nik_ktp','=','users.nik_ktp')
        ->where('pegawai.nik_ktp',$nik_ktp)
        ->get();
      

        $simpanan = SimpananModel::orderBy('tgl_potongan','desc')
        ->where('nik_ktp',$nik_ktp)
        ->get();
        $jml_simpananpokok = SimpananModel::where('nik_ktp',$nik_ktp)->sum('simpanan_pokok');
        $jml_ambilpokok = PengambilanModel::where('nik_ktp',$nik_ktp)->sum('simpanan_pokok');
        $jml_simpananwajib = SimpananModel::where('nik_ktp',$nik_ktp)->sum('simpanan_wajib');
        $jml_ambilwajib = PengambilanModel::where('nik_ktp',$nik_ktp)->sum('simpanan_wajib');
        $jml_simpanansukarela = SimpananModel::where('nik_ktp',$nik_ktp)->sum('simpanan_sukarela');
        $jml_ambilsukarela = PengambilanModel::where('nik_ktp',$nik_ktp)->sum('simpanan_sukarela');

        $pinjaman = PinjamanModel::where('nik_ktp',$nik_ktp)->get();
        $angsuran = AngsuranModel::where('nik_ktp',$nik_ktp)->paginate(10);
        $pengambilan = PengambilanModel::where('nik_ktp',$nik_ktp)->get();
        $potonggaji = PotonggajiModel::where('nik_ktp',$nik_ktp)->get();

        // dd ($pegawai);
        return view('v_profileanggota', compact(['pegawais','simpanan','jml_simpananpokok','jml_ambilpokok','jml_simpananwajib','jml_ambilwajib','jml_simpanansukarela','jml_ambilsukarela','pinjaman','angsuran','pengambilan','potonggaji']));
    }
     
    public function detailpinjaman($no_pinjaman)
    
    {
        $pegawai= Pegawai::find($nik_ktp);
        $pinjaman = PinjamanModel::where('nik_ktp',$nik_ktp)->get();
       
        return view('v_detailpinjaman', compact(['pinjaman','pegawai']));
    } 

    public function detailsimpanan($nik_ktp)
    
    {
       $pegawai= Pegawai::find($nik_ktp);
        $simpanan = SimpananModel::where('nik_ktp',$nik_ktp)->get();
       
        return view('v_detailsimpanan', compact(['simpanan','pegawai']));
    }

    public function detailangsuran($nik_ktp)
    {
       $pegawai= Pegawai::find($nik_ktp);
        $angsuran = AngsuranModel::where('nik_ktp',$nik_ktp)->get();
        
        return view('v_detailangsuran', compact(['angsuran','pegawai']));
    }

    public function tambahanggota() {
        $pegawai = Pegawai::all();  
        return view('v_tambahanggota', compact('pegawai'));
    }

    public function tambahpinjaman($nik_ktp) {
        $pegawai = Pegawai::find($nik_ktp);    
       
        return view('v_tambahpinjam', compact('pegawai'));
    }
    
    public function detail($id_anggota)
    {
       if (!$this->AnggotaModel->detailData($id_anggota)) {
            abort(404);
        }
        $data = [
            'anggota' => $this->AnggotaModel->detailData($id_anggota), 
        ];
    return view('v_detailanggota', $data);
    }
    
    public function anggotaexport() 
    {
        return Excel::download(new AnggotaExport, 'Anggota.xlsx');
    }


    public function anggotaimportexcel(Request $request) {
        $file = $request->file('file');
        $namaFile = $file->getClientOriginalName();
        $file->move('DataAnggota', $namaFile);

        Excel::import(new AnggotaImport, public_path('/DataAnggota/'.$namaFile));
        return redirect('anggota');
    }
    

    public function delete($id_anggota) 
    {
        $anggota= $this->AnggotaModel->detailData($id_anggota);
        if ($anggota->foto_anggota<>"") {
            unlink(public_path('foto_anggota').'/'. $anggota->foto_anggota);
        }
        $this->AnggotaModel->deleteAnggota($id_anggota);
        return redirect()->route('v_anggota')->with('pesan', 'Data Berhasil Dihapus !!!');
    }

    public function update($id_anggota) {
        Request()->validate([
            'nik_anggota' => 'required|max:17',
            'nama_anggota' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'status' => 'required',
            'alamat_anggota' => 'required',
            'telp' => 'required',
            'tgl_masuk' => 'required',
            'divisi' => 'required',
            'bagian' => 'required',
            'foto_anggota' => 'mimes:jpg,jpeg,bmp,png|max:1024',
        ],[
            'nik_anggota.required'=>'Wajib Diisi !!!',
            'nik_anggota.max'=>'Max 17 karakter',
            'nama_anggota.required'=>'Wajib Diisi !!!',
            'tempat_lahir.required'=>'Wajib Diisi !!!',
            'tgl_lahir.required'=>'Wajib Diisi !!!',
            'alamat_anggota.required'=>'Wajib Diisi !!!',
            'status.required'=>'Wajib Diisi !!!',
            'telp.required'=>'Wajib Diisi !!!',
            'tgl_masuk.required'=>'Wajib Diisi !!!',
            'divisi.required'=>'Wajib Diisi !!!',
            'bagian.required'=>'Wajib Diisi !!!',
            'foto_anggota.required'=>'Wajib Diisi !!!',
        
            
        ]);

        //jika validasi tidak ada maka klik tombol simpan data
        if (Request()->foto_anggota<>"") {
            //jika ingin ganti foto
            $file = Request()->foto_anggota;
            $filename = Request()->nik_anggota.'.'. $file->extension();
            $file->move(public_path('foto_anggota'), $filename);

        $data = [
            'nik_anggota' => Request()->nik_anggota,
            'nama_anggota' => Request()->nama_anggota,
            'tempat_lahir' => Request()->tempat_lahir,
            'tgl_lahir' => Request()->tgl_lahir,
            'alamat_anggota' => Request()->alamat_anggota,
            'status' => Request()->status,
            'telp' => Request()->telp,
            'tgl_masuk' => Request()->tgl_masuk,
            'divisi' => Request()->divisi,
            'bagian' => Request()->bagian,
            'foto_anggota' => $filename,
        ];
        $this->AnggotaModel->editAnggota($id_anggota, $data);
        }else {
            //jika tidak ingin ganti foto
            $data = [
            'nik_anggota' => Request()->nik_anggota,
            'nama_anggota' => Request()->nama_anggota,
            'tempat_lahir' => Request()->tempat_lahir,
            'tgl_lahir' => Request()->tgl_lahir,
            'alamat_anggota' => Request()->alamat_anggota,
            'status' => Request()->status,
            'telp' => Request()->telp,
            'tgl_masuk' => Request()->tgl_masuk,
            'divisi' => Request()->divisi,
            'bagian' => Request()->bagian,
                
            ];
            $this->AnggotaModel->editAnggota($id_anggota, $data);
        }
        
        return redirect()->route('v_anggota')->with('pesan', 'Data Berhasil Diupdate !!!');
    }
    public function edit($id_anggota) {  
        if (!$this->AnggotaModel->detailData($id_anggota)) {
            abort(404);
        }
        $data = [
            'anggota' => $this->AnggotaModel->detailData($id_anggota), 
        ];
        return view('v_editanggota', $data);
    }
    
        public function pendaftaran()
    {
    
        return view('v_pendaftaran');
    }
}

