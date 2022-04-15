<?php

namespace App\Imports;

use App\Models\ShuModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Throwable;
class ShuImport implements ToModel, WithHeadingRow
{
    use Importable;
  
    

    public function model(array $row)
    {
        return new ShuModel([
            'nik_ktp' => $row['nik_ktp'],
            'tgl_shu' => $row['tgl_shu'],
            'nama_bank' => $row['nama_bank'],
            'no_rek' => $row['no_rek'],
            'peran_belanja_wanamart' => $row['peran_belanja_wanamart'],
            'peran_simpanan_wanamart' => $row['peran_simpanan_wanamart'],
            'lain_lain' => $row['lain_lain'],
            'peran_kredit' => $row['peran_kredit'],
            'peran_simpanan' => $row['peran_simpanan'],
            'pengurus' => $row['pengurus'],
            'jumlah_shu' => $row['jumlah_shu'],
        ]);
    }

    public function rules(): array
    {
    return [
        '*.nik_ktp' => 'required',
        '*.tgl_shu' => 'required',
        '*.nama_bank' => 'required',
        '*.no_rek' => 'required',
        '*.peran_belanja_wanamart' => 'required',
        '*.peran_simpanan_wanamart' => 'required',
        '*.lain_lain' => 'required',
        '*.peran_kredit' => 'required',
        '*.peran_simpanan' => 'required',
        '*.pengurus' => 'required',
        '*.jumlah_shu' => 'required',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'nik_ktp.required' => 'NIK KTP tidak boleh kosong',
            'tgl_shu.required' => 'TGL SHU tidak boleh kosong',
            'nama_bank.required' => 'Nama bank tidak boleh kosong',
            'no_rek.required' => 'Nomor Rekening tidak boleh kosong',
            'peran_belanja_wanamart.required' => 'peran belanja wanamart tidak boleh kosong',
            'peran_simpanan_wanamart.required' => 'peran simpanan wanamart tidak boleh kosong',
            'lain_lain.required' => 'lain-laintidak boleh kosong',
            'peran_kredit.required' => 'peran kredit tidak boleh kosong',
            'peran_simpanan.required' => 'peran simpanan tidak boleh kosong',
            'pengurus.required' => 'pengurus tidak boleh kosong',
            'jumlah_shu.required' => 'jumlah SHU tidak boleh kosong',
        ];
    }
}

