<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\jenissimpanan;
class Anggota extends Model
{
    protected $table = "anggota";
    protected $primaryKey = "id_anggota";
    protected $fillable = [
        'nik_anggota','nama_anggota','tempat_lahir','tgl_lahir','status','alamat_anggota','telp','tgl_masuk','divisi','bagian','kode_jenis_simpanan','foto_anggota'
    ];

    //public function allData()
      //{
      //   return DB::table('anggota')->paginate(10);
      //}
      
      public function detailData($id_anggota)
      {
         return DB::table('anggota')->where('id_anggota', $id_anggota)->first();
      }
      public function simpanAnggota($data) 
      {
         DB::table('anggota')->insert($data);
      }

      public function editAnggota($id_anggota, $data) 
      {
         DB::table('anggota')
            ->where("id_anggota", $id_anggota)
            ->update($data);
      }
      public function deleteAnggota($id_anggota) 
      {
         
         DB::table('anggota')
            ->where("id_anggota", $id_anggota)
            ->delete();
      }

      public function jenissimpanan() {
         return $this->belongsTo(jenissimpanan::class);
      }
}
