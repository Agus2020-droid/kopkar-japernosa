<?php

namespace App\Imports;

use App\Models\SimpananModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Validation\Rule;
use Throwable;

class SimpananImport implements ToModel, WithHeadingRow, WithValidation 
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new SimpananModel([
            'nik_ktp' => $row['nik_ktp'],
            'tgl_potongan' => $row['tgl_potongan'],
            'simpanan_pokok' => $row['simpanan_pokok'],
            'simpanan_wajib' => $row['simpanan_wajib'],
            'simpanan_sukarela' => $row['simpanan_sukarela'],
            'jumlah_simpanan' => $row['jumlah_simpanan'],
           


        ]);
    }
    public function rules(): array
    {
    return [
        '*.nik_ktp' => 'required',
        '*.tgl_potongan' => 'required',
        '*.simpanan_pokok' => 'required',
        '*.simpanan_wajib' => 'required',
        '*.simpanan_sukarela' => 'required',
        '*.jumlah_simpanan' => 'required',

    ];
    }
    public function customValidationMessages()
    {
        return [

            'nik_ktp.required' => 'NIK KTP tidak boleh kosong',
            'tgl_potongan.required' => 'Tanggal tidak boleh kosong',
            'simpanan_pokok.required' => 'Simpanan Pokok tidak boleh kosong',
            'simpanan_wajib.required' => 'Simpanan Wajib tidak boleh kosong',
            'simpanan_sukarela.required' => 'Simpanan Sukarela tidak boleh kosong',
            'jumlah_simpanan.required' => 'Jumlah Simpanan tidak boleh kosong',

        ];
    }


   
}
