<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PinjamanModel;
use App\Models\Pegawai;
use App\Models\UsersModel;
use App\Models\User;
use App\Models\AngsuranModel;
use App\Models\levelPinjamanModel;
use App\Exports\PinjamanExport;
use App\Imports\PinjamanImport;
use App\Notifications\RepliedToThread;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Notification;
use PDF;
use Auth;
use Dompdf\Dompdf;
use Excel;

class PinjamController extends Controller
{
    public function __construct()
    {
        $this->PinjamanModel = new PinjamanModel();
        $this->middleware('auth');
    }

    public function unreadNotifications() {
        $unreadNotifications = Auth()->user()->unreadNotifications;
        return response()->json($unreadNotifications);
    }
// admin
    public function index()
   {
            $pinjaman = DB::table('pinjaman')
            ->join('pegawai','pinjaman.nik_ktp','=','pegawai.nik_ktp')
            ->join('users','pinjaman.nik_ktp','=','users.nik_ktp')
            ->orderBy('tgl_pengajuan','desc')
            ->whereIn('posisi',['Sudah Akad','Belum Akad','Non Pengembangan'])
            ->get();
            $jumlahPinjaman = $pinjaman->sum('plafon');
            $pegawai = DB::table('pegawai')->get();
            $dataUser = UsersModel::all();
            $user = Auth::user();
        
        // dd ($user);
        return view('v_pinjaman', compact('pinjaman','pegawai','dataUser','jumlahPinjaman','user'));
    }
    
        public function indexStatusPinjam()
    {
       

            $pinjaman = PinjamanModel::select('angsuran','tenor','unit','spesifikasi','merk','nama_barang','nama','jenis_pinjaman','posisi','total_kredit','plafon','nama','pinjaman.nik_ktp','tgl_pengajuan','users.telp','pinjaman.no_pinjaman',DB::raw('sum(angsuran.jumlah_angsuran) as total_angsuran'))

            ->join('angsuran','angsuran.no_pinjaman','=','pinjaman.no_pinjaman')
            ->groupBy('angsuran','tenor','unit','spesifikasi','merk','nama_barang','nama','jenis_pinjaman','posisi','total_kredit','plafon','nama','pinjaman.nik_ktp','pinjaman.no_pinjaman','users.telp','tgl_pengajuan')
            ->join('users','pinjaman.nik_ktp','=','users.nik_ktp')
            ->orderBy('tgl_pengajuan','desc')
            ->get();
            $jumlahPinjaman = $pinjaman->sum('plafon');

        // dd ($pinjaman);
        return view('v_statusPinjaman', compact('pinjaman','jumlahPinjaman'));
    }

    public function indexPengajuan()
    {
        $pinjaman = DB::table('pinjaman')
        ->join('pegawai','pinjaman.nik_ktp','=','pegawai.nik_ktp')
        ->join('users','pinjaman.nik_ktp', '=', 'users.nik_ktp')
        ->orderBy('tgl_pengajuan','desc')
        ->whereIn('posisi',['Belum BS','Pengajuan'])
        ->get();
        $jumlahPinjaman = $pinjaman->sum('plafon');
        $pegawai = DB::table('pegawai')->get();
        $dataUser = UsersModel::all();


        // dd ($jumlahPinjaman);
        return view('v_pengajuan', compact('pinjaman','pegawai','dataUser','jumlahPinjaman'));
    }

    public function search(Request $request)
    {
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');
        $dataUser = UsersModel::all();
       $pinjaman = DB::table('pinjaman')->select()
       ->join('pegawai','pinjaman.nik_ktp', '=', 'pegawai.nik_ktp')
       ->join('users','pinjaman.nik_ktp', '=', 'users.nik_ktp')
       ->orderBy('tgl_pengajuan','desc')
       ->where('tgl_pengajuan',">=", $fromDate)
       ->where('tgl_pengajuan',"<=", $toDate)
        ->whereIn('posisi',['Sudah Akad','Belum Akad','Non Pengembangan'])
       ->get();
       $jumlahPinjaman = $pinjaman->sum('plafon');

    //    dd($query);
        return view('v_pinjaman',compact('pinjaman','dataUser','jumlahPinjaman'));
    }

    public function searchPengajuan(Request $request)
    {
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');
        $dataUser = UsersModel::all();


       $pinjaman = DB::table('pinjaman')->select()
       ->join('pegawai','pinjaman.nik_ktp', '=', 'pegawai.nik_ktp')
       ->join('users','pinjaman.nik_ktp', '=', 'users.nik_ktp')
       ->orderBy('tgl_pengajuan','desc')
       ->where('tgl_pengajuan',">=", $fromDate)
       ->where('tgl_pengajuan',"<=", $toDate)
       ->whereIn('posisi',['Pengajuan','Belum BS'])
       ->get();
       $jumlahPinjaman = $pinjaman->sum('plafon');

    //    dd($query);
        return view('v_pengajuan',compact('pinjaman','dataUser','jumlahPinjaman'));
    }

    public function tambahPinjamanByAdmin($nik_ktp) 
    {
        $user_id = UsersModel::where('nik_ktp',$nik_ktp)
        ->get();
        // $pegawais = Pegawai::all();
        $pegawais = DB::table('pegawai')
        ->where('nik_ktp', $nik_ktp)
        ->get();
        
        // dd ($user_id);
        return view('v_tambahPinjamAdmin', compact('pegawais','user_id'));
       
    }

    public function storePinjaman(Request $request, UsersModel $users)
    {
        $users = User::all()
        ->whereIn('level',[2, 4, 5]);
        Request()->validate([
            'nama_barang' => 'required',
            'spesifikasi' => 'required',
            'plafon' => 'required',
            'merk' => 'required',
            'unit' => 'required',
            'tenor' => 'required',
            'jenis_pinjaman' => 'required',
        ],[
            'nama_barang.required'=>'Nama barang Wajib Diisi !!!',
            'spesifikasi.required'=>'Spesifikasi Wajib Diisi !!!',
            'plafon.required'=>'Plafon Wajib Diisi !!!',
            'merk.required'=>'Merk Wajib Diisi !!!',
            'unit.required'=>'Unit Wajib Diisi !!!',
            'tenor.required'=>'Tenor Wajib Diisi !!!',
            'jenis_pinjaman.required'=>'Jenis pinjaman Wajib Diisi !!!',
        ]);   
        $request = [
            'id_user' => Request()->id_user,
            'no_pinjaman' => Request()->no_pinjaman,
            'nik_ktp' => Request()->nik_ktp,
            'nama' => Request()->nama,
            'nik_karyawan' => Request()->nik_karyawan,
            'jabatan' => Request()->jabatan,
            'jenis_pinjaman' => Request()->jenis_pinjaman,
            'nama_barang' => Request()->nama_barang,
            'merk' => Request()->merk,
            'Spesifikasi' => Request()->spesifikasi,
            'unit' => Request()->unit,
            'plafon' => Request()->plafon,
            'tenor' => Request()->tenor,
            'angsuran' => Request()->angsuran,
            'notifikasi' => Request()->notifikasi,
            'total_kredit' => Request()->total_kredit,

        ];
        $this->PinjamanModel->tambahPinjaman($request);

        Notification::send($users, new RepliedToThread($request));
        // dd($request);
        return redirect()->route('v_pengajuan')->with('pesan', 'Selamat, pengajuan pinjaman kredit anda berhasil dikirim!, Cek di data pinjaman Anda ');
    }

    public function update(Request $request, $no_pinjaman)
    { Request()->validate([
            'nama_barang' => 'required',
            'spesifikasi' => 'required',
            'bunga' => 'required',
            'merk' => 'required',
            'tenor' => 'required',
            'status_pengajuan' => 'required',
            'periode_angsuran' => 'required',
            'plafon' => 'required',
            'note' => 'required',
        ],[  
            'nama_barang.required'=>'*) nama barang tidak boleh kosong !',
            'spesifikasi.required'=>'*) spesifikasi wajib di isi !',
            'bunga.required'=>'*) pengembangan wajib di isi !',
            'merk.required'=>'*) merk tidak boleh kosong !',
            'tenor.required'=>'*) merk tidak boleh kosong !',
            'periode_angsuran.required'=>'*) periode angsuran wajib di isi !',
            'plafon.required'=>'*) plafon wajib di isi !',
            'note.required'=>'*) Catatan tidak boleh kosong',
        ]);      
        $id_user = PinjamanModel::where('no_pinjaman', $no_pinjaman)
        ->pluck('id_user');
        
        $users = user::where('id',$id_user)
        ->orWhereIn('level',[2,4,5])
        ->get();

        $request = [
            'jenis_pinjaman' => Request()->jenis_pinjaman,
            'nama_barang' => Request()->nama_barang,
            'spesifikasi' => Request()->spesifikasi,
            'tenor' => Request()->tenor,
            'merk' => Request()->merk,
            'bunga' => Request()->bunga,
            'total_kredit' => Request()->total_kredit,
            'angsuran' => Request()->angsuran,
            'periode_angsuran' => Request()->periode_angsuran,
            'status_pengajuan' => Request()->status_pengajuan,
            'tgl_verifikasi' => Request()->tgl_verifikasi,
            'verifikator' => Request()->verifikator,
            'tgl_disetujui_ketua' => Request()->tgl_disetujui,
            'disetujui_ketua' => Request()->disetujui_ketua,
            'notifikasi' => Request()->notifikasi,
            'plafon' => Request()->plafon,
            'note' => Request()->note,
        ];
        $this->PinjamanModel->editPinjaman($no_pinjaman, $request);
        Notification::send($users, new RepliedToThread($request));
        // dd ($users);
         return redirect()->route('v_pengajuan')->with('pesan', 'Data Berhasil Diupdate !!!');
    }

    public function editPinjaman($no_pinjaman)
    {
        $pinjaman = PinjamanModel::where('no_pinjaman',$no_pinjaman)
        ->join('pegawai','pinjaman.nik_ktp','=','pegawai.nik_ktp')
        ->join('users','pinjaman.nik_ktp', '=', 'users.nik_ktp')
        ->get();
        $jml_angsuran = AngsuranModel::where('no_pinjaman',$no_pinjaman)->sum('jumlah_angsuran');
  

        // dd($level);
        return view('v_editPinjaman', compact('pinjaman','jml_angsuran'));
    }

    public function editPinjamanAkad($no_pinjaman)
    {
        $pinjaman = PinjamanModel::where('no_pinjaman',$no_pinjaman)
        ->join('pegawai','pinjaman.nik_ktp','=','pegawai.nik_ktp')
        ->join('users','pinjaman.nik_ktp', '=', 'users.nik_ktp')
        ->get();
        $jml_angsuran = AngsuranModel::where('no_pinjaman',$no_pinjaman)->sum('jumlah_angsuran');

        // dd($level);
        return view('v_editPinjamanAkad', compact('pinjaman','jml_angsuran'));
    }

    public function delete($no_pinjaman) 
    {
        $pinjaman= $this->PinjamanModel->detailData($no_pinjaman);
        $this->PinjamanModel->deletePinjaman($no_pinjaman);
        return redirect()->route('v_pengajuan')->with('pesan', 'Data Berhasil Dihapus !!!');
    }

    public function cetakPinjaman($no_pinjaman)
    {
        $pinjaman = DB::table('pinjaman')
        ->join('pegawai','pinjaman.nik_ktp','=','pegawai.nik_ktp')
        ->join('users','pinjaman.nik_ktp','=','users.nik_ktp')
        ->where('no_pinjaman', $no_pinjaman)
        ->get(); 
        // dd ($pinjaman);
        return view('v_cetakPinjaman', compact('pinjaman'));
    }

    public function cetakAkadPinjaman($no_pinjaman)
    {
        $pinjaman = $this->PinjamanModel->allData()
        ->where('no_pinjaman', $no_pinjaman); 
        // dd ($pinjaman);
        return view('v_cetakAkadPinjaman', compact('pinjaman'));
    }

    public function cetakPinjamanNonProfit($no_pinjaman)
    {
        $pinjaman = $this->PinjamanModel->allData()
        ->where('no_pinjaman', $no_pinjaman); 
        //dd ($pinjaman);
        return view('v_cetakPinjamanNonProfit', compact('pinjaman'));
    }

    public function cetakKwitansiPelunasan($no_pinjaman)
    {
        $pinjaman = PinjamanModel::where('no_pinjaman',$no_pinjaman)
        ->join('pegawai','pinjaman.nik_ktp','=','pegawai.nik_ktp')
        ->join('users','pinjaman.nik_ktp', '=', 'users.nik_ktp')
        ->get();
        // dd ($pinjaman,$total_kredit);
        return view('v_cetakKwitansiPelunasan', compact('pinjaman'));
    }

    public function pinjamanexport() {
        return Excel::download(new PinjamanExport,'Pinjaman.xlsx');
    }

    public function pinjamanimportexcel(Request $request) {
        // validasi
		$this->validate($request, [
			'file' => 'required|mimes:xls,xlsx'
		]);
        $import = new PinjamanImport;
        $file = $request->file('file');
        $namaFile = date(date('d-m-Y')).$file->getClientOriginalName();
        $import->import($file);
        $file->move('storage/DataPinjaman', $namaFile);
        return back()->with('success','Data berhasil di import');
    }

    public function cetakPinjamanPertanggalPengajuan($fromDate, $toDate)
    {
    
        $cetakPertanggal = PinjamanModel::with('pegawai')
        
        ->whereBetween('tgl_pengajuan',[$fromDate,$toDate])
        ->whereIn('posisi',['Pengajuan','Belum BS'])
        ->orderBy('tgl_pengajuan','desc')
        ->get();
        $sumTotal = $cetakPertanggal->sum('plafon');
        // dd($cetakPertanggal);
        return view('v_cetakPinjamanPertanggal', compact('cetakPertanggal','fromDate','toDate','sumTotal'));
    }

    public function cetakPinjamanPertanggal($fromDate, $toDate)
    {
    
        $cetakPertanggal = PinjamanModel::with('pegawai')
        ->whereBetween('tgl_pengajuan',[$fromDate,$toDate])
        ->where('posisi','Sudah Akad')
        ->orderBy('tgl_pengajuan','desc')
        ->get();
        $sumTotal = $cetakPertanggal->sum('plafon');
        // dd($cetakPertanggal);
        return view('v_cetakPinjamanPertanggal', compact('cetakPertanggal','fromDate','toDate','sumTotal'));
    }

    public function updateAkad(Request $request,  $no_pinjaman) 
    {
        Request()->validate([
            'jenis_pinjaman' => 'required',
            'nama_barang' => 'required',
            'merk' => 'required',
            'spesifikasi' => 'required',
            'unit' => 'required',
            'plafon' => 'required',
            'tenor' => 'required',
            'periode_angsuran' => 'required',
            'total_kredit' => 'required',
            'angsuran' => 'required',
            'bunga' => 'required',
            'posisi' => 'required',
        ],[
            'jenis_pinjaman.required'=>' Jenis pinjaman wajib Diisi !!!',
            'nama_barang.required'=>' Nama barang/jasa wajib Diisi !!!',
            'merk.required'=>' Merk wajib Diisi !!!',
            'spesifikasi.required'=>' Spesifikasi wajib Diisi !!!',
            'unit.required'=>' Unit wajib Diisi !!!',
            'periode_angsuran.required'=>' Jatuh tempo wajib Diisi !!!',
            'plafon.required'=>' Plafon wajib Diisi !!!',
            'posisi.required'=>' Status wajib Diisi !!!',
            'tenor.required'=>' Tenor wajib Diisi !!!',
            'bunga.required'=>' Pengembangan wajib Diisi !!!',
        ]);
        $request = [
            'jenis_pinjaman'=> Request()->jenis_pinjaman,
            'nama_barang'=> Request()->nama_barang,
            'merk'=> Request()->merk,
            'spesifikasi'=> Request()->spesifikasi,
            'unit'=> Request()->unit,
            'periode_angsuran'=> Request()->periode_angsuran,
            'plafon'=> Request()->plafon,
            'tenor'=> Request()->tenor,
            'total_kredit' => Request()->total_kredit,
            'angsuran' => Request()->angsuran,
            'posisi'=> Request()->posisi,
            'bunga'=> Request()->bunga,
        ];
        $this->PinjamanModel->editPinjaman( $no_pinjaman, $request);
        return redirect('/pinjam')->with('pesan', 'Update data successfully');
    }
// Ketua
    public function indexKetua()
    {
        $pinjaman = PinjamanModel::orderBy('tgl_pengajuan','desc')
        ->join('pegawai','pinjaman.nik_ktp','=','pegawai.nik_ktp')
        ->join('users','pinjaman.nik_ktp', '=', 'users.nik_ktp')
        ->orderBy('tgl_pengajuan','desc')
        ->whereIn('posisi',['Sudah Akad','Belum Akad','Non Pengembangan'])
        ->get();
        $jumlahPinjaman = $pinjaman->sum('plafon');

        // dd ($datas, $data);
        return view('v_pinjamanKetua', compact('pinjaman','jumlahPinjaman'));
    }

    public function indexPengajuanKetua()
    {
        $pinjaman = DB::table('pinjaman')
        ->join('pegawai','pinjaman.nik_ktp','=','pegawai.nik_ktp')
        ->join('users','pinjaman.nik_ktp', '=', 'users.nik_ktp')
        ->orderBy('tgl_pengajuan','desc')
        ->whereIn('posisi',['Belum BS','Pengajuan'])
        ->get();
        $jumlahPinjaman = $pinjaman->sum('plafon');
        $pegawai = DB::table('pegawai')->get();
        $dataUser = UsersModel::all();
        // dd ($jumlahPinjaman);
        return view('v_pengajuanKetua', compact('pinjaman','pegawai','dataUser','jumlahPinjaman'));
    }

    public function searchKetua(Request $request)
    {
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');
        $dataUser = UsersModel::all();

       $pinjaman = DB::table('pinjaman')->select()
       ->join('pegawai','pinjaman.nik_ktp', '=', 'pegawai.nik_ktp')
       ->join('users','pinjaman.nik_ktp', '=', 'users.nik_ktp')
       ->orderBy('tgl_pengajuan','desc')
       ->where('tgl_pengajuan',">=", $fromDate)
       ->where('tgl_pengajuan',"<=", $toDate)
       ->whereIn('posisi',['Sudah Akad','Belum Akad','Non Pengembangan'])
       ->get();
       $jumlahPinjaman = $pinjaman->sum('plafon');

    //    dd($query);
        return view('v_pinjamanKetua',compact('pinjaman','dataUser','jumlahPinjaman'));
    }

    public function searchPengajuanKetua(Request $request)
    {
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');
        $dataUser = UsersModel::all();


       $pinjaman = DB::table('pinjaman')->select()
       ->join('pegawai','pinjaman.nik_ktp', '=', 'pegawai.nik_ktp')
       ->join('users','pinjaman.nik_ktp', '=', 'users.nik_ktp')
       ->orderBy('tgl_pengajuan','desc')
       ->where('tgl_pengajuan',">=", $fromDate)
       ->where('tgl_pengajuan',"<=", $toDate)
       ->whereIn('posisi',['Pengajuan','Belum BS'])
       ->get();
       $jumlahPinjaman = $pinjaman->sum('plafon');

    //    dd($query);
        return view('v_pengajuanKetua',compact('pinjaman','dataUser','jumlahPinjaman'));
    }

    public function editPinjamanKetua($no_pinjaman)
    {
        $id_user = PinjamanModel::where('no_pinjaman', $no_pinjaman)
        ->pluck('id_user');
        $users = User::where('id', $id_user)
        ->get();
        $pinjaman = PinjamanModel::where('no_pinjaman',$no_pinjaman)
        ->join('pegawai','pinjaman.nik_ktp','=','pegawai.nik_ktp')
        ->join('users','pinjaman.nik_ktp', '=', 'users.nik_ktp')
        ->get();
        $jml_angsuran = AngsuranModel::where('no_pinjaman',$no_pinjaman)->sum('jumlah_angsuran');
        $nik_hrbp = PinjamanModel::where('no_pinjaman',$no_pinjaman)->pluck('disetujui_hrbp');
        $users_hrbp = UsersModel::where('nik_ktp',$nik_hrbp)->get();
        // dd($users);
        return view('v_editPinjamanKetua', compact('pinjaman','jml_angsuran','users_hrbp'));
    }

    public function updatePinjamKetua(Request $request, $no_pinjaman)
    {
        $id_user = PinjamanModel::where('no_pinjaman', $no_pinjaman)
        ->pluck('id_user');
        
        $users = user::where('id',$id_user)
        ->orWhereIn('level',[2,4,6])
        ->get();

        $request = [
            'ttd_ketua' => Request()->ttd_ketua,
            'tgl_disetujui_ketua' => Request()->tgl_disetujui_ketua,
            'disetujui_ketua' => Request()->disetujui_ketua,
            'notifikasi' => Request()->notifikasi,
            'posisi' => Request()->posisi,
        ];
        $this->PinjamanModel->editPinjaman($no_pinjaman, $request);
        Notification::send($users, new RepliedToThread($request));
        // dd($users);
        return redirect()->route('v_pengajuanKetua')->with('pesan', 'Cek di data pengajuan pinjaman');
    }



// HRBP
    public function indexHrbp()
    {
        $pinjaman = PinjamanModel::orderBy('tgl_pengajuan','desc')
        ->join('pegawai','pinjaman.nik_ktp','=','pegawai.nik_ktp')
        ->join('users','pinjaman.nik_ktp', '=', 'users.nik_ktp')
        ->orderBy('tgl_pengajuan','desc')
        ->whereIn('posisi',['Sudah Akad','Belum Akad','Non Pengembangan'])
        ->get();
        
        $pinjaman_total = DB::table('pinjaman')
        ->join('pegawai','pinjaman.nik_ktp','=','pegawai.nik_ktp')
        ->join('users','pinjaman.nik_ktp', '=', 'users.nik_ktp')
        ->orderBy('tgl_pengajuan','desc')
        ->whereIn('posisi',['Sudah Akad','Belum Akad','Non Pengembangan'])
        ->get();
        
        $jumlahPinjaman = $pinjaman->sum('plafon');
        $jumlahPinjamanTotal = $pinjaman_total->sum('plafon');
        // dd ($datas, $data);
        return view('v_pinjamanHrbp', compact('pinjaman','jumlahPinjaman','jumlahPinjamanTotal'));
    }

    public function indexPengajuanHrbp()
    {
        $pinjaman = DB::table('pinjaman')
        ->join('pegawai','pinjaman.nik_ktp','=','pegawai.nik_ktp')
        ->join('users','pinjaman.nik_ktp', '=', 'users.nik_ktp')
        ->orderBy('tgl_pengajuan','desc')
        ->whereIn('posisi',['Belum BS','Pengajuan'])
        ->get();
        
        $pinjaman_total = DB::table('pinjaman')
        ->join('pegawai','pinjaman.nik_ktp','=','pegawai.nik_ktp')
        ->join('users','pinjaman.nik_ktp', '=', 'users.nik_ktp')
        ->orderBy('tgl_pengajuan','desc')
        ->whereIn('posisi',['Belum BS','Pengajuan'])
        ->get();
        
        $jumlahPinjaman = $pinjaman->sum('plafon');
        $jumlahPinjamanTotal = $pinjaman_total->sum('plafon');
        $pegawai = DB::table('pegawai')->get();
        $dataUser = UsersModel::all();
        // dd ($jumlahPinjaman);
        return view('v_pengajuanHrbp', compact('pinjaman','pegawai','dataUser','jumlahPinjaman','jumlahPinjamanTotal'));
    }

    public function searchHrbp(Request $request)
    {
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');
        $dataUser = UsersModel::all();

       $pinjaman = DB::table('pinjaman')->select()
       ->join('pegawai','pinjaman.nik_ktp', '=', 'pegawai.nik_ktp')
       ->join('users','pinjaman.nik_ktp', '=', 'users.nik_ktp')
       ->orderBy('tgl_pengajuan','desc')
       ->where('tgl_pengajuan',">=", $fromDate)
       ->where('tgl_pengajuan',"<=", $toDate)
       ->whereIn('posisi',['Sudah Akad','Belum Akad','Non Pengembangan'])
       ->get();
       
      $pinjaman_total = DB::table('pinjaman')->select()
       ->join('pegawai','pinjaman.nik_ktp', '=', 'pegawai.nik_ktp')
       ->join('users','pinjaman.nik_ktp', '=', 'users.nik_ktp')
       ->orderBy('tgl_pengajuan','desc')
       ->where('tgl_pengajuan',">=", $fromDate)
       ->where('tgl_pengajuan',"<=", $toDate)
       ->whereIn('posisi',['Sudah Akad','Belum Akad','Non Pengembangan'])
       ->get();
       
       $jumlahPinjaman = $pinjaman->sum('plafon');
        $jumlahPinjamanTotal = $pinjaman_total->sum('plafon');
    //    dd($query);
        return view('v_pinjamanHrbp',compact('pinjaman','dataUser','jumlahPinjaman','jumlahPinjamanTotal'));
    }

    public function searchPengajuanHrbp(Request $request)
    {
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');
        $dataUser = UsersModel::all();


       $pinjaman = DB::table('pinjaman')->select()
       ->join('pegawai','pinjaman.nik_ktp', '=', 'pegawai.nik_ktp')
       ->join('users','pinjaman.nik_ktp', '=', 'users.nik_ktp')
       ->orderBy('tgl_pengajuan','desc')
       ->where('tgl_pengajuan',">=", $fromDate)
       ->where('tgl_pengajuan',"<=", $toDate)
       ->whereIn('posisi',['Pengajuan','Belum BS'])
       ->get();
       
        $pinjaman_total = DB::table('pinjaman')->select()
       ->join('pegawai','pinjaman.nik_ktp', '=', 'pegawai.nik_ktp')
       ->join('users','pinjaman.nik_ktp', '=', 'users.nik_ktp')
       ->orderBy('tgl_pengajuan','desc')
       ->where('tgl_pengajuan',">=", $fromDate)
       ->where('tgl_pengajuan',"<=", $toDate)
       ->whereIn('posisi',['Pengajuan','Belum BS'])
       ->get();
       
       $jumlahPinjaman = $pinjaman->sum('plafon');
    $jumlahPinjamanTotal = $pinjaman_total->sum('plafon'); 
    //    dd($query);
        return view('v_pengajuanHrbp',compact('pinjaman','dataUser','jumlahPinjaman','jumlahPinjamanTotal'));
    }

    public function editPinjamanHrbp($no_pinjaman)
    {
        $pinjaman = PinjamanModel::where('no_pinjaman',$no_pinjaman)
        ->join('pegawai','pinjaman.nik_ktp','=','pegawai.nik_ktp')
        ->join('users','pinjaman.nik_ktp', '=', 'users.nik_ktp')
        ->get();
        $jml_angsuran = AngsuranModel::where('no_pinjaman',$no_pinjaman)->sum('jumlah_angsuran');
        // dd($level);
        return view('v_editPinjamanHrbp', compact('pinjaman','jml_angsuran'));
    }

    public function updatePinjamHrbp(Request $request, $no_pinjaman)
    {
        $id_user = PinjamanModel::where('no_pinjaman', $no_pinjaman)
        ->pluck('id_user');
        
        $users = user::where('id',$id_user)
        ->orWhereIn('level',[2,4,5])
        ->get();

        Request()->validate([
            'note' => 'required',
            ],[  
            'note.required'=>'*) Catatan tidak boleh kosong',
            ]);
        $request = [
            'ttd_hrbp' => Request()->ttd_hrbp,
            'tgl_disetujui_hrbp' => Request()->tgl_disetujui_hrbp,
            'disetujui_hrbp' => Request()->disetujui_hrbp,
            'notifikasi' => Request()->notifikasi,
            'note' => Request()->note,
        ];
        $this->PinjamanModel->editPinjaman($no_pinjaman, $request);
        Notification::send($users, new RepliedToThread($request));
        return redirect()->route('v_pengajuanHrbp')->with('pesan', 'Pengajuan telah disetujui, Cek di data pinjaman karyawan !!!');
    }

// Pengurus
    public function indexPengurus()
    {
        $pinjaman = PinjamanModel::orderBy('tgl_pengajuan','desc')
        ->join('pegawai','pinjaman.nik_ktp','=','pegawai.nik_ktp')
        ->join('users','pinjaman.nik_ktp', '=', 'users.nik_ktp')
        ->orderBy('tgl_pengajuan','desc')
        ->whereIn('posisi',['Sudah Akad','Belum Akad','Non Pengembangan'])
        ->get();
        
        $pinjaman_total = PinjamanModel::orderBy('tgl_pengajuan','desc')
        ->join('pegawai','pinjaman.nik_ktp','=','pegawai.nik_ktp')
        ->join('users','pinjaman.nik_ktp', '=', 'users.nik_ktp')
        ->orderBy('tgl_pengajuan','desc')
        ->whereIn('posisi',['Sudah Akad','Belum Akad','Non Pengembangan'])
        ->get();
        
        $jumlahPinjaman = $pinjaman->sum('plafon');
        $jumlahPinjamanTotal = $pinjaman_total->sum('plafon');
        // dd ($datas, $data);
        return view('v_pinjamanPengurus', compact('pinjaman','jumlahPinjaman','jumlahPinjamanTotal'));
    }

    public function indexPengajuanPengurus()
    {
        $pinjaman = DB::table('pinjaman')
        ->join('pegawai','pinjaman.nik_ktp','=','pegawai.nik_ktp')
        ->join('users','pinjaman.nik_ktp', '=', 'users.nik_ktp')
        ->orderBy('tgl_pengajuan','desc')
        ->whereIn('posisi',['Belum BS','Pengajuan'])
        ->get();
        $pinjaman_total = DB::table('pinjaman')
        ->join('pegawai','pinjaman.nik_ktp','=','pegawai.nik_ktp')
        ->join('users','pinjaman.nik_ktp', '=', 'users.nik_ktp')
        ->orderBy('tgl_pengajuan','desc')
        ->whereIn('posisi',['Belum BS','Pengajuan'])
        ->get();
        
        $jumlahPinjaman = $pinjaman->sum('plafon');
        $jumlahPinjamanTotal = $pinjaman_total->sum('plafon');
        $pegawai = DB::table('pegawai')->get();
        $dataUser = UsersModel::all();
        // dd ($jumlahPinjaman);
        return view('v_pengajuanPengurus', compact('pinjaman','pegawai','dataUser','jumlahPinjaman','jumlahPinjamanTotal'));
    }

    public function searchPengurus(Request $request)
    {
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');
        $dataUser = UsersModel::all();

    $pinjaman = DB::table('pinjaman')->select()
    ->join('pegawai','pinjaman.nik_ktp', '=', 'pegawai.nik_ktp')
    ->join('users','pinjaman.nik_ktp', '=', 'users.nik_ktp')
    ->orderBy('tgl_pengajuan','desc')
    ->where('tgl_pengajuan',">=", $fromDate)
    ->where('tgl_pengajuan',"<=", $toDate)
    ->whereIn('posisi',['Sudah Akad','Belum Akad','Non Pengembangan'])
    ->get();
    
    $pinjaman_total = DB::table('pinjaman')->select()
    ->join('pegawai','pinjaman.nik_ktp', '=', 'pegawai.nik_ktp')
    ->join('users','pinjaman.nik_ktp', '=', 'users.nik_ktp')
    ->orderBy('tgl_pengajuan','desc')
    ->where('tgl_pengajuan',">=", $fromDate)
    ->where('tgl_pengajuan',"<=", $toDate)
    ->whereIn('posisi',['Sudah Akad','Belum Akad','Non Pengembangan'])
    ->get();
    
    $jumlahPinjaman = $pinjaman->sum('plafon');
    $jumlahPinjamanTotal = $pinjaman_total->sum('plafon');
    //    dd($query);
        return view('v_pinjamanPengurus',compact('pinjaman','dataUser','jumlahPinjaman','jumlahPinjamanTotal'));
    }

    public function searchPengajuanPengurus(Request $request)
    {
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');
        $dataUser = UsersModel::all();


        $pinjaman = DB::table('pinjaman')->select()
        ->join('pegawai','pinjaman.nik_ktp', '=', 'pegawai.nik_ktp')
        ->join('users','pinjaman.nik_ktp', '=', 'users.nik_ktp')
        ->orderBy('tgl_pengajuan','desc')
        ->where('tgl_pengajuan',">=", $fromDate)
        ->where('tgl_pengajuan',"<=", $toDate)
        ->whereIn('posisi',['Pengajuan','Belum BS'])
        ->get();
        
        $pinjaman_total = DB::table('pinjaman')->select()
        ->join('pegawai','pinjaman.nik_ktp', '=', 'pegawai.nik_ktp')
        ->join('users','pinjaman.nik_ktp', '=', 'users.nik_ktp')
        ->orderBy('tgl_pengajuan','desc')
        ->where('tgl_pengajuan',">=", $fromDate)
        ->where('tgl_pengajuan',"<=", $toDate)
        ->whereIn('posisi',['Pengajuan','Belum BS'])
        ->get();
        
        $jumlahPinjaman = $pinjaman_total->sum('plafon');
        $jumlahPinjamanTotal = $pinjaman_total->sum('plafon');
        //    dd($query);
            return view('v_pengajuanPengurus',compact('pinjaman','dataUser','jumlahPinjaman','jumlahPinjamanTotal'));
        }

// Bendahara
    public function indexBendahara()
    {
        $pinjaman = DB::table('pinjaman')
        ->join('pegawai','pinjaman.nik_ktp','=','pegawai.nik_ktp')
        ->join('users','pinjaman.nik_ktp', '=', 'users.nik_ktp')
        ->orderBy('tgl_pengajuan','desc')
        ->whereIn('posisi',['Sudah Akad','Belum Akad','Non Pengembangan'])
        ->get();
        
        $pinjaman_total = DB::table('pinjaman')
        ->join('pegawai','pinjaman.nik_ktp','=','pegawai.nik_ktp')
        ->join('users','pinjaman.nik_ktp', '=', 'users.nik_ktp')
        ->orderBy('tgl_pengajuan','desc')
        ->whereIn('posisi',['Sudah Akad','Belum Akad','Non Pengembangan'])
        ->get();
        
        $jumlahPinjaman = $pinjaman->sum('plafon');
        $jumlahPinjamanTotal = $pinjaman_total->sum('plafon');
        // dd ($pinjaman);
        return view('v_pinjamanBendahara', compact('pinjaman','jumlahPinjaman','jumlahPinjamanTotal'));
    }

    public function indexPengajuanBendahara()
    {
        $pinjaman = DB::table('pinjaman')
        ->join('pegawai','pinjaman.nik_ktp','=','pegawai.nik_ktp')
        ->join('users','pinjaman.nik_ktp', '=', 'users.nik_ktp')
        ->orderBy('tgl_pengajuan','desc')
        ->whereIn('posisi',['Belum BS','Pengajuan'])
        ->get();
        
        $pinjaman_total = DB::table('pinjaman')
        ->join('pegawai','pinjaman.nik_ktp','=','pegawai.nik_ktp')
        ->join('users','pinjaman.nik_ktp', '=', 'users.nik_ktp')
        ->orderBy('tgl_pengajuan','desc')
        ->whereIn('posisi',['Belum BS','Pengajuan'])
        ->get();
        
        $jumlahPinjaman = $pinjaman->sum('plafon');
        $jumlahPinjamanTotal = $pinjaman_total->sum('plafon');
        $pegawai = DB::table('pegawai')->get();
        $dataUser = UsersModel::all();
        // dd ($jumlahPinjaman);
        return view('v_pengajuanBendahara', compact('pinjaman','pegawai','dataUser','jumlahPinjaman','jumlahPinjamanTotal'));
    }

    public function searchBendahara(Request $request)
    {
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');
        $dataUser = UsersModel::all();

       $pinjaman = DB::table('pinjaman')->select()
       ->join('pegawai','pinjaman.nik_ktp', '=', 'pegawai.nik_ktp')
       ->join('users','pinjaman.nik_ktp', '=', 'users.nik_ktp')
       ->orderBy('tgl_pengajuan','desc')
       ->where('tgl_pengajuan',">=", $fromDate)
       ->where('tgl_pengajuan',"<=", $toDate)
       ->whereIn('posisi',['Sudah Akad','Belum Akad','Non Pengembangan'])
       ->get();
       
        $pinjaman_total = DB::table('pinjaman')
        ->join('pegawai','pinjaman.nik_ktp','=','pegawai.nik_ktp')
        ->join('users','pinjaman.nik_ktp', '=', 'users.nik_ktp')
        ->orderBy('tgl_pengajuan','desc')
        ->whereIn('posisi',['Sudah Akad','Belum Akad','Non Pengembangan'])
        ->get();
        $jumlahPinjaman = $pinjaman->sum('plafon');
        $jumlahPinjamanTotal = $pinjaman_total->sum('plafon');
    //    dd($query);
        return view('v_pinjamanBendahara',compact('pinjaman','dataUser','jumlahPinjaman','jumlahPinjamanTotal'));
    }

    public function searchPengajuanBendahara(Request $request)
    {
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');
        $dataUser = UsersModel::all();


       $pinjaman = DB::table('pinjaman')->select()
       ->join('pegawai','pinjaman.nik_ktp', '=', 'pegawai.nik_ktp')
       ->join('users','pinjaman.nik_ktp', '=', 'users.nik_ktp')
       ->orderBy('tgl_pengajuan','desc')
       ->where('tgl_pengajuan',">=", $fromDate)
       ->where('tgl_pengajuan',"<=", $toDate)
       ->whereIn('posisi',['Pengajuan','Belum BS'])
       ->get();
       $jumlahPinjaman = $pinjaman->sum('plafon');

    //    dd($query);
        return view('v_pengajuanBendahara',compact('pinjaman','dataUser','jumlahPinjaman'));
    }

    public function updatePinjamBendahara(Request $request, $no_pinjaman)
    {
        $id_user = PinjamanModel::where('no_pinjaman', $no_pinjaman)
        ->pluck('id_user');
        
        $users = user::where('id',$id_user)
        ->orWhereIn('level',[2,4,5])
        ->get();

        Request()->validate([
            'posisi' => 'required',
            ],[  
            'posisi.required'=>'*) Status tidak boleh kosong',
            ]);
        $request = [
            'notifikasi' => Request()->notifikasi,
            'posisi' => Request()->posisi,
        ];
        $this->PinjamanModel->editPinjaman($no_pinjaman, $request);
        Notification::send($users, new RepliedToThread($request));
        return redirect('/pinjamBendahara')->with('pesan', 'Status Pinjaman berhasil di update ');
    }

    public function editPinjamanBendahara($no_pinjaman)
    {
        $pinjaman = PinjamanModel::where('no_pinjaman',$no_pinjaman)
        ->join('pegawai','pinjaman.nik_ktp','=','pegawai.nik_ktp')
        ->join('users','pinjaman.nik_ktp', '=', 'users.nik_ktp')
        ->get();
        $nik_hrbp = PinjamanModel::where('no_pinjaman',$no_pinjaman)->pluck('disetujui_hrbp');
        $nik_ketua = PinjamanModel::where('no_pinjaman',$no_pinjaman)->pluck('disetujui_ketua');
        $users_hrbp = UsersModel::where('nik_ktp',$nik_hrbp)->get();
        $users_ketua = UsersModel::where('nik_ktp',$nik_ketua)->get();

        $jml_angsuran = AngsuranModel::where('no_pinjaman',$no_pinjaman)->sum('jumlah_angsuran');
  

        // dd($users_hrbp);
        return view('v_editPinjamanBendahara', compact('pinjaman','jml_angsuran','users_hrbp','users_ketua'));
    }

// Anggota


    public function pinjamanSaya($nik_ktp)
    {
        $user = UsersModel::where('nik_ktp',$nik_ktp)->get();
        // $pegawai = $this->Pegawai->allData()->where('nik_ktp',$nik_ktp)->get();
        $pegawai = Pegawai::find($nik_ktp);
        $pinjaman = PinjamanModel::where('nik_ktp',$nik_ktp)->paginate();
        $jml_pinjaman = PinjamanModel::where('nik_ktp',$nik_ktp)->sum('plafon');
        $total_kredit = PinjamanModel::where('nik_ktp',$nik_ktp)->sum('total_kredit');
        $jml_angsuran = DB::table('angsuran')->where('nik_ktp',$nik_ktp)
        ->sum('jumlah_angsuran');
        
        
        // dd ($jml_angsuran);
        return view('v_pinjamanSaya', compact(['pegawai','user','pinjaman','jml_pinjaman','jml_angsuran','total_kredit']));
    }

    public function store(Request $request, UsersModel $users)
    {
        $users = User::all()
        ->whereIn('level',[2, 4, 5]);
        Request()->validate([
            'nama_barang' => 'required',
            'spesifikasi' => 'required',
            'plafon' => 'required',
            'merk' => 'required',
            'unit' => 'required',
        ],[
            'nama_barang.required'=>'Nama barang Wajib Diisi !!!',
            'spesifikasi.required'=>'Spesifikasi Wajib Diisi !!!',
            'plafon.required'=>'Plafon Wajib Diisi !!!',
            'merk.required'=>'Merk Wajib Diisi !!!',
            'unit.required'=>'Unit Wajib Diisi !!!',
        ]);
     
        $request = [
            'id_user' => Request()->id_user,
            'no_pinjaman' => Request()->no_pinjaman,
            'nik_ktp' => Request()->nik_ktp,
            'nama' => Request()->nama,
            'nik_karyawan' => Request()->nik_karyawan,
            'jabatan' => Request()->jabatan,
            'jenis_pinjaman' => Request()->jenis_pinjaman,
            'nama_barang' => Request()->nama_barang,
            'merk' => Request()->merk,
            'Spesifikasi' => Request()->spesifikasi,
            'unit' => Request()->unit,
            'plafon' => Request()->plafon,
            'tenor' => Request()->tenor,
            'angsuran' => Request()->angsuran,
            'total_kredit' => Request()->total_kredit,
            'notifikasi' => Request()->notifikasi,

        ];
        $this->PinjamanModel->tambahPinjaman($request);
        Notification::send($users, new RepliedToThread($request));
        // dd($users);
        return redirect('pinjamanSaya/'.auth()->user()->nik_ktp)->with('success', 'Selamat, pengajuan pinjaman kredit anda berhasil dikirim!, Cek di data pinjaman Anda ');
    }

    public function detailPinjamanSaya($no_pinjaman)
    {
        // $pinjaman = PinjamanModel::where('no_pinjaman',$no_pinjaman)->get();
        $pinjaman = PinjamanModel::where('no_pinjaman',$no_pinjaman)
        ->join('pegawai','pinjaman.nik_ktp','=','pegawai.nik_ktp')
        ->join('users','pinjaman.nik_ktp', '=', 'users.nik_ktp')
        ->get();
        $nik_hrbp = PinjamanModel::where('no_pinjaman',$no_pinjaman)->pluck('disetujui_hrbp');
        $nik_ketua = PinjamanModel::where('no_pinjaman',$no_pinjaman)->pluck('disetujui_ketua');
        $users_hrbp = UsersModel::where('nik_ktp',$nik_hrbp)->get();
        $users_ketua = UsersModel::where('nik_ktp',$nik_ketua)->get();
        $angsuran = AngsuranModel::where('no_pinjaman',$no_pinjaman)->get();
        $jml_angsuran = AngsuranModel::where('no_pinjaman',$no_pinjaman)->sum('jumlah_angsuran');
        $total_kredit = PinjamanModel::where('no_pinjaman',$no_pinjaman)->sum('total_kredit');
        // dd($id_user,$user);
        return view('v_detailPinjamanSaya', compact('pinjaman','angsuran','jml_angsuran','total_kredit','nik_hrbp','nik_ketua','users_hrbp','users_ketua'));
    }

    public function tambahpinjaman($nik_ktp) {
        //$pegawai = Pegawai::find($nik_ktp);
        $pegawai = Pegawai::where('nik_ktp',$nik_ktp)->get();
        //dd ($pegawai);
        return view('v_tambahpinjam', compact('pegawai'))
       
        ;
    }
    
        public function simulasi() 
    {

        return view('v_simulasi');
    }
}
