<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class bcFrota extends Model
{   public $timestamps = false;

    public $fillable = ['ano_fabricacao','ano_modelo','c_custo','cambio','classe_mec'
    ,'cor','descricao_setor','especie','estado','frota','media_estipulada'
    ,'modelo','num_chassi','placa_atual','renavan','tipo_de_veiculo'];

    protected $table = 'bcFrota';
}
