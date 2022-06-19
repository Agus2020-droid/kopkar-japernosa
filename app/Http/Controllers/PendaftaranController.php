<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PendaftaranModel;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use App\Notifications\notifikasiRegister;


class PendaftaranController extends Controller
{
    public function __construct()
    {
        $this->PendaftaranModel = new PendaftaranModel();
    }

    public function index()
    {
       $pendaftaran = PendaftaranModel::orderBy('created_at','desc')
       ->get(); 

       return view('v_pendaftaran', compact('pendaftaran'));
    }

    public function simpanPendaftaran(Request $request,User $users)
    {
        $users = User::all()
        ->whereIn('level',[2]);
        $notif= [
            'notifikasi' => Request()->notifikasi,
            'foto_user' => Request()->foto_user,
            'name' => Request()->nama_lengkap,];
        Request()->validate([
            'nik_ktp' => 'required|max:16',
            'nama_lengkap' => 'required',
            'nik_karyawan' => 'required|max:6',
            'alamat_email' => 'required|email',
            'alamat_ktp' => 'required',
            'tmpt_lhr' => 'required',
            'tgl_lhr' => 'required',
            'telepon' => 'required',
            'tgl_masuk' => 'required',
            'status' => 'required',
            'file' => 'required|mimes:jpg,jpeg,bmp,png|max:3000',
        ],[
            'nik_ktp.required'=>'NIK KTP Wajib Diisi !!!',
            'nik_ktp.max'=>'NIK KTP 16 karakter',
            'nama_lengkap.required'=>'Nama tidak boleh kosong',
            'nik_karyawan.required'=>'NIK tidak boleh kosong',
            'nik_karyawan.max'=>'NIK Karyawan maksimal 6 digit',
            'alamat_email.required'=>'Email tidak boleh kosong',
            'alamat_email.email'=>'Email tidak valid',
            'alamat_ktp.required'=>'Alamat tempat tinggal tidak boleh kosong',
            'tmpt_lhr.required'=>'Tempat lahir tidak boleh kosong',
            'tgl_lhr.required'=>'Tanggal lahir tidak boleh kosong',
            'telepon.required'=>'No. Whatsapp tidak boleh kosong',
            'tgl_masuk.required'=>'Tanggal masuk kerja tidak boleh kosong',
            'status.required'=>'Status kerja tidak boleh kosong',
            'file.required'=>'Foto KTP harus diisi',
            'file.mimes'=>'file harus berekstensi : jpg,jpeg,bmp,png',
            'file.max'=>'Maks ukuran file : 3 mb',

        ]);
        $files = Request()->file;
        $filename = Request()->nik_ktp.'.'.$files->extension();
        $request->file('file')->storeAs('public/foto_ktp/',$filename);
        $files->move(public_path('storage/foto_ktp'), $filename);

        $fotoKry = Request()->foto_kry;
        $filenameKry = Request()->nik_ktp.'.'.$fotoKry->extension();
        $request->file('foto_kry')->storeAs('public/foto_user/',$filenameKry);
        $fotoKry->move(public_path('storage/foto_user'), $filenameKry);

        $request = [
            'nik_ktp' => Request()->nik_ktp,
            'nama_lengkap' => Request()->nama_lengkap,
            'nik_karyawan' => Request()->nik_karyawan,
            'alamat_email' => Request()->alamat_email,
            'alamat_ktp' => Request()->alamat_ktp,
            'tmpt_lhr' => Request()->tmpt_lhr,
            'tgl_lhr' => Request()->tgl_lhr,
            'telepon' => Request()->telepon,
            'tgl_masuk' => Request()->tgl_masuk,
            'status' => Request()->status,
            'notifikasi' => Request()->notifikasi,
            'file' => $filename,
            'foto_kry' => $filenameKry,
            'created_at' => Request()->created_at,
        ];
        $this->PendaftaranModel->simpan($request);
        Notification::send($users, new notifikasiRegister($notif));
       return redirect('/')->with('success', 'Sukses, Mohon tunggu informasi User akun dan password lewat WhatsApp dan email Anda');;
    }

    public function CetakPendaftaran($id_pendaftaran)
    {
        $detailPendaftar = PendaftaranModel::where('id_pendaftaran','=',$id_pendaftaran)
        ->get();

        // dd ($detailPendaftar);
        return view('v_cetakPendaftaran', compact('detailPendaftar'));
    }

    public function delete($id_pendaftaran) 
    {
        $pendaftaran= $this->PendaftaranModel->detailData($id_pendaftaran);
        $this->PendaftaranModel->deletePendaftaran($id_pendaftaran);
        return back()->with('success', 'Data berhasil dihapus !');
    }
}
