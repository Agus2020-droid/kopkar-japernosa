<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\ShuModel;
use App\Models\UsersModel;
use App\Models\User;
use Excel;
use Illuminate\Support\Facades\DB;
use App\Imports\ShuImport;
use Dompdf\Dompdf;
use App\Notifications\RepliedToThread;
use Illuminate\Support\Facades\Notification;

class ShuController extends Controller
{
    public function __construct()
    {
        $this->ShuModel = new ShuModel();
        $this->middleware('auth');
    }    
    public function index()
    {
       $data = [
           'shu' => $this->ShuModel->allData(),
        
       ];
    //    dd ($data);
       return view('v_shu', $data);
    }

    public function shuimportexcel(Request $request) {
        $import = new ShuImport;
        $file = $request->file('file');
        $namaFile = date(date('d-m-Y')).$file->getClientOriginalName();
        $import->import($file);
        $file->move('storage/DataShu', $namaFile);
        
        // $file = $request->file('file');
        // $namaFile = $file->getClientOriginalName();
        // $file->move('DataShu', $namaFile);

        // Excel::import(new ShuImport, public_path('/DataShu/'.$namaFile));
        return redirect('shu')->with('info', 'document upload success !');
    }

    public function pushNotif(Request $request, User $users) {
        $users = User::all();
        $notif = [
            'notifikasi' => Request()->notifikasi,
            'foto_user' => Request()->foto_user,
            'name' => Request()->name,
        ];
        Notification::send($users, new RepliedToThread($notif));
        return back()->with('info','Push notification successfully!');
    }
    
    public function editShu($id_shu)
    {
        $shu = ShuModel::where('id_shu',$id_shu)
        ->join('pegawai','shu.nik_ktp','=','pegawai.nik_ktp')
        ->get();

        // dd($shu);
        return view('v_editShu', compact('shu'));
    }

       public function update($id_shu)
    { Request()->validate([
       
        'tgl_shu' => 'required',
        'nama_bank' => 'required',
        'no_rek' => 'required',
        'peran_belanja_wanamart' => 'required',
        'peran_simpanan_wanamart' => 'required',
        'lain_lain' => 'required',
        'peran_kredit' => 'required',
        'peran_simpanan' => 'required',
        'pengurus' => 'required',
        'jumlah_shu' => 'required',
        
    ],[
        'tgl_shu.required'=>'Wajib diisi !!!',
        'nama_bank.required'=>'Nama Bank wajib diisi !!!',
        'no_rek.required'=>'Nama Bank wajib diisi !!!',
        'peran_belanja_wanamart.required'=>'Peran belanja wajib diisi !!!',
        'peran_simpanan_wanamart.required'=>'Peran simpanan wajib diisi !!!',
        'lain_lain.required'=>'Japernosa Water & FC wajib diisi !!!',
        'peran_kredit.required'=>'Peran kredit wajib diisi !!!',
        'peran_simpanan.required'=>'Peran simpanan wajib diisi !!!',
        'pengurus.required'=>'Pengurus wajib diisi !!!',
        'jumlah_shu.required'=>'Wajib Diisi !!!',
    ]);   

        $data = [
            'tgl_shu' => Request()->tgl_shu,
            'nama_bank' => Request()->nama_bank,
            'no_rek' => Request()->no_rek,
            'peran_belanja_wanamart' => Request()->peran_belanja_wanamart,
            'peran_simpanan_wanamart' => Request()->peran_simpanan_wanamart,
            'lain_lain' => Request()->lain_lain,
            'peran_kredit' => Request()->peran_kredit,
            'peran_simpanan' => Request()->peran_simpanan,
            'pengurus' => Request()->pengurus,
            'jumlah_shu' => Request()->jumlah_shu,
            
        ];
        $this->ShuModel->editShu($id_shu, $data); 
        return redirect()->route('v_shu')->with('pesan', 'Data SHU Berhasil Diupdate !!!');
    }

    public function shuSaya($nik_ktp)
    {
   
        $user = UsersModel::where('nik_ktp',$nik_ktp)->get();
        $pegawai = Pegawai::where('nik_ktp',$nik_ktp)->get();
        $shu = ShuModel::where('nik_ktp',$nik_ktp)->get();
     
    //    dd ($user,$pegawai,$shu);
       return view('v_shuSaya',  compact('pegawai','user','shu'));
    }
    
    public function delete($id_shu) 
    {
        $shu= $this->ShuModel->detailData($id_shu);
        $this->ShuModel->deleteShu($id_shu);
        return back()->with('success', 'Data Berhasil Dihapus !!!');
    }
    
    public function pdfShu($nik_ktp) {
        $user = UsersModel::where('nik_ktp',$nik_ktp)->get();
        $pegawai = Pegawai::where('nik_ktp',$nik_ktp)->get();
        $shu = ShuModel::where('nik_ktp',$nik_ktp)->get();
        $html = view('v_slipShu', compact('pegawai','user','shu'));

        $card = new Dompdf();

        $card->loadHtml($html);
        $card->setPaper('A4', 'portrait');
        $card->render();
        $card->stream();

        // return view('v_slipShu', compact('pegawai','user','shu'));
    }
}
