<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PengambilanModel extends Model
{
    use HasFactory;

    protected $table = "pengambilan";
    protected $primaryKey = "id_pengambilan";
    protected $fillable = [
        'id_pengambilan','id_user','tgl_pengambilan','nik_ktp','simpanan_pokok','simpanan_wajib','simpanan_sukarela','jumlah_pengambilan','paklaring','tgl_disetujui_ketua','disetujui_ketua','ttd_ketua','tgl_disetujui_bendahara','disetujui_bendahara','ttd_bendahara','notifikasi'
    ];

    public function allData() {
        return DB::table('pengambilan')
        ->join('pegawai', 'pengambilan.nik_ktp', '=', 'pegawai.nik_ktp')
        ->get();
    }

    public function detailData($id_pengambilan)
    {
       return DB::table('pengambilan')->where('id_pengambilan', $id_pengambilan)->first();
    }
   
    public function pegawai() {
        return $this->belongsTo('App\Models\Pegawai');
        } 
    
    public function tambahPengambilan($data) 
    {
        DB::table('pengambilan')
        ->insert($data);
    }

    public function editPengambilan($id_pengambilan, $data) 
    {
       DB::table('pengambilan')
          ->where("id_pengambilan", $id_pengambilan)
          ->update($data);
    }
    
    public function deletePengambilan($id_pengambilan) 
    {
       
       DB::table('pengambilan')
          ->where("id_pengambilan", $id_pengambilan)
          ->delete();
    }
    
}
