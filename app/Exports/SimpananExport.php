<?php

namespace App\Exports;

use App\Models\SimpananModel;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
class SimpananExport implements FromQuery, ShouldAutoSize, WithHeadings, WithMapping, WithColumnFormatting
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

    public function query()
    {
        return SimpananModel::query();
    }

    public function map($simpanan): array
    {
        return [
            $simpanan->id_simpanan,
            $simpanan->nik_ktp,
            $simpanan->tgl_simpanan,
            $simpanan->simpanan_pokok,
            $simpanan->simpanan_wajib,
            $simpanan->simpanan_sukarela,
            $simpanan->jumlah_simpanan,
        ];
    }

    public function headings(): array 
    {
        return [
            'KODE SIMPANAN',
            'NIK KTP',
            'TGL SIMPANAN',
            'SIMPANAN POKOK',
            'SIMPANAN WAJIB',
            'SIMPANAN SUKARELA',
            'JUMLAH SIMPANAN',
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
            'g' => NumberFormat::FORMAT_TEXT,
        ];
    }
}
