<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsersModel;
use App\Models\Pegawai;
use App\Models\SimpananModel;
use App\Models\PinjamanModel;
use App\Models\AngsuranModel;
use App\Models\PotonggajiModel;
use App\Models\PengambilanModel;
use Auth;
use DB;
use Dompdf\Dompdf;

class AnggotakopkarController extends Controller
{
    public function __construct()
    {
        $this->UsersModel = new UsersModel();
        $this->middleware('auth');
    }
    
    public function index()
    {
        //$user = $this->UsersModel->semuaData();
        //$pegawai = Pegawai::all();
        //dd ($user);
        return view('anggotakopkar.v_dashboard');
    }

    public function showProfile($nik_ktp)
    {
        
        $user = $this->UsersModel->semuaData()->where('nik_ktp',$nik_ktp);
        $pegawai = Pegawai::where('nik_ktp',$nik_ktp)->get();
        $simpanan = SimpananModel::where('nik_ktp',$nik_ktp)
        ->orderBy('tgl_potongan', 'desc')->get();
        
        $jml_simpananpokok = SimpananModel::where('nik_ktp',$nik_ktp)->sum('simpanan_pokok');
        $jml_ambilpokok = PengambilanModel::where('nik_ktp',$nik_ktp)->sum('simpanan_pokok');
        
        $jml_simpananwajib = SimpananModel::where('nik_ktp',$nik_ktp)->sum('simpanan_wajib');
        $jml_ambilwajib = PengambilanModel::where('nik_ktp',$nik_ktp)->sum('simpanan_wajib');
        
        $jml_simpanansukarela = SimpananModel::where('nik_ktp',$nik_ktp)->sum('simpanan_sukarela');
        $jml_ambilsukarela = PengambilanModel::where('nik_ktp',$nik_ktp)->sum('simpanan_sukarela');

        $jml_simpanan = SimpananModel::where('nik_ktp',$nik_ktp)->sum('jumlah_simpanan');
        $jml_pengambilan = PengambilanModel::where('nik_ktp',$nik_ktp)->sum('jumlah_pengambilan');

        $jml_pinjaman = PinjamanModel::where('nik_ktp',$nik_ktp)->sum('plafon');
        $total_kredit = PinjamanModel::where('nik_ktp',$nik_ktp)->sum('total_kredit');
        $jml_angsuran = AngsuranModel::where('nik_ktp',$nik_ktp)->sum('jumlah_angsuran');
        
        $pinjaman = PinjamanModel::where('nik_ktp',$nik_ktp)->get();
        $angsuran = AngsuranModel::where('nik_ktp',$nik_ktp)->get();
        $pengambilan = PengambilanModel::where('nik_ktp',$nik_ktp)->get();
        $potonggaji = PotonggajiModel::where('nik_ktp',$nik_ktp)->get();
        //dd ($user,$pegawai);
        //return $user;
        return view('v_profile', compact(['pegawai','user','simpanan','pinjaman','angsuran',
        'pengambilan','potonggaji','jml_simpanan','jml_angsuran','total_kredit','jml_pinjaman','jml_simpananpokok','jml_ambilpokok','jml_ambilwajib','jml_ambilsukarela', 'jml_simpananwajib','jml_simpanansukarela','jml_pengambilan']));
    }

    public function card($nik_ktp)
    {
        
        $user = $this->UsersModel->semuaData()->where('nik_ktp',$nik_ktp);
        $pegawai = Pegawai::where('nik_ktp',$nik_ktp)->get();
       
        //dd ($user,$pegawai);
        //return $user;
        return view('v_card', compact(['pegawai','user']));
    }

    public function pdfKartu($nik_ktp) {
        $pegawai = Pegawai::all()->where('nik_ktp',$nik_ktp);
        $html = view('v_card', compact('pegawai'));

        $card = new Dompdf();

        $card->loadHtml($html);
        $card->setPaper('A4', 'portrait');
        $card->render();
        $card->stream();

        // dd ($pegawai);
        
        // ini_set('max_execution_time', 180); //3 minutes
    }
   
}
