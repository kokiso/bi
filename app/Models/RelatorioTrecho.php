<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RelatorioTrecho extends Model
{
    public $fillable = ['motorista','veiculo','motor_ligado','parada_motor_ligado','tempo_motor_ligado'
    ,'hodometro','distancia','consumo','rendimento','faixa_verde','veiculo_desligado'];
    protected $table = 'relatorio_trechos';
    protected $primaryKey = 'id';
}
