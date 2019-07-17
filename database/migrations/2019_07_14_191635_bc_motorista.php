<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BcMotorista extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bcMotorista', function (Blueprint $table) {
            $table->string('nome');
            $table->string('matricula');
            $table->string('status');
            $table->string('base_vinculo');
            $table->string('cargo');
            $table->string('cpf');
            $table->string('rg');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bcMotorista');
    }
}
