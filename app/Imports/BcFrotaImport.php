<?php

namespace App\Imports;

use App\Models\bcFrota;
use Maatwebsite\Excel\Concerns\ToModel;

class BcFrotaImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new bcFrota([
            'especie' => $row[0],
            'placa_atual' => $row[1],
            'frota' => $row[2],
            'modelo' => $row[3],
            'estado' => $row[4],
            'ano_fabricacao' => $row[5],
            'ano_modelo' => $row[6],
            'cambio' => $row[7],
            'descricao_setor' => $row[8],
            'num_chassi' => $row[9],
            'renavan' => $row[10],
            'c_custo' => $row[11],
            'cor' => $row[12],
            'classe_mec' => $row[13],
            'tipo_veiculo' => $row[14],
            'media_estipulada' => $row[15]
        ]);
    }
}
