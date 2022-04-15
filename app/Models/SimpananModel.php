<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Pegawai;
class SimpananModel extends Model
{
    protected $table = "simpanan";
    protected $primaryKey = "id_simpanan";
    protected $fillable = [
        'id_simpanan','nik_ktp','tgl_potongan','simpanan_pokok','simpanan_wajib','simpanan_sukarela','jumlah_simpanan','keterangan'
    ];
    
    
    public function allData() {
        return DB::table('simpanan')
        ->leftJoin('pegawai', 'simpanan.nik_ktp', '=', 'pegawai.nik_ktp')
        //->leftJoin('jenissimpanan', 'simpanan.id_simpanan', '=', 'jenissimpanan.id_simpanan')
        ->get();
    }

    public function potonggaji() {
        return $this->belongsTo('App\Models\PotonggajiModel');
     }
    
    public function pegawai() {
        return $this->belongsTo('App\Models\Pegawai');
     }

    public function tambahSimpanan($data) 
    {
        DB::table('simpanan')->insert($data);
    }

    public function editSimpanan($id_simpanan, $data) 
    {
        DB::table('simpanan')
        ->where("id_simpanan", $id_simpanan)
        ->update($data);
    }

    public function deleteSimpanan($id_simpanan) 
    {
       
       DB::table('simpanan')
          ->where("id_simpanan", $id_simpanan)
          ->delete();
    }
 
    public function detailData($id_simpanan)
   {
      return DB::table('simpanan')->where('id_simpanan', $id_simpanan)->first();
   }

}
