<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\SimpananModel;
use App\Models\PinjamanModel;
use App\Models\AngsuranModel;
class AnggotaModel extends Model
{
    
    public function allData() {
        $pegawai = DB::table('pegawai')
                ->join('simpanan','simpanan.nik_ktp','=','pegawai.nik_ktp')
                ->join('pengambilan','pengambilan.nik_ktp','=','pegawai.nik_ktp')
                ->join('pinjaman','pinjaman.nik_ktp','=','pegawai.nik_ktp')
                ->join('angsuran','angsuran.nik_ktp','=','pegawai.nik_ktp')
                ->get();    
    }
      
    public function simpanan() {
    return $this->hasMany('App\Models\SimpananModel');
     }
      
    public function pinjaman() {
    return $this->hasMany('App\Models\PinjamanModel');
    }

    
      
}
