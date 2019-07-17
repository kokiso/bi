<?php

namespace App\Imports;
ini_set('memory_limit', '-1');
use App\Models\bcMotorista;
use Maatwebsite\Excel\Concerns\ToModel;

class BcMotoristaImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {   
        return new bcMotorista([
            'nome' => $row[0],
            'matricula' => $row[1],
            'status' => $row[2],
            'base_vinculo' => $row[3],
            'cargo' => $row[4],
            'cpf' => $row[5],
            'rg' => $row[6]
        ]);
    }
}
