<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class metaMedia extends Model
{
    public $fillable = ['meta_media','tipo_veiculo','veiculos'];
    protected $table = 'metaMedia';
    protected $primaryKey = 'id';
}
