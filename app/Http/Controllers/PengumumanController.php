<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengumumanModel;
use App\Models\User;
use App\Notifications\RepliedToThread;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\DB;
use App\Models\VisitModel;


class PengumumanController extends Controller
{
    public function __construct()
    {
        $this->PengumumanModel = new PengumumanModel();
        $this->middleware('auth');
    }

    public function index()
    {
        $data = PengumumanModel::orderBy('tgl_pengumuman','desc')->paginate(10);
       
        // dd ($data);
        return view('v_pengumuman', compact('data'));
    }


    public function detailPengumuman($id_pengumuman)
    {
        PengumumanModel::find($id_pengumuman)->increment('views');
        $data = PengumumanModel::where('id_pengumuman', $id_pengumuman)->get();
       
        // dd ($data);
        return view('v_detailPengumuman', compact('data'));
    }

    public function store(Request $request)
     {
        $users = User::all();
        $notif = [
            'notifikasi' => Request()->notifikasi,
            'foto_user' => Request()->foto_user,
            'name' => Request()->name,
        ];
         Request()->validate([
            'judul' => 'required|max:50',
            'isi' => 'required',
            'lampiran' => 'mimes:jpg,jpeg,bmp,png|max:1024',
         ],[
            'judul.required'=>'Kolom judul wajib diisi.',
            'isi.required'=>'Kolom isi wajib diisi.',
            'lampiran.mimes'=>'Type file jpg,jpeg,bmp,png.',
            'lampiran.max'=>'Ukuran file max.1024 mb.',
         ]);
        
        $file = Request()->lampiran;
        $filename = Request()->judul.'.'.$file->extension();
        
        $request->file('lampiran')->storeAs('public/lampiran_pengumuman/',$filename);
        // $file->move(public_path('storage/lampiran_pengumuman'), $filename);
        $data = [
            'judul' => Request()->judul,
            'isi' => Request()->isi,
            'tgl_pengumuman' => Request()->tgl_pengumuman,
            'lampiran' => $filename,
            'notifikasi' => Request()->notifikasi,
            'author' => Request()->author,
        ];
        $this->PengumumanModel->tambahPengumuman($data);
        Notification::send($users, new RepliedToThread($notif));
        // dd($users,$data);
        return back()->with('success', 'Pengumuman berhasil di publish !!!');
    }

    public function delete($id_pengumuman) 
    {
        $pengumuman= $this->PengumumanModel->detailData($id_pengumuman);
        $this->PengumumanModel->deletePengumuman($id_pengumuman);
        return back()->with('success', 'Data Berhasil Dihapus !!!');
    }

    public function editPengumuman($id_pengumuman)
    {
        $pengumuman = PengumumanModel::where('id_pengumuman',$id_pengumuman)
        ->get();

        // dd($pengumuman);
        return view('v_editPengumuman', compact('pengumuman'));
    }

    public function update($id_pengumuman)
    {
        $data = [
          
            'judul' => Request()->judul,
            'isi' => Request()->isi,
            'author' => Request()->author,
        ];
        $this->PengumumanModel->editPengumuman($id_pengumuman, $data);
        return redirect('/pengumuman')->with('pesan', 'Sukses, pengumuman berhasil diupdate!!! ');
    }
}
