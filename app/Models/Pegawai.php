<?php

namespace App\Models;
use App\Models\SimpananModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Pegawai extends Model
{
    protected $table = "pegawai";
    protected $primaryKey = "nik_ktp";
    protected $fillable = [
        'nik_ktp','nama','nik_karyawan','tempat_lahir','tgl_lahir','jabatan','kepengurusan','alamat','status','tgl_masuk','foto_pegawai'
    ];

    public function allData()
    {
      return DB::table('pegawai')
      ->join('simpanan', 'pegawai.nik_ktp', '=', 'simpanan.nik_ktp')
      ->join('pinjaman', 'pegawai.nik_ktp', '=', 'pinjaman.nik_ktp')
      ->join('angsuran', 'pinjaman.no_pinjaman', '=', 'angsuran.no_pinjaman')
      ->get();
      }

    public function deletePegawai($nik_ktp) 
      {
         
         DB::table('pegawai')
            ->where("nik_ktp", $nik_ktp)
            ->delete();
      }
   public function editPegawai($nik_ktp, $data) 
   {
      DB::table('pegawai')
         ->where("nik_ktp", $nik_ktp)
         ->update($data);
   }
  
   public function detailData($nik_ktp)
   {
      return DB::table('pegawai')->where('nik_ktp', $nik_ktp)->first();
   }

   public function simpanPegawai($data) 
      {
         DB::table('pegawai')->insert($data);
      }
   public function simpanan() {
      return $this->hasMany('App\Models\SimpananModel');
   }

   public function pinjaman() {
      return $this->hasMany('App\Models\PinjamanModel');
   }

   public function pengambilan() {
      return $this->hasMany('App\Models\PengambilanModel');
   }
   public function user() {
      return $this->belongsTo('App\Models\UsersModel');
   }
   
}
