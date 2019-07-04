<?php

namespace App\Exports;

use App\Models\RelatorioTrecho;
use Maatwebsite\Excel\Concerns\FromCollection;

class RelatorioTrechoExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return RelatorioTrecho::all();
    }
}
