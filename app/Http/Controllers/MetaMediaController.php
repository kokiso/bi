<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\metaMedia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class MetaMediaController extends Controller
{
    public function formulario(){
        $veiculomedio = DB::table('metaMedia')->select('meta_media')->where('id','=','1')->get();
        $veiculoleve = DB::table('metaMedia')->select('meta_media')->where('id','=','2')->get();
        $cavalo = DB::table('metaMedia')->select('meta_media')->where('id','=','3')->get();
        $veiculopesado = DB::table('metaMedia')->select('meta_media')->where('id','=','4')->get();
        return view ('formulario',[
            'veiculomedio'=>$veiculomedio[0]->meta_media,
            'veiculoleve'=>$veiculoleve[0]->meta_media,
            'cavalo'=>$cavalo[0]->meta_media,
            'veiculopesado'=>$veiculopesado[0]->meta_media
        ]);
    }

    public function update(){

        $form = Input::all();
        DB::table('metaMedia')
            ->where('id', 1)
            ->update(['meta_media' => $form['veiculoMedio']]);
        DB::table('metaMedia')
            ->where('id', 2)
            ->update(['meta_media' => $form['veiculoLeve']]);
        DB::table('metaMedia')
            ->where('id', 3)
            ->update(['meta_media' => $form['cavaloMecanico']]);
        DB::table('metaMedia')
            ->where('id', 4)
            ->update(['meta_media' => $form['veiculoPesado']]);

        return redirect()->back()->with('message', 'Atualizado');
    }
}
