<?php

namespace App\Imports;

use App\Models\Pegawai;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Validation\Rule;
use Throwable;

class PegawaiImport implements ToModel, WithHeadingRow, WithValidation 
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Pegawai([
            'nik_ktp' => $row['nik_ktp'],
            'nama' => $row['nama'],
            'nik_karyawan' => $row['nik_karyawan'],
            'tempat_lahir' => $row['tempat_lahir'],
            'tgl_lahir' => $row['tgl_lahir'],
            'tgl_masuk' => $row['tgl_masuk'],
            'jabatan' => $row['jabatan'],
            'kepengurusan' => $row['kepengurusan'],
            'alamat' => $row['alamat'],
            'status' => $row['status']
        ]);
    }
    public function rules(): array
    {
    return [
        // 'nik_ktp' => Rule::in(['nik_ktp']),
        '*.nik_ktp' => 'required|unique:pegawai',
        '*.nik_karyawan' => 'required',
         '*.nama' => 'required',
         '*.tempat_lahir' => 'required',
          '*.tgl_lahir' => 'required',
          '*.tgl_masuk' => 'required',
           '*.jabatan' => 'required',
            '*.kepengurusan' => 'required',
             '*.alamat' => 'required',
              '*.status' => 'required',
    ];
    }
    public function customValidationMessages()
    {
        return [
            'nik_ktp.required' => 'NIK KTP tidak boleh kosong',
            'nik_ktp.unique' => 'NIK KTP sudah ada',
            'nama.required' => 'Nama tidak boleh kosong',
            'nik_karyawan.required' => 'NIK karyawan tidak boleh kosong',
            'tempat_lahir.required' => 'tempat lahir tidak boleh kosong',
            'tgl_lahir.required' => 'tgl lahir tidak boleh kosong',
            'tgl_masuk.required' => 'Tgl Masuk tidak boleh kosong',
            'jabatan.required' => 'Jabatan tidak boleh kosong',
            'kepengurusan.required' => 'Keanggotaan tidak boleh kosong',
            'alamat.required' => 'Alamat Tidak boleh kosong',
            'status.required' => 'Status tidak boleh kosong',
        ];
    }


   
}
