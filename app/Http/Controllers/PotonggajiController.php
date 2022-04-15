<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PotonggajiModel;
use App\Imports\PotonganImport;
use App\Models\UsersModel;
use App\Models\Pegawai;
use Excel;
use Maatwebsite\Excel\Validators\ValidatorException;
use DB;

class PotonggajiController extends Controller
{
    public function __construct()
    {
        $this->PotonggajiModel = new PotonggajiModel();
        $this->middleware('auth');
    }
    public function index()
    {
        $data = [
            'query' => $this->PotonggajiModel->allData(),
         
        ];
        // dd($data);
        return view('v_potonggaji', $data);
    }

    public function potonganimportexcel(Request $request) {
        // validasi
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
        $import = new PotonganImport;
        $file = $request->file('file');
        $namaFile = date(date('d-m-Y')).$file->getClientOriginalName();
        $import->import($file);
        $file->move('storage/DataPotongan', $namaFile);
        // Excel::import(new PotonganImport, public_path('/DataPotongan/'.$namaFile));


        // $import = new PotonganImport;
        // $import->import($file);
        // $error = $import->getError();

        // dd($import->failures());

        return back()->with('success','File Excel berhasil diimpor')->with('error','Failed import ');
    }
    
    public function potonggajiSaya($nik_ktp)
    {
   
        $user = UsersModel::where('nik_ktp',$nik_ktp)->get();
        $pegawai = Pegawai::where('nik_ktp',$nik_ktp)->get();
        $potonggaji = PotonggajiModel::where('nik_ktp',$nik_ktp)->get();
     
       //dd ($user,$pegawai,$simpanan);
       return view('v_potonggajiSaya',  compact(['pegawai','user','potonggaji']));
    }

    public function search(Request $request)
    {
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');


       $query = DB::table('potonggaji')->select()
       ->join('pegawai','potonggaji.nik_ktp', '=', 'pegawai.nik_ktp')
       ->where('tgl_potongan',">=", $fromDate)
       ->where('tgl_potongan',"<=", $toDate)
       ->get();
       $role = DB::table('potonggaji')
       ->select('potonggaji.nik_ktp','pegawai.nik_ktp','pegawai.nama')
       ->join('pegawai','potonggaji.nik_ktp', '=', 'pegawai.nik_ktp')
       ->get();
    //    dd($query,$role);
        return view('v_potonggaji',compact('query','role'));
    }

    public function delete($id_potongan) 
    {
        $potongan= $this->PotonggajiModel->detailData($id_potongan);
        $this->PotonggajiModel->deletePotongan($id_potongan);
        return redirect()->route('v_potonggaji')->with('pesan', 'Data Berhasil Dihapus !!!');
    }

    public function editPotongan($id_potongan)
    {
        $potongan = $this->PotonggajiModel->allData()
        ->where('id_potongan', $id_potongan); 
        // dd($angsuran);
        return view('v_editPotongan', compact('potongan'));
    }

    public function update($id_potongan)
    { Request()->validate([
        'jumlah_potongan' => 'required', 
    ],[
     
        'jumlah_potongan.required'=>'Wajib Diisi !!!',
    ]);   

        $data = [
            'jumlah_potongan' => Request()->jumlah_potongan,
        ];
        $this->PotonggajiModel->editPotongan($id_potongan, $data); 
        return back()->with('success', 'Data angsuran Berhasil diupdate !!!');
    }
}
