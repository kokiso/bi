<?php

namespace App\Imports;
ini_set('memory_limit', '-1');
use App\Models\RelatorioEventos;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RelatorioEventosImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new RelatorioEventos([
            'data' => $this->clearStr($row['data']),
            'hora' => (string)$this->clearStr($row['hora']),
            'filial' => $this->clearStr($row['filial']),
            'veiculo' => $this->clearStr($row['veiculo']),
            'grupo_motorista' => $this->clearStr($row['grupo_motorista']),
            'motorista' => str_replace('-','',$this->clearStr($row['motorista'])),
            'pedal_acionado' => str_replace('-','',$this->clearStr($row['pedal_acionado1'])),
            'tipo_evento' => $this->clearStr($row['tipo_evento']),
            'descricao_evento' => $this->clearStr($row['descricao_evento']),
            'nome_cerca' => str_replace('-','',$this->clearStr($row['nome_da_cerca'])),
            'velocidade'=> $this->clearStr($row['velocidade_kmh2']),
            'hodometro' => $this->clearStr($row['hodometro_km']),
            'duracao' => $this->clearStr($row['duracao'])
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
