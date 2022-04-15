<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use App\Notifications\RepliedToThread;

class UsersModel extends Model
{
   use Notifiable;
   
   protected $table = "users";
    protected $primaryKey = "id";
    protected $fillable = [
        'id','nik_ktp','name','email','password','nik_karyawan','telp','level','foto_user'
    ]; 
   public function allData()
      {
         return DB::table('users') 
         ->get();
      }

      public function semuaData()
      {
         return DB::table('users')
         ->join('pegawai', 'users.nik_ktp', '=', 'pegawai.nik_ktp')
         ->get();
      }
    
      public function detailData($id)
      {
         return DB::table('users')->where('id', $id)->first();
      }

      public function editUsers($id, $data) 
      {
         DB::table('users')
            ->where("id", $id)
            ->update($data);
      }

      public function simpanUsers($data) 
      {
         DB::table('users')
            ->insert($data);
      }

      public function pegawai()
      {
         return $this->hasMany('App\Models\Pegawai');
      }

      public function pinjaman()
      {
         return $this->hasMany('App\Models\PinjamanModel');
      }
      public function deleteUsers($id) 
      {
         
         DB::table('users')
            ->where("id", $id)
            ->delete();
      }
}
