<?php

namespace App\Exports;

use App\Models\PinjamanModel;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
class PinjamanExport implements FromQuery, ShouldAutoSize, WithHeadings, WithMapping, WithColumnFormatting
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

    public function query()
    {
        return PinjamanModel::query();
    }
   
    public function map($pinjaman): array
    {
        return [
            $pinjaman->no_pinjaman,
            $pinjaman->nik_ktp,
            $pinjaman->nama,
            $pinjaman->nik_karyawan,
            $pinjaman->jabatan,
            $pinjaman->tgl_pengajuan,
            $pinjaman->jenis_pinjaman,
            $pinjaman->nama_barang,
            $pinjaman->merk,
            $pinjaman->spesifikasi,
            $pinjaman->unit,
            $pinjaman->plafon,
            $pinjaman->tenor,
            $pinjaman->bunga,
            $pinjaman->total_kredit,
            $pinjaman->angsuran,
            $pinjaman->periode_angsuran,
            $pinjaman->posisi,
 
        ];
    }

    public function headings(): array 
    {
        return [
            'KODE PINJAMAN',
            'NIK KTP',
            'NAMA KARYAWAN',
            'NIK KARYAWAN',
            'STATUS PEKERJAAN',
            'TANGGAL PENGAJUAN',
            'JENIS PINJAMAN',
            'NAMA BARANG',
            'MERK',
            'SPESIFIKASI',
            'UNIT',
            'PLAFON',
            'TENOR',
            'PROFIT',
            'TOTAL KREDIT',
            'ANGSURAN',
            'JATUH TEMPO',
            'STATUS PENGAJUAN',

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
            'N' => NumberFormat::FORMAT_TEXT,
            'O' => NumberFormat::FORMAT_TEXT,
            'P' => NumberFormat::FORMAT_TEXT,
            'Q' => NumberFormat::FORMAT_TEXT,
            'R' => NumberFormat::FORMAT_TEXT,

        ];
    }
}
