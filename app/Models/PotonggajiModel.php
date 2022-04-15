<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\SimpananModel;

class PotonggajiModel extends Model
{
    protected $table = "potonggaji";
    protected $primaryKey = "id_potongan";
    protected $fillable = [
        'id_potongan','kode_potongan','nik_ktp','tgl_potongan','jumlah_potongan','status_potongan'
    ];

    public function allData() {
        return DB::table('potonggaji')
        ->leftJoin('pegawai','potonggaji.nik_ktp', '=', 'pegawai.nik_ktp')
        //->leftJoin('jenissimpanan', 'simpanan.id_simpanan', '=', 'jenissimpanan.id_simpanan')
        ->get();
        
    }
    public function detailData($id_potongan)
    {
       return DB::table('potonggaji')->where('id_potongan', $id_potongan)->first();
    }
    
    public function simpanan() {
        return $this->belongsTo('App\Models\SimpananModel');
     }

     public function angsuran() {
        return $this->belongsTo('App\Models\AngsuranModel');
     }
   
     public function deletePotongan($id_potongan) 
     {
        
        DB::table('potonggaji')
           ->where("id_potongan", $id_potongan)
           ->delete();
     }
     public function editPotongan($id_potongan, $data) 
      {
         DB::table('potonggaji')
            ->where("id_potongan", $id_potongan)
            ->update($data);
      }
    
}
