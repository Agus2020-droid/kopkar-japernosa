<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Pegawai;


class ShuModel extends Model
{
    protected $table = "shu";
    protected $primaryKey = "id_shu";
    protected $fillable = [
        'id_shu','nik_ktp','tgl_shu','nama_bank','no_rek','peran_belanja_wanamart','peran_simpanan_wanamart','lain_lain','peran_kredit','peran_simpanan','pengurus','jumlah_shu'
    ];

    public function allData()
    {
        return DB::table('shu')
        ->leftJoin('pegawai', 'shu.nik_ktp', '=', 'pegawai.nik_ktp')
        ->get();
    }

    public function editShu($id_shu, $data) 
    {
        DB::table('shu')
        ->where("id_shu", $id_shu)
        ->update($data);
    }
    public function detailData($id_shu)
    {
       return DB::table('shu')->where('id_shu', $id_shu)->first();
    }
    public function deleteShu($id_shu) 
    {
       
       DB::table('shu')
          ->where("id_shu", $id_shu)
          ->delete();
    }
}
