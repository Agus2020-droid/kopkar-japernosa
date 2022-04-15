<?php

namespace App\Exports;

use App\Models\AngsuranModel;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
class AngsuranExport implements FromQuery, ShouldAutoSize, WithHeadings, WithMapping, WithColumnFormatting
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

    public function query()
    {
        return AngsuranModel::query();
    }

    public function map($angsuran): array
    {
        return [
            $angsuran->id_angsuran,
            $angsuran->tgl_angsuran,
            $angsuran->no_pinjaman,
            $angsuran->nik_ktp,
            $angsuran->jumlah_angsuran,
            $angsuran->status_angsuran,
        ];
    }

    public function headings(): array 
    {
        return [
            'KODE ANGSURAN',
            'TANGGAL ANGSURAN',
            'KODE PINJAMAN',
            'NIK KTP',
            'JUMLAH ANGSURAN',
            'STATUS ANGSURAN',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_TEXT,
            'B' => NumberFormat::FORMAT_TEXT,
            'C' => NumberFormat::FORMAT_TEXT,
            'D' => NumberFormat::FORMAT_NUMBER,
            'E' => NumberFormat::FORMAT_TEXT,
            'F' => NumberFormat::FORMAT_TEXT,
        ];
    }
}
