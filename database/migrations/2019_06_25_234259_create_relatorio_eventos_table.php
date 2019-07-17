<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelatorioEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relatorio_eventos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('data')->nullable();
            $table->string('hora')->nullable();
            $table->string('filial')->nullable();
            $table->string('veiculo')->nullable();
            $table->string('grupo_motorista')->nullable();
            $table->string('motorista')->nullable();
            $table->string('pedal_acionado')->nullable();
            $table->string('tipo_evento')->nullable();
            $table->string('descricao_evento')->nullable();
            $table->string('nome_cerca')->nullable();
            $table->string('velocidade')->nullable();
            $table->string('hodometro')->nullable();
            $table->string('duracao')->nullable();
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
        Schema::dropIfExists('relatorio_eventos');
    }
}
