<?php

namespace App\Imports;

use App\Models\RelatorioTrecho;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RelatorioTrechoImport implements ToModel, WithHeadingRow
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
            'motorista' => str_replace('-','',$this->clearStr($row['motorista'])),
            'veiculo' => $this->clearStr($row['veiculo']),
            'motor_ligado' => $this->clearStr($row['motor_ligado_hhmmss']),
            'parada_motor_ligado' => $this->clearStr($row['parada_com_o_motor_ligado_hhmmss']),
            'tempo_motor_ligado' => $this->clearStr($row['tempo_de_motor_ligado_hhmmss']),
            'hodometro' => $this->clearStr($row['hodometro_km']),
            'distancia' => $this->clearStr($row['distancia_km']),
            'consumo' => $this->clearStr($row['consumolitros']),
            'rendimento' => $this->clearStr($row['rendimentokml']),
            'faixa_verde' => $this->clearStr($row['faixa_verde']),
            'veiculo_desligado' => $this->clearStr($row['veiculo_desligado_hhmmss'])
        ]);
    }
    public function headingRow(): int
    {
        return 2;
    }
    public function clearStr($str) {  
        $str = str_replace('(UTC-3)', '', $str);
        $str = str_replace('RTE', '', $str);
        $str = preg_replace('/[^A-Za-z0-9\-.:, ]/', '-', $str);
        return $str;
    }
}
