<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class bcMotorista extends Model
{   public $timestamps = false;

    public $fillable = ['base_vinculo','cargo','cpf','matricula','nome'
    ,'rg','status'];

    protected $table = 'bcMotorista';
}
