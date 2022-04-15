<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SimpananModel;
use App\Models\Pegawai;
use App\Models\jenissimpanan;
use App\Models\UsersModel;
use App\Exports\SimpananExport;
use App\Imports\SimpananImport;
use Illuminate\Support\Facades\DB;
use Excel;
class SimpananController extends Controller
{
      
    public function __construct()
    {
        $this->SimpananModel = new SimpananModel();
        $this->middleware('auth');
    }    
    public function index()
    {
        // $simpanan = DB::table('simpanan')
        // ->join('pegawai','simpanan.nik_ktp','=','pegawai.nik_ktp')
        // ->orderBy('id_simpanan','desc')->get();
        $simpanan = SimpananModel::select('simpanan.nik_ktp','pegawai.nama',DB::raw('sum(simpanan_pokok) as total_simpanan_pokok'), DB::raw('sum(simpanan_wajib) as total_simpanan_wajib'), DB::raw('sum(simpanan_sukarela) as total_simpanan_sukarela'), DB::raw('sum(jumlah_simpanan) as total_jumlah_simpanan'))
        ->join('pegawai','pegawai.nik_ktp','=','simpanan.nik_ktp')
        ->groupBy('pegawai.nama','simpanan.nik_ktp')
        ->get();
        // dd(simpanan);
        return view('v_simpanan', compact('simpanan'));
    }
    
     public function indexAdmin()
    {
        $simpanan = DB::table('simpanan')
        ->join('pegawai','simpanan.nik_ktp','=','pegawai.nik_ktp')
        ->orderBy('id_simpanan','desc')->get();
      
        // dd(simpanan);
        return view('v_simpananAdmin', compact('simpanan'));
    }
    
    public function detail($nik_ktp) {
        $pegawai = DB::table('pegawai')->where('nik_ktp',$nik_ktp)->get();
        $simpanan = DB::table('simpanan')->where('nik_ktp',$nik_ktp)
        ->orderBy('tgl_potongan', 'desc')
        ->get();
        // dd ($simpanan);
        return view('v_detailSimpanan', compact('simpanan','pegawai'));
    }
    
    public function tambah() {
        $pegawai = Pegawai::all();  
       
        // dd ($pegawai);
        return view('v_tambahsimpan', compact('pegawai'));
    }
   

    public function store(Request $request) {
       Request()->validate([
            'nik_ktp' => 'required',
            'simpanan_pokok' => 'required',
            'simpanan_wajib' => 'required',
            'simpanan_sukarela' => 'required',
            'tgl_potongan' => 'required',
        ],[
            'nik_ktp.required'=>'Nik KTP Required',
           'simpanan_pokok.required'=>'Simpanan pokok Required',
           'simpanan_wajib.required'=>'Simpanan wajib Required',
           'simpanan_sukarela.required'=>'Simpanan sukarela Required',
           'tgl_potongan.required'=>'Tanggal simpanan Required',
        ]);  
       
        $request = [
            'id_simpanan' => Request()->id_simpanan,
            'nik_ktp' => Request()->nik_ktp,
            'simpanan_pokok' => Request()->simpanan_pokok,
            'simpanan_wajib' => Request()->simpanan_wajib,
            'simpanan_sukarela' => Request()->simpanan_sukarela,
            'jumlah_simpanan' => Request()->jumlah_simpanan,
            'tgl_potongan' => Request()->tgl_potongan,
            
        ];
        $this->SimpananModel->tambahSimpanan($request);
        return redirect()->route('v_simpanan')->with('message', 'Data berhasil disimpan');
    }

    public function simpananSaya($nik_ktp)
    {
   
        $user = UsersModel::where('nik_ktp',$nik_ktp)->get();
        $pegawai = Pegawai::where('nik_ktp',$nik_ktp)->get();
        $simpanan = SimpananModel::where('nik_ktp',$nik_ktp)->paginate();
        $jml_simpanan = SimpananModel::where('nik_ktp',$nik_ktp)->sum('jumlah_simpanan');
       //dd ($user,$pegawai,$simpanan);
       return view('v_simpananSaya',  compact(['pegawai','user','simpanan','jml_simpanan']));
    }

    public function editSimpanan($id_simpanan)
    {
        $simpanan = SimpananModel::where('id_simpanan',$id_simpanan)
        ->join('pegawai','simpanan.nik_ktp','=','pegawai.nik_ktp')
        ->get();

        // dd($simpanan);
        return view('v_editSimpanan', compact('simpanan'));
    }
    
        public function editSimpananAdmin($id_simpanan)
    {
        $simpanan = SimpananModel::where('id_simpanan',$id_simpanan)
        ->join('pegawai','simpanan.nik_ktp','=','pegawai.nik_ktp')
        ->get();

        // dd($simpanan);
        return view('v_editSimpananAdmin', compact('simpanan'));
    }

    public function update($id_simpanan)
    { Request()->validate([
       
        'simpanan_pokok' => 'required',
        'simpanan_wajib' => 'required',
        'simpanan_sukarela' => 'required',
        'tgl_potongan' => 'required',
        
    ],[
        'simpanan_pokok.required'=>'simpanan pokok required',
        'simpanan_wajib.required'=>'simpanan wajib required',
        'simpanan_sukarela.required'=>'simpanan wajib required',
        'tgl_potongan.required'=>'tanggal required',
    ]);   

        $data = [
            'tgl_potongan' => Request()->tgl_potongan,
            'simpanan_pokok' => Request()->simpanan_pokok,
            'simpanan_wajib' => Request()->simpanan_wajib,
            'simpanan_sukarela' => Request()->simpanan_sukarela,
            'jumlah_simpanan' => Request()->jumlah_simpanan,
 
        ];
        $this->SimpananModel->editSimpanan($id_simpanan, $data); 
        return redirect()->route('v_simpanan')->with('pesan', 'Data Berhasil Diupdate !!!');
    }
    
        public function updateAdmin($id_simpanan)
    { Request()->validate([
       
        'simpanan_pokok' => 'required',
        'simpanan_wajib' => 'required',
        'simpanan_sukarela' => 'required',
        'tgl_potongan' => 'required',
        
    ],[
        'simpanan_pokok.required'=>'simpanan pokok required',
        'simpanan_wajib.required'=>'simpanan wajib required',
        'simpanan_sukarela.required'=>'simpanan wajib required',
        'tgl_potongan.required'=>'tanggal required',
    ]);   

        $data = [
            'tgl_potongan' => Request()->tgl_potongan,
            'simpanan_pokok' => Request()->simpanan_pokok,
            'simpanan_wajib' => Request()->simpanan_wajib,
            'simpanan_sukarela' => Request()->simpanan_sukarela,
            'jumlah_simpanan' => Request()->jumlah_simpanan,
 
        ];
        $this->SimpananModel->editSimpanan($id_simpanan, $data); 
        return redirect()->route('v_simpanan')->with('message', 'Update simpanan successfully.');
    }
    
    public function delete($id_simpanan) 
    {
        $simpanan= $this->SimpananModel->detailData($id_simpanan);
        $this->SimpananModel->deleteSimpanan($id_simpanan);
        return redirect()->route('v_simpanan')->with('pesan', 'Data Berhasil Dihapus !!!');
    }
    
        public function deleteAdmin($id_simpanan) 
    {
        $simpanan= $this->SimpananModel->detailData($id_simpanan);
        $this->SimpananModel->deleteSimpanan($id_simpanan);
        return redirect()->route('v_simpanan')->with('pesan', 'Data Berhasil Dihapus !!!');
    }

    public function simpananexport() {
        return Excel::download(new SimpananExport,'Simpanan.xlsx');
    }
    
    public function simpananimportexcel(Request $request) {
        // validasi
		$this->validate($request, [
			'file' => 'required|mimes:xls,xlsx'
		]);
        $import = new SimpananImport;
        $file = $request->file('file');
        $namaFile = date(date('d-m-Y')).$file->getClientOriginalName();
        $import->import($file);
        $file->move('storage/DataSimpanan', $namaFile);
        

        return redirect('simpananAdmin')->with('success','File Excel berhasil diimpor');
    }
}
