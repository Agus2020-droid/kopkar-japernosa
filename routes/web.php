<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\SimpananController;
use App\Http\Controllers\PinjamController;
use App\Http\Controllers\AngsuranController;
use App\Http\Controllers\BagihasilController;
use App\Http\Controllers\PengambilanController;
use App\Http\Controllers\HostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\AnggotakopkarController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\ShuController;
use App\Http\Controllers\MitrakuController;
use Illuminate\Support\Facades\DB;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();
// Route::get('/test',function() {
//     $notifications=auth()->user()->unreadNotifications;
//     foreach($notifications as $notification) {
//         dd($notification->data['user']['name']);
//     }
// });
Route::get('markAsRead',function() {
    auth()->user()->unreadNotifications->markAsRead();
    return redirect()->back();
})->name('markRead');

Route::get('/run',function() {
    $simpanans= DB::table('simpanan')->count();
   foreach($simpanans as $simpanan)
        dd($simpanan);
   
});
Route::get('/', function () {
    return view('v_welcome');
});

Route::get('/home', [HomeController::class, 'index']);
Route::get('/users/ubahPassword/{id}', [UsersController::class, 'ubahPassword']);
Route::patch('/users/ubahPassword/{id}', [UsersController::class, 'updatePassword']);
Route::post('/users/editPhoto', [UsersController::class, 'updateProfile']);
//Route::get('/user', [UserController::class, 'index'])->name('v_user');

//Route::get('/user/detail/{id_user}', [UserController::class, 'detail']);
//Route::get('/user/tambah', [UserController::class, 'tambah']);
//Route::post('/user/insert', [UserController::class, 'insert']);
//Route::get('/user/edit/{id_user}', [UserController::class, 'edit']);
//Route::post('/user/update/{id_user}', [UserController::class, 'update']);
//Route::get('/user/delete/{id_user}', [UserController::class, 'delete']);
Route::post('/insertPendaftaran', [PendaftaranController::class, 'simpanPendaftaran']);


Route::get('/anggotakopkar', [AnggotakopkarController::class, 'index']);
Route::get('/anggotakopkar/{users}', [AnggotakopkarController::class, 'showProfile']);
Route::get('/downloadPDF/{users}', [AnggotakopkarController::class, 'pdfKartu']);
Route::get('/anggotakopkar/kartu/{users}', [AnggotakopkarController::class, 'card']);
Route::get('/simpananSaya/{users}', [SimpananController::class, 'simpananSaya']);
Route::get('/pengambilanSaya/{users}', [PengambilanController::class, 'pengambilanSaya'])->name('pengambilanSaya');
Route::get('/tambahpengambilan/{nik_ktp}', [PengambilanController::class, 'tambahpengambilan']);
Route::post('/pengambilanSaya/insert', [PengambilanController::class, 'store']);

Route::get('/pinjamanSaya/{users}', [PinjamController::class, 'pinjamanSaya']);
Route::get('/pengambilan/deletePengambilan/{id_pengambilan}', [PengambilanController::class, 'deletePengambilan']);
Route::get('/tambahpinjaman/{nik_ktp}', [PinjamController::class, 'tambahpinjaman']);
Route::get('/unreadNotifications', [PinjamController::class, 'unreadNotifications']);
Route::post('/pinjamanSaya/insert', [PinjamController::class, 'store']);
Route::get('/pinjamanSaya/detail/{no_pinjaman}', [PinjamController::class, 'detailPinjamanSaya']);
Route::get('/pinjamanSaya/cetakKwitansi/{no_pinjaman}', [PinjamController::class, 'cetakKwitansiPelunasan']);
Route::get('/simulasi', [PinjamController::class, 'simulasi']);

Route::get('/angsuranSaya/{users}', [AngsuranController::class, 'angsuranSaya']);
Route::get('/shuSaya/{users}', [ShuController::class, 'shuSaya']);
Route::get('/downloadSlipShu/{users}', [ShuController::class, 'pdfShu']);

Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('v_pengumuman');
// Route::get('/', [PengumumanController::class, 'indexHome'])->name('v_home');
Route::get('/detailPengumuman/{id_pengumuman}', [PengumumanController::class, 'detailPengumuman']);

Route::get('/belanjaku', [MitrakuController::class, 'index']);
Route::get('/detail-produk', [MitrakuController::class, 'detailProduk']);

//Hak Akses untuk Admin
Route::group(['middleware' => 'admin'], function () {
    Route::get('/pegawai', [PegawaiController::class, 'index'])->name('v_pegawai');
    Route::get('/pegawai/delete/{nik_ktp}', [PegawaiController::class, 'delete']);
    Route::get('/exportpegawai', [PegawaiController::class, 'pegawaiexport'])->name('exportpegawai');
    Route::post('/importpegawai', 'PegawaiController@pegawaiimportexcel')->name('importpegawai');
    Route::get('/pegawai/{pegawai}', [PegawaiController::class, 'show']);
    Route::get('/pegawai/edit/{nik_ktp}', [PegawaiController::class, 'edit']);
    Route::post('/pegawai/update/{pegawai}', [PegawaiController::class, 'update']);
    Route::get('/tambah', [PegawaiController::class, 'tambah']);
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('v_dashboard');

    Route::get('/anggota', [AnggotaController::class, 'index'])->name('v_anggota');
    Route::post('/pegawai/insert', [PegawaiController::class, 'store']);
    Route::get('/anggota/{pegawai}', [AnggotaController::class, 'show']);

    Route::get('/pendaftaran', [PendaftaranController::class, 'index']);
    Route::get('/cetakPendaftaran/{id_pendaftaran}', [PendaftaranController::class, 'CetakPendaftaran'])->name('v_cetakPendaftaran');
    Route::get('/pendaftaran/delete/{id_pendaftaran}', [PendaftaranController::class, 'delete']);

    Route::get('/export', 'UsersController@export');
    Route::post('/UsersImport', 'UsersController@usersimportexcel')->name('UsersImport');

    Route::get('/users', [UsersController::class, 'index'])->name('v_users');
    Route::get('/users/edit/{id}', [UsersController::class, 'edit']);
    Route::post('/users/update/{id}', [UsersController::class, 'update']);
    Route::get('/registrasi',[UsersController::class, 'registrasi'])->name('registrasi');
    Route::get('/registrasi/{nik_ktp}',[UsersController::class, 'getnamaUser']);
    Route::post('/simpanregistrasi',[UsersController::class, 'simpanregistrasi'])->name('simpanregistrasi');
    Route::get('/users/delete/{id}', [UsersController::class, 'delete']);
    Route::get('/status', 'UsersController@userOnlineStatus');

    // Route::get('/member', [MemberController::class, 'index'])->name('v_member');
    
    Route::get('/simpananAdmin', [SimpananController::class, 'index'])->name('v_simpananAdmin');
    Route::get('/simpananAdmin/edit/{id_simpanan}', [SimpananController::class, 'editSimpananAdmin']);
    Route::post('/simpananAdmin/update/{id_simpanan}', [SimpananController::class, 'updateAdmin']);
    Route::get('/simpananAdmin/delete/{id_simpanan}', [SimpananController::class, 'deleteAdmin']);
    Route::get('/simpananAdmin/detailSimpanan/{nik_ktp}',[SimpananController::class, 'detail'])->name('v_detailSimpanan');
    Route::get('/exportsimpanan', [SimpananController::class, 'simpananexport'])->name('exportsimpanan');
    Route::post('/importsimpanan', 'SimpananController@simpananimportexcel')->name('importsimpanan');

    
    Route::get('/pengambilan', [PengambilanController::class, 'index'])->name('v_pengambilanSimpanan');
    Route::get('/pengambilan/edit/{id_pengambilan}', [PengambilanController::class, 'editPengambilan']);
    Route::post('/pengambilan/update/{id_pengambilan}', [PengambilanController::class, 'update']);
    Route::get('/pengambilan/cetak/{id_pengambilan}', [PengambilanController::class, 'cetakPengambilan'])->name('v_cetakPengambilan');
    Route::get('/pengambilan/delete/{id_pengambilan}', [PengambilanController::class, 'delete']);
    Route::get('/exportpengambilan', [PengambilanController::class, 'pengambilanexport'])->name('exportpengambilan');
    Route::post('/importpenarikan', 'PengambilanController@penarikanimportexcel')->name('importpenarikan');

    Route::get('/pinjam', [PinjamController::class, 'index'])->name('v_pinjam');
    Route::get('/statusPinjam', [PinjamController::class, 'indexStatusPinjam'])->name('v_statusPinjam');
    Route::post('/pinjam', [PinjamController::class, 'search'])->name('v_pinjam');    
    Route::get('/pengajuan', [PinjamController::class, 'indexPengajuan'])->name('v_pengajuan');
    Route::post('/pengajuan', [PinjamController::class, 'searchPengajuan'])->name('v_pengajuan');
    
    Route::get('/cetak-data-pinjaman-pertanggal/{formDate}/{toDate}', [PinjamController::class, 'cetakPinjamanPertanggal'])->name('cetak-data-pinjaman-pertanggal');
    Route::get('/cetak-data-pinjaman-pertanggal-pengajuan/{formDate}/{toDate}', [PinjamController::class, 'cetakPinjamanPertanggalPengajuan'])->name('cetak-data-pinjaman-pertanggal-pengajuan');
    Route::get('/pinjam/edit/{no_pinjaman}', [PinjamController::class, 'editPinjaman']);
    Route::post('/pinjam/update/{no_pinjaman}', [PinjamController::class, 'update']);
    Route::get('/pinjam/editAkad/{no_pinjaman}', [PinjamController::class, 'editPinjamanAkad']);
    Route::post('/pinjam/updateAkad/{no_pinjaman}', [PinjamController::class, 'updateAkad']);
    Route::get('/pinjam/delete/{no_pinjaman}', [PinjamController::class, 'delete']);
    Route::get('/exportpinjaman', [PinjamController::class, 'pinjamanexport'])->name('exportpinjaman');
    Route::post('/importpinjaman', 'PinjamController@pinjamanimportexcel')->name('importpinjaman');
    Route::get('/tambahpinjamanByAdmin/{nik_ktp}','PinjamController@tambahPinjamanByAdmin');
    Route::post('/pinjamanByAdmin/insert', [PinjamController::class, 'storePinjaman'])->name('tambahpinjamanByAdmin.insert');

    Route::get('/pinjam/cetak/{no_pinjaman}', [PinjamController::class, 'cetakPinjaman'])->name('v_cetakPinjaman');
    Route::get('/pinjam/cetakNonProfit/{no_pinjaman}', [PinjamController::class, 'cetakPinjamanNonProfit'])->name('v_cetakPinjamanNonProfit');
    Route::get('/pinjam/cetak-akad/{no_pinjaman}', [PinjamController::class, 'cetakAkadPinjaman'])->name('v_cetakAkadPinjaman');
    Route::get('/downloadPdf/{no_pinjaman}', 'PinjamController@pdfPinjaman');
    
    Route::get('/angsuran', [AngsuranController::class, 'index'])->name('v_angsuran');
    Route::get('/angsuran/detail/{no_pinjaman}', [AngsuranController::class, 'detail']);
    Route::get('/angsuran/delete/{id_angsuran}', [AngsuranController::class, 'delete']);
    Route::get('/exportangsuran', [AngsuranController::class, 'angsuranexport'])->name('exportangsuran');
    Route::post('/importangsuran', 'AngsuranController@angsuranimportexcel')->name('importangsuran');
    Route::get('/angsuran/edit/{id_angsuran}', [AngsuranController::class, 'editAngsuran']);
    Route::post('/angsuran/update/{id_angsuran}', [AngsuranController::class, 'update']);


    Route::get('/shu', [ShuController::class, 'index'])->name('v_shu');
    Route::post('/shu', [ShuController::class, 'pushNotif'])->name('pushShu');
    Route::post('/importshu', 'ShuController@shuimportexcel')->name('importshu');
    Route::get('/shu/edit/{id_shu}', [ShuController::class, 'editShu']);
    Route::post('/shu/update/{id_shu}', [ShuController::class, 'update']);
    Route::get('/shu/delete/{id_shu}', [ShuController::class, 'delete']);

    Route::post('/pengumuman/insert', [PengumumanController::class, 'store'])->name('simpanPengumuman');
    Route::get('/pengumuman/edit/{id_pengumuman}', [PengumumanController::class, 'editPengumuman']);
    Route::post('/pengumuman/update/{id_pengumuman}', [PengumumanController::class, 'update']);
    Route::get('/pengumuman/delete/{id_pengumuman}', [PengumumanController::class, 'delete']);


}); 

//Hak Akses untuk Ketua
Route::group(['middleware' => 'ketua'], function () {
    Route::get('/pinjamKetua', [PinjamController::class, 'indexKetua'])->name('v_pinjamKetua');
    Route::post('/pinjamKetua', [PinjamController::class, 'searchKetua'])->name('v_pinjamKetua');
    Route::get('/pengajuanKetua', [PinjamController::class, 'indexPengajuanKetua'])->name('v_pengajuanKetua');
    Route::post('/pengajuanKetua', [PinjamController::class, 'searchPengajuanKetua'])->name('v_pengajuanKetua');
    Route::get('/pinjamKetua/edit/{no_pinjaman}', [PinjamController::class, 'editPinjamanKetua']);
    Route::post('/pinjamKetua/update/{no_pinjaman}', [PinjamController::class, 'updatePinjamKetua']);
    Route::get('/pengambilanKetua', [PengambilanController::class, 'indexKetua'])->name('v_pengambilanSimpananKetua');
    Route::get('/pengambilanKetua/edit/{id_pengambilan}', [PengambilanController::class, 'editPengambilanKetua']);
    Route::post('/pengambilanKetua/update/{id_pengambilan}', [PengambilanController::class, 'updatePengambilanKetua']);
    Route::get('/ketua/dashboard', [HomeController::class, 'dashboard'])->name('v_dashboard');
});

//Hak Akses untuk HRBP
Route::group(['middleware' => 'hrbp'], function () {
    
    Route::get('/pinjamHrbp', [PinjamController::class, 'indexHrbp'])->name('v_pinjamHrbp');
    Route::post('/pinjamHrbp', [PinjamController::class, 'searchHrbp'])->name('v_pinjamHrbp');
    Route::get('/pengajuanHrbp', [PinjamController::class, 'indexPengajuanHrbp'])->name('v_pengajuanHrbp');
    Route::post('/pengajuanHrbp', [PinjamController::class, 'searchPengajuanHrbp'])->name('v_pengajuanHrbp');
    Route::get('/pinjamHrbp/edit/{no_pinjaman}', [PinjamController::class, 'editPinjamanHrbp']);
    Route::post('/pinjamHrbp/update/{no_pinjaman}', [PinjamController::class, 'updatePinjamHrbp']);
    Route::get('/hrbp/dashboard', [HomeController::class, 'dashboard'])->name('v_dashboard');

});
//Hak Akses untuk Bendahara
Route::group(['middleware' => 'bendahara'], function () {
    Route::get('/pinjamBendahara', [PinjamController::class, 'indexBendahara'])->name('v_pinjamBendahara');
    Route::post('/pinjamBendahara', [PinjamController::class, 'searchBendahara'])->name('v_pinjamBendahara');
    Route::get('/pengajuanBendahara', [PinjamController::class, 'indexPengajuanBendahara'])->name('v_pengajuanBendahara');
    Route::post('/pengajuanBendahara', [PinjamController::class, 'searchPengajuanBendahara'])->name('v_pengajuanBendahara');
    Route::get('/pinjamBendahara/edit/{no_pinjaman}', [PinjamController::class, 'editPinjamanBendahara']);
    Route::post('/pinjamBendahara/update/{no_pinjaman}', [PinjamController::class, 'updatePinjamBendahara']);
   
    Route::get('/simpanan', [SimpananController::class, 'index'])->name('v_simpanan');
    Route::get('/simpanan/tambah', [SimpananController::class, 'tambah']);
    Route::post('/simpanan/insert', [SimpananController::class, 'store'])->name('simpansimpanan');
    Route::get('/simpanan/edit/{id_simpanan}', [SimpananController::class, 'editSimpanan']);
    Route::post('/simpanan/update/{id_simpanan}', [SimpananController::class, 'update']);
    Route::get('/simpanan/delete/{id_simpanan}', [SimpananController::class, 'delete']);
    Route::get('/simpanan/detailSimpanan/{nik_ktp}',[SimpananController::class, 'detail'])->name('v_detailSimpanan');
    
    Route::get('/pengambilanBendahara', [PengambilanController::class, 'indexBendahara'])->name('v_pengambilanSimpananBendahara');
    Route::get('/pengambilanBendahara/edit/{id_pengambilan}', [PengambilanController::class, 'editPengambilanBendahara']);
    Route::post('/pengambilanBendahara/update/{id_pengambilan}', [PengambilanController::class, 'updatePengambilanBendahara']);
    Route::get('/angsuran/tambah/{no_pinjaman}', [AngsuranController::class, 'tambahAngsuran']);
    Route::post('/angsuran/insert', [AngsuranController::class, 'store'])->name('simpanangsuran');
    Route::get('/bendahara/dashboard', [HomeController::class, 'dashboard'])->name('v_dashboard');

});
//Hak Akses untuk Pengurus
Route::group(['middleware' => 'pengurus'], function () {
    Route::get('/pinjamPengurus', [PinjamController::class, 'indexPengurus'])->name('v_pinjamPengurus');
    Route::post('/pinjamPengurus', [PinjamController::class, 'searchPengurus'])->name('v_pinjamPengurus');
    Route::get('/pengajuanPengurus', [PinjamController::class, 'indexPengajuanPengurus'])->name('v_pengajuanPengurus');
    Route::post('/pengajuanPengurus', [PinjamController::class, 'searchPengajuanPengurus'])->name('v_pengajuanPengurus');
    Route::get('/pengurus/dashboard', [HomeController::class, 'dashboard'])->name('v_dashboard');
});


