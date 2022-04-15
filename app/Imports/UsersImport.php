<?php

namespace App\Imports;

use App\Models\UsersModel;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class UsersImport implements ToModel, WithHeadingRow
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new UsersModel([
            'nik_ktp' => $row['nik_ktp'],
           'name'    => $row['name'],
           'email'    => $row['email'], 
           'password' => Hash::make($row['password']),
           'nik_karyawan' => $row['nik_karyawan'],
           'telp'    => $row['telp'],
           'level'    => $row['level'],
        ]);
    }
    
     public function rules(): array
    {
    return [
        '*.nik_ktp' => 'required|unique',
         '*.name' => 'required',
         '*.email' => 'required|email',
          '*.password' => 'required',
        '*.nik_karyawan' => 'required',
          '*.telp' => 'required',
           '*.level' => 'required',
    ];
    }
    public function customValidationMessages()
    {
        return [
            'nik_ktp.required' => 'NIK KTP tidak boleh kosong',
            'nik_ktp.unique' => 'NIK KTP sudah ada',
            'name.required' => 'Nama tidak boleh kosong',
            'email.required' => 'Alamat email tidak boleh kosong',
            'email.email' => 'Masukan alamat email yang valid ',
            'password.required' => 'password tidak boleh kosong',
            'nik_karyawan.required' => 'Nik Karyawan tidak boleh kosong',
            'telp.required' => 'Telepon tidak boleh kosong',
            'level.required' => 'Level tidak boleh kosong',
        ];
    }

}
