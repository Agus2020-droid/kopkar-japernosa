<?php

namespace App\Imports;

use App\Models\PinjamanModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Validation\Rule;
use Throwable;

class PinjamanImport implements ToModel, WithHeadingRow, WithValidation 
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new PinjamanModel([
            
            'nik_ktp' => $row['nik_ktp'],
            'nama' => $row['nama'],
            'nik_karyawan' => $row['nik_karyawan'],
            'jabatan' => $row['jabatan'],
            'tgl_pengajuan' => $row['tgl_pengajuan'],
            'jenis_pinjaman' => $row['jenis_pinjaman'],
            'nama_barang' => $row['nama_barang'],
            'merk' => $row['merk'],
            'spesifikasi' => $row['spesifikasi'],
            'unit' => $row['unit'],
            'plafon' => $row['plafon'],
            'tenor' => $row['tenor'],
            'bunga' => $row['bunga'],
            'total_kredit' => $row['total_kredit'],
            'angsuran' => $row['angsuran'],
            'periode_angsuran' => $row['periode_angsuran'],
            'status_pengajuan' => $row['status_pengajuan'],
            'tgl_verifikasi' => $row['tgl_verifikasi'],
            'verifikator' => $row['verifikator'],
            'tgl_disetujui_ketua' => $row['tgl_disetujui_ketua'],
            'disetujui_ketua' => $row['disetujui_ketua'],
            'ttd_ketua' => $row['ttd_ketua'],
            'tgl_disetujui_hrbp' => $row['tgl_disetujui_hrbp'],
            'disetujui_hrbp' => $row['disetujui_hrbp'],
            'ttd_hrbp' => $row['ttd_hrbp'],
            'posisi' => $row['posisi'],
        ]);
    }
    public function rules(): array
    {
    return [
        
        '*.nik_ktp' => 'required',
        '*.nama' => 'required',
        '*.nik_karyawan' => 'required',
        '*.jabatan' => 'required',        
        '*.tgl_pengajuan' => 'required',
        '*.jenis_pinjaman' => 'required',
        '*.nama_barang' => 'required',
        '*.merk' => 'required',
        '*.spesifikasi' => 'required',
        '*.unit' => 'required',
        '*.tenor' => 'required',
        '*.plafon' => 'required',
        '*.bunga' => 'required',
        '*.total_kredit' => 'required',
        '*.angsuran' => 'required',
        '*.periode_angsuran' => 'required',
        '*.status_pengajuan' => 'required',
        '*.tgl_verifikasi' => 'required',
        '*.verifikator' => 'required',
        '*.tgl_disetujui_ketua' => 'required',
        '*.disetujui_ketua' => 'required',
        '*.ttd_ketua' => 'required',
        '*.tgl_disetujui_hrbp' => 'required',
        '*.disetujui_hrbp' => 'required',
        '*.ttd_hrbp' => 'required',
        '*.posisi' => 'required',
    ];
    }
    public function customValidationMessages()
    {
        return [

            
            'nik_ktp.required' => 'NIK KTP tidak boleh kosong',
            'nama.required' => 'Nama tidak boleh kosong',
            'nik_karyawan.required' => 'Nik Karyawan tidak boleh kosong',
            'jabatan.required' => 'Jabatan tidak boleh kosong',
            'tgl_pengajuan.required' => 'TGL pengajuan tidak boleh kosong',
            'jenis_pinjaman.required' => 'Jenis Pinjaman tidak boleh kosong',
            'merk.required' => 'Merk tidak boleh kosong',
            'spesifikasi.required' => 'Spesifikasi tidak boleh kosong',
            'unit.required' => 'Unit tidak boleh kosong',
            'tenor.required' => 'Tenor tidak boleh kosong',
            'plafon.required' => 'Plafon tidak boleh kosong',
            'bunga.required' => 'Bunga tidak boleh kosong',
            'total_kredit.required' => 'Total Kredit tidak boleh kosong',
            'angsuran.required' => 'Angsurantidak boleh kosong',
            'periode_angsuran.required' => 'Periode Angsuran tidak boleh kosong',
            'tgl_verifikasi.required' => 'tgl Verifikasi tidak boleh kosong',
            'verifikator.required' => 'Verifikator tidak boleh kosong',
            'tgl_disetujui_ketua.required' => 'TTD disetujui Ketua tidak boleh kosong',
            'disetujui_ketua.required' => 'DIsetujui Ketua tidak boleh kosong',
            'ttd_ketua.required' => 'TTD KETUA tidak boleh kosong',
            'tgl_disetujui_hrbp.required' => 'TGL Disetujui HRBP tidak boleh kosong',
            'disetujui_hrbp.required' => 'Disetujui HRBP tidak boleh kosong',
            'ttd_hrbp.required' => 'TTD HRBP tidak boleh kosong',
            'posisi.required' => 'Posisi tidak boleh kosong',
 
        ];
    }


   
}
