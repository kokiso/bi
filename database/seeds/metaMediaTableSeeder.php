<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class metaMediaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('metaMedia')->insert([
            'veiculos' =>'Veiculos Medios',
            'tipo_veiculo' => 'Toco',
            'meta_media' => 4.4,
        ]);

        DB::table('metaMedia')->insert([
            'veiculos' =>'Veiculos Leves',
            'tipo_veiculo' => 'Medio (3/4)',
            'meta_media' => 4.4,
        ]);

        DB::table('metaMedia')->insert([
            'veiculos' =>'Cavalo Mecanico',
            'tipo_veiculo' => 'Cavalo Mecanico',
            'meta_media' => 2.9,
        ]);

        DB::table('metaMedia')->insert([
            'veiculos' =>'Veiculo Pesado',
            'tipo_veiculo' => 'Truck',
            'meta_media' => 3.6,
        ]);
    }
}
