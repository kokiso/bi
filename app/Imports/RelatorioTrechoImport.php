<?php

namespace App\Imports;

use App\Models\RelatorioTrecho;
use Maatwebsite\Excel\Concerns\ToModel;

class RelatorioTrechoImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new RelatorioTrecho([
            //
            'motorista' => $row[0],
            'veiculo' => $row[1],
            'motor_ligado' => $row[2],
            'parada_motor_ligado' => $row[3],
            'tempo_motor_ligado' => $row[4],
            'hodometro' => $row[5],
            'distancia' => $row[6],
            'consumo' => $row[7],
            'rendimento' => $row[8],
            'faixa_verde' => $row[9],
            'veiculo_desligado' => $row[10],
        ]);
    }
}
