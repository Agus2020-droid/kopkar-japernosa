<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Pegawai;
use App\Models\PinjamanModel;

class AngsuranModel extends Model
{
    protected $table = "angsuran";
    protected $primaryKey = "id_angsuran";
    protected $fillable = [
        'id_angsuran','tgl_angsuran','no_pinjaman','nik_ktp','jumlah_angsuran'
    ];

    public function allData() {
        return DB::table('angsuran')
        ->join('pegawai', 'angsuran.nik_ktp', '=', 'pegawai.nik_ktp')
        //->join('pinjaman', 'angsuran.no_pinjaman', '=', 'pinjaman.no_pinjaman')
        //->leftJoin('jenissimpanan', 'simpanan.id_simpanan', '=', 'jenissimpanan.id_simpanan')
        ->get();
    }
    
    public function detailData($id_angsuran)
    {
        return DB::table('angsuran')->where('id_angsuran', $id_angsuran)->first();
    }

    public function deleteAngsuran($id_angsuran) 
    {
       
       DB::table('angsuran')
          ->where("id_angsuran", $id_angsuran)
          ->delete();
    }

    public function simpanAngsuran($data) 
    {
       DB::table('angsuran')
       ->insert($data);
    }

    public function editAngsuran($id_angsuran, $data) 
      {
         DB::table('angsuran')
            ->where("id_angsuran", $id_angsuran)
            ->update($data);
      }

    public function pinjaman()
    {
        return $this->belongsTo('App\Models\PinjamanModel');
    }
}
