<?php

namespace App\Imports;

use App\Models\AngsuranModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Validation\Rule;
use Throwable;

class AngsuranImport implements ToModel, WithHeadingRow, WithValidation 
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new AngsuranModel([
            'no_pinjaman' => $row['no_pinjaman'],
            'nik_ktp' => $row['nik_ktp'],
            'tgl_angsuran' => $row['tgl_angsuran'],
            'jumlah_angsuran' => $row['jumlah_angsuran'],
        ]);
    }
    public function rules(): array
    {
    return [
        '*.no_pinjaman' => 'required',
        '*.nik_ktp' => 'required',
        '*.tgl_angsuran' => 'required',
        '*.jumlah_angsuran' => 'required',
    ];
    }
    public function customValidationMessages()
    {
        return [

            'no_pinjaman.required' => 'tidak boleh kosong',
            'nik_ktp.required' => 'tidak boleh kosong',
            'tgl_angsuran.required' => 'tidak boleh kosong',
            'jumlah_angsuran.required' => 'tidak boleh kosong',
        ];
    }


   
}
