<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelatorioTrechosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relatorio_trechos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('motorista')->nullable();
            $table->string('veiculo')->nullable();
            $table->string('motor_ligado')->nullable();
            $table->string('parada_motor_ligado')->nullable();
            $table->string('tempo_motor_ligado')->nullable();
            $table->string('hodometro')->nullable();
            $table->string('distancia')->nullable();
            $table->string('consumo')->nullable();
            $table->string('rendimento')->nullable();
            $table->string('faixa_verde')->nullable();
            $table->string('veiculo_desligado')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('relatorio_trechos');
    }
}
