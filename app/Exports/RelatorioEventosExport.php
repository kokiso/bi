<?php

namespace App\Exports;

use App\Models\RelatorioEventos;
use Maatwebsite\Excel\Concerns\FromCollection;

class RelatorioEventosExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return RelatorioEventos::all();
    }
}
