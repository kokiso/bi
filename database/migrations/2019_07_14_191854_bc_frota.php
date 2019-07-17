<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BcFrota extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bcFrota', function (Blueprint $table) {
            $table->string('especie')->nullable();
            $table->string('placa_atual')->nullable();
            $table->string('frota')->nullable();
            $table->string('modelo')->nullable();
            $table->string('estado')->nullable();
            $table->string('ano_fabricacao')->nullable();
            $table->string('ano_modelo')->nullable();
            $table->string('cambio')->nullable();
            $table->string('descricao_setor')->nullable();
            $table->string('num_chassi')->nullable();
            $table->string('renavan')->nullable();
            $table->string('c_custo')->nullable();
            $table->string('cor')->nullable();
            $table->string('classe_mec')->nullable();
            $table->string('tipo_de_veiculo')->nullable();
            $table->string('media_estipulada')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bcFrota');
    }
}
