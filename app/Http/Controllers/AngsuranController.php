<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AngsuranModel;
use App\Models\PinjamanModel;
use App\Models\Pegawai;
use App\Models\UsersModel;
use App\Imports\AngsuranImport;
use App\Exports\AngsuranExport;
use Illuminate\Support\Facades\DB;
use Excel;
class AngsuranController extends Controller
{
    public function __construct()
    {
        $this->AngsuranModel = new AngsuranModel();
        $this->middleware('auth');
    }    

    public function index()
    {
        // $angsuran = DB::table('angsuran')
        $angsuran = AngsuranModel::select('angsuran.nik_ktp','pegawai.nama','angsuran.no_pinjaman',DB::raw('sum(jumlah_angsuran) as total_angsuran'))
        ->join('pegawai','angsuran.nik_ktp','=','pegawai.nik_ktp')
        ->groupBy('angsuran.no_pinjaman','pegawai.nama','angsuran.nik_ktp')
        ->orderBy('pegawai.nama','asc')
        ->get();
        // $data = [
        //     'angsuran' => $this->AngsuranModel->allData(),
        // ];
        // dd($angsuran);
        return view('v_angsuran', compact('angsuran'));
    }

    public function detail($no_pinjaman) {
        // $pegawai = DB::table('pegawai')->where('nik_ktp',$nik_ktp)->get();
        $angsuran = DB::table('angsuran')->where('no_pinjaman',$no_pinjaman)
        ->leftJoin('angsuran.nik_ktp','=','pegawai.nik_ktp')
        ->orderBy('tgl_angsuran', 'desc')
        ->get();
        // dd ($nopinjaman);
        return view('v_detailAngsuran', compact('angsuran'));
    }

    public function angsuranSaya($nik_ktp)
    {
   
        $user = UsersModel::where('nik_ktp',$nik_ktp)->get();
        $pegawai = Pegawai::where('nik_ktp',$nik_ktp)->get();
        $angsuran = AngsuranModel::where('nik_ktp',$nik_ktp)->get();
        $jml_angsuran = AngsuranModel::where('nik_ktp',$nik_ktp)->sum('jumlah_angsuran');
       //dd ($user,$pegawai,$simpanan);
       return view('v_angsuranSaya',  compact(['pegawai','user','angsuran','jml_angsuran']));
    }

    public function editAngsuran($id_angsuran)
    {
        $angsuran = $this->AngsuranModel->allData()
        ->where('id_angsuran', $id_angsuran); 
        // dd($angsuran);
        return view('v_editAngsuran', compact('angsuran'));
    }

    public function delete($id_angsuran) 
    {
        $angsuran = $this->AngsuranModel->detailData($id_angsuran);
        $this->AngsuranModel->deleteAngsuran($id_angsuran);
        return redirect()->route('v_angsuran')->with('pesan', 'Data Berhasil Dihapus !!!');
    }


    public function angsuranexport() {
        return Excel::download(new AngsuranExport,'Angsuran.xlsx');
    }

    public function tambahAngsuran($no_pinjaman) {
        $pinjaman = PinjamanModel::where('no_pinjaman',$no_pinjaman)
        ->join('pegawai','pinjaman.nik_ktp','=','pegawai.nik_ktp')
        ->get();
        $jml_angsuran = AngsuranModel::where('no_pinjaman',$no_pinjaman)->sum('jumlah_angsuran');
        // dd ($pinjaman,$jml_angsuran);
        return view('v_tambahAngsuran', compact('pinjaman','jml_angsuran'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        Request()->validate([
            'jumlah_angsuran' => 'required',
            'tgl_angsuran' => 'required',
        ],[
            'jumlah_angsuran.required'=>'jumlah angsuran tidak boleh kosong!',
            'tgl_angsuran.required'=>'TGL Angsuran Wajib Diisi !!!',
        ]);   
        $request = [
            'tgl_angsuran' => Request()->tgl_angsuran,
            'no_pinjaman' => Request()->no_pinjaman,
            'nik_ktp' => Request()->nik_ktp,
            'jumlah_angsuran' => Request()->jumlah_angsuran,
           
        ];
        $this->AngsuranModel->simpanAngsuran($request);
        return back()->with('pesan', 'Selamat, data sudah disimpan, cek di data Angsuran ');
    }

    public function update($id_angsuran)
    { Request()->validate([
        'no_pinjaman' => 'required',
        'jumlah_angsuran' => 'required', 
    ],[
        'no_pinjaman.required'=>'Wajib Diisi !!!',
        'jumlah_angsuran.required'=>'Wajib Diisi !!!',
    ]);   

        $data = [

            'no_pinjaman' => Request()->no_pinjaman,
            'jumlah_angsuran' => Request()->jumlah_angsuran,
        ];
        $this->AngsuranModel->editAngsuran($id_angsuran, $data); 
        return redirect()->route('v_angsuran')->with('pesan', 'Data angsuran Berhasil Diupdate !!!');
    }

    public function angsuranimportexcel(Request $request) {
        // validasi
		$this->validate($request, [
			'file' => 'required|mimes:xls,xlsx'
		]);
        $import = new AngsuranImport;
        $file = $request->file('file');
        $namaFile = date(date('d-m-Y')).$file->getClientOriginalName();
        $import->import($file);
        $file->move('storage/DataAngsuran', $namaFile);
        

        return back()->with('success','Data berhasil di import');
    }
}
