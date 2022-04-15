<?php

namespace App\Imports;

use App\Models\PengambilanModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Validation\Rule;
use Throwable;

class PenarikanImport implements ToModel, WithHeadingRow, WithValidation 
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new PengambilanModel([
            'tgl_pengambilan' => $row['tgl_pengambilan'],
            'id_user' => $row['id_user'],
            'nik_ktp' => $row['nik_ktp'],
            'simpanan_pokok' => $row['simpanan_pokok'],
            'simpanan_wajib' => $row['simpanan_wajib'],
            'simpanan_sukarela' => $row['simpanan_sukarela'],
            'jumlah_pengambilan' => $row['jumlah_pengambilan'],
            'tgl_disetujui_ketua' => $row['tgl_disetujui_ketua'],
            'disetujui_ketua' => $row['disetujui_ketua'],
            'ttd_ketua' => $row['ttd_ketua'],
            'tgl_disetujui_bendahara' => $row['tgl_disetujui_bendahara'],
            'disetujui_bendahara' => $row['disetujui_bendahara'],
            'ttd_bendahara' => $row['ttd_bendahara'],
        ]);
    }
    public function rules(): array
    {
    return [
        '*.tgl_pengambilan' => 'required',
        '*.id_user' => 'required',
        '*.nik_ktp' => 'required',
        '*.simpanan_pokok' => 'required',
        '*.simpanan_wajib' => 'required',
        '*.simpanan_sukarela' => 'required',
        '*.jumlah_pengambilan' => 'required',
        '*.tgl_disetujui_ketua' => 'required',
        '*.disetujui_ketua' => 'required',
        '*.ttd_ketua' => 'required',
        '*.tgl_disetujui_bendahara' => 'required',
        '*.disetujui_bendahara' => 'required',
        '*.ttd_bendahara' => 'required',
    ];
    }
    public function customValidationMessages()
    {
        return [

            'tgl_pengambilan.required' => 'tidak boleh kosong',
            'id_user.required' => 'tidak boleh kosong',
            'nik_ktp.required' => 'tidak boleh kosong',
            'simpanan_pokok.required' => 'tidak boleh kosong',
            'simpanan_wajib.required' => 'tidak boleh kosong',
            'simpanan_sukarela.required' => 'tidak boleh kosong',
            'jumlah_pengambilan.required' => 'tidak boleh kosong',
            'tgl_disetujui_ketua.required' => 'tidak boleh kosong',
            'disetujui_ketua.required' => 'tidak boleh kosong',
            'ttd_ketua.required' => 'tidak boleh kosong',
            'tgl_disetujui_bendahara.required' => 'tidak boleh kosong',
            'disetujui_bendahara.required' => 'tidak boleh kosong',
            'ttd_bendahara.required' => 'tidak boleh kosong',
        ];
    }


   
}
