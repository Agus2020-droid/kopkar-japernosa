<?php

namespace App\Exports;

use App\Models\PengambilanModel;
use Maatwebsite\Excel\Concerns\FromCollection;

class PengambilanExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return PengambilanModel::all();
    }
}
