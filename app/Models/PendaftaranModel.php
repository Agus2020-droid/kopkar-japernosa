<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class PendaftaranModel extends Model
{
    use HasFactory;
    protected $table = "pendaftaran";
    protected $primaryKey = "id_pendaftaran";
    protected $fillable = [
        'nik_ktp','nama_lengkap','alamat_email','alamat_ktp','tmpt_lhr','tgl_lhr','telepon','tgl_masuk','nik_karyawan','status','file','foto_kry','created_at','updated_at'
    ];

    public function simpan($data) 
    {
       DB::table('pendaftaran')->insert($data);
    }

    public function detailData($id_pendaftaran)
    {
       return DB::table('pendaftaran')->where('id_pendaftaran', $id_pendaftaran)->first();
    }
    public function deletePendaftaran($id_pendaftaran) 
    {
       
       DB::table('pendaftaran')
          ->where("id_pendaftaran", $id_pendaftaran)
          ->delete();
    }
}
