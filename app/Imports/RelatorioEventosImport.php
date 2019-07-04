<?php

namespace App\Imports;

use App\Models\RelatorioEventos;
use Maatwebsite\Excel\Concerns\ToModel;

class RelatorioEventosImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new RelatorioEventos([
            'data' => $row[0],
            'hora' => $row[1],
            'filial' => $row[2],
            'veiculo' => $row[3],
            'grupo_motorista' => $row[4],
            'motorista' => $row[5],
            'pedal_acionado' => $row[6],
            'tipo_evento' => $row[7],
            'descricao_evento' => $row[8],
            'nome_cerca' => $row[9],
            'velocidade'=> $row[10],
            'hodometro' => $row[11],
            'duracao' => $row[11]
        ]);
    }
}
