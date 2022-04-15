<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PinjamanModel;
use App\Models\UsersModel;

use DB;

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
        
        //dd($pegawai, $simpanan, $pinjaman);
        return view('v_home');
        //return view('v_dashboard');
    }

    public function dashboard()
    {
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
        $pinjaman = DB::table('pinjaman')->sum('plafon');
        
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

        // dd($cat_profit, $cat_nonprofit);
        return view('v_dashboard',['pegawai'=>$pegawai,'simpanan'=>$simpanan,'pinjaman'=>$pinjaman,'cat_profit'=>$cat_profit,'cat_nonprofit'=>$cat_nonprofit,'user'=>$user,'pengguna'=>$pengguna, 'user_unreg'=>$user_unreg,'user_reg'=>$user_reg, 'staf'=>$staf,'kontrak'=>$kontrak,'tetap'=>$tetap,'mitra'=>$mitra]);
    }

    public function user()
    {
       $users = DB::table('users')->paginate(8);
        //dd($user);
        return view('v_home', compact('users'));
    }


}
