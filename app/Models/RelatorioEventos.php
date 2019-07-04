<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RelatorioEventos extends Model
{
    public $fillable = ['data','hora','filial','veiculo','grupo_motorista'
    ,'motorista','pedal_acionado','tipo_evento','descricao_evento','nome_cerca','velocidade'
    ,'hodometro','duracao'];
    protected $table = 'relatorio_eventos';
    protected $primaryKey = 'id';
}
