<?php

namespace App\Exports;

use App\Models\Pegawai;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
class PegawaiExport implements FromQuery, ShouldAutoSize, WithHeadings, WithMapping, WithColumnFormatting
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

    public function query()
    {
        return Pegawai::query();
    }

    public function map($pegawai): array
    {
        return [
            $pegawai->id,
            $pegawai->kode_pegawai,
            $pegawai->nik_ktp,
            $pegawai->nama,
            $pegawai->nik_karyawan,
            $pegawai->tempat_lahir,
            $pegawai->tgl_lahir,
            $pegawai->telp,
            $pegawai->jabatan,
            $pegawai->kepengurusan,
            $pegawai->alamat,
            $pegawai->status,
            $pegawai->tgl_masuk,
        ];
    }

    public function headings(): array 
    {
        return [
            'ID',
            'KODE ANGGOTA',
            'NIK KTP',
            'NAMA KARYAWAN',
            'NIK KARYAWAN',
            'TEMPAT LAHIR',
            'TANGGAL LAHIR',
            'NO. TELP',
            'JABATAN',
            'KEPENGURUSAN',
            'ALAMAT',
            'STATUS',
            'TGL MASUK',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_TEXT,
            'B' => NumberFormat::FORMAT_TEXT,
            'C' => NumberFormat::FORMAT_TEXT,
            'D' => NumberFormat::FORMAT_TEXT,
            'E' => NumberFormat::FORMAT_TEXT,
            'F' => NumberFormat::FORMAT_TEXT,
            'G' => NumberFormat::FORMAT_TEXT,
            'H' => NumberFormat::FORMAT_TEXT,
            'I' => NumberFormat::FORMAT_TEXT,
            'J' => NumberFormat::FORMAT_TEXT,
            'K' => NumberFormat::FORMAT_TEXT,
            'L' => NumberFormat::FORMAT_TEXT,
            'M' => NumberFormat::FORMAT_TEXT,
        ];
    }
}
