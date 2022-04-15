<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PengumumanModel extends Model
{
  
    protected $table = "pengumuman";
    protected $primaryKey = "id_pengumuman";
    protected $fillable = [
        'id_pengumuman','judul','isi','notifikasi','tgl_pengumuman','lampiran'
    ];

    public function allData()
    {
      return DB::table('pengumuman')
      ->get();
    }

    public function tambahPengumuman($data) 
    {
        DB::table('pengumuman')->insert($data);
    }

    public function editPengumuman($id_pengumuman, $data) 
    {
        DB::table('pengumuman')
        ->where("id_pengumuman", $id_pengumuman)
        ->update($data);
    }

    public function detailData($id_pengumuman)
    {
       return DB::table('pengumuman')->where('id_pengumuman', $id_pengumuman)->first();
    }

    public function deletePengumuman($id_pengumuman) 
    {
       
       DB::table('pengumuman')
          ->where("id_pengumuman", $id_pengumuman)
          ->delete();
    }
 
}
