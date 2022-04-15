<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
class PinjamanModel extends Model
{
    protected $table = "pinjaman";
    protected $primaryKey = "no_pinjaman";
    protected $fillable = [
      'id_user','no_pinjaman','nik_ktp','nama','nik_karyawan','jabatan','tgl_pengajuan','jenis_pinjaman','nama_barang','merk','spesifikasi','unit','keterangan','plafon','tenor','bunga','total_kredit','angsuran','periode_angsuran','status_pengajuan','tgl_verifikasi','note','notifikasi','tgl_disetujui_ketua','tgl_disetujui_hrbp','disetujui_ketua','disetujui_hrbp','verifikator','ttd_ketua','ttd_hrbp','posisi'
    ];

    public function allData()
    {
       return DB::table('pinjaman')
       ->leftjoin('pegawai', 'pinjaman.nik_ktp', '=', 'pegawai.nik_ktp')
       ->get();
    }

    public function dataAngsuran()
    {
       return DB::table('pinjaman')
       ->join('angsuran', 'pinjaman.no_pinjaman', '=', 'angsuran.no_pinjaman')
       ->get();
       
    }
    

    public function detailData($no_pinjaman)
   {
      return DB::table('pinjaman')->where('no_pinjaman', $no_pinjaman)->first();
   }

    public function tambahPinjaman($data) 
      {
         DB::table('pinjaman')->insert($data);
      }

      public function editPinjaman($no_pinjaman, $data) 
      {
         DB::table('pinjaman')
            ->where("no_pinjaman", $no_pinjaman)
            ->update($data);
      }

      public function deletePinjaman($no_pinjaman) 
      {
         
         DB::table('pinjaman')
            ->where("no_pinjaman", $no_pinjaman)
            ->delete();
      }

      public function pegawai()
      {
         return $this->belongsTo('App\Models\Pegawai'); 
      }

      public function user()
      {
         return $this->belongsTo('App\Models\UsersModel'); 
      }

      public function angsuran() {
         return $this->hasMany('App\Models\AngsuranModel');
          }
      public function getCreatedAtAttribute() 
      {
         return Carbon::parse($this->attributes['created_at'])
         ->translatedFormat('l, d F Y');
      }

     
}
