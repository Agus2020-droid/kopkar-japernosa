<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PinjamanModel;
use App\Models\PengumumanModel;
use App\Models\UsersModel;
use App\Models\VisitorModel;
use DB;
use Carbon\Carbon;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $pegawai = DB::table('pegawai')->count();
        // $simpanan = DB::table('simpanan')->sum('jumlah_simpanan');
        // $pinjaman = DB::table('pinjaman')->sum('plafon');
        $data = PengumumanModel::orderBy('tgl_pengumuman','desc')->paginate(5);
        
        //dd($pegawai, $simpanan, $pinjaman);
        return view('v_home', compact('data'));
        //return view('v_dashboard');
    }


    public function dashboard()
    {
        $startYear = Carbon::now()->startOfYear();
        $endYear = Carbon::now()->endofYear();

        $pegawai = DB::table('pegawai')->count();
        $staf = DB::table('pegawai')
        ->where('jabatan','=','STAF')
        ->count();
        $kontrak = DB::table('pegawai')
        ->where('jabatan','=','Kontrak')
        ->count();
        $tetap = DB::table('pegawai')
        ->where('jabatan','=','Tetap')
        ->count();
         $mitra = DB::table('pegawai')
        ->where('jabatan','=','Mitra')
        ->count();
        
        $user = DB::table('users')->count();
        $user_unreg = DB::table('users')
        ->where('email','=','-')
        ->count();
        $user_reg = DB::table('users')
        ->where('email','!=','-')
        ->count();
        
        $simpanan = DB::table('simpanan')->sum('jumlah_simpanan');

        
        $profit = DB::table('pinjaman')
        ->select(DB::raw('COUNT(*) as count'))
        ->where('jenis_pinjaman','=', 'Pengembangan')
        ->groupBy('jenis_pinjaman')
        ->get();

        $nonprofit = DB::table('pinjaman')
        ->select(DB::raw('COUNT(*) as count'))
        ->where('jenis_pinjaman','=', 'Pinjaman Sosial')
        ->groupBy('jenis_pinjaman')
        ->get();
        
         $cat_profit =[];
         $cat_nonprofit =[];

        foreach ($profit as $prof){
            $cat_profit[] = $prof->count;
        }
        foreach ($nonprofit as $nonprof){
            $cat_nonprofit[] = $nonprof->count;
        }
        $pengguna = UsersModel::orderBy('last_seen','desc')->paginate(12);

        // Graph User Login
        $starDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();

        $pengunjung = VisitorModel::select(DB::raw('MONTHNAME(created_at) as bulans'), DB::raw('sum(count) as user_count'))
        ->groupBy(DB::raw("MONTHNAME(created_at)"))
        ->orderBy('created_at','desc')
        ->paginate(6);
        $visitors = VisitorModel::select(DB::raw("CAST(SUM(count) as int) as count"))
        ->groupBy(DB::raw("created_at"))
        ->orderBy('created_at','asc')
        ->whereBetween('created_at',[$starDate,$endDate])
        ->pluck('count');
  
        $hari = VisitorModel::select(DB::raw('DATE_FORMAT(created_at,"%d-%m") as hari'))
        ->groupBy(DB::raw("created_at"))
        ->orderBy('created_at','asc')
        ->whereBetween('created_at',[$starDate,$endDate])
        ->pluck('hari');
        $bulanIni = Carbon::now()->isoFormat("MMMM Y");
        // dd($bulanIni );
        
        // Graph Pinjaman


        $PinjamSosial = PinjamanModel::select(DB::raw("CAST(SUM(plafon) as int) as plafon"))
        ->groupBy(DB::raw("MONTHNAME(tgl_pengajuan)"))
        // ->groupBy(DB::raw("tgl_pengajuan"))
        ->orderBy('tgl_pengajuan','asc')
        ->where('jenis_pinjaman','=','Pinjaman Sosial')
        ->whereBetween('tgl_pengajuan',[$startYear,$endYear])
        ->pluck('plafon');

        $PinjamPengembangan = PinjamanModel::select(DB::raw("CAST(SUM(plafon) as int) as plafon"))
        ->groupBy(DB::raw("MONTHNAME(tgl_pengajuan)"))
        ->orderBy('tgl_pengajuan','asc')
        ->where('jenis_pinjaman','=','Pengembangan')
        ->whereBetween('tgl_pengajuan',[$startYear,$endYear])
        ->pluck('plafon');

        $TtlPinjamanSosial = DB::table('pinjaman')
        ->where('jenis_pinjaman','=','Pinjaman Sosial')
        ->whereBetween('tgl_pengajuan',[$startYear,$endYear])
        ->sum('plafon');
        $TtlPinjamanPengembangan = DB::table('pinjaman')
        ->where('jenis_pinjaman','=','Pengembangan')
        ->whereBetween('tgl_pengajuan',[$startYear,$endYear])
        ->sum('plafon');
  
        $bulan = PinjamanModel::select(DB::raw("MONTHNAME(tgl_pengajuan) as bulan"))
        ->groupBy(DB::raw("tgl_pengajuan"))
        ->orderBy('tgl_pengajuan','asc')
        ->whereBetween('tgl_pengajuan',[$startYear,$endYear])
        ->pluck('bulan');
        

        // dd($TtlPinjamanPengembangan );
        return view('v_dashboard',compact('pegawai','simpanan','cat_profit','cat_nonprofit','user','pengguna', 'user_unreg','user_reg', 'staf','kontrak','tetap','mitra', 'hari','visitors','pengunjung','PinjamPengembangan','PinjamSosial','TtlPinjamanSosial','TtlPinjamanPengembangan','bulan','bulanIni'));
    }

    public function user()
    {
       $users = DB::table('users')->paginate(8);
        //dd($user);
        return view('v_home', compact('users'));
    }


}
