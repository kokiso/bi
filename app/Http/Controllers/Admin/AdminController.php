<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $countEventos = DB::table('relatorio_eventos')->count();
        $countPlacas = DB::table('relatorio_trechos')->count();
        // $eventoPorQtd =DB::table('relatorio_eventos')
        //                 ->select(DB::raw('tipo_evento,descricao_evento,count(tipo_evento) as qtd'))
        //                 ->where('descricao_evento', '<>', null)
        //                 ->groupBy('tipo_evento','descricao_evento')
        //                 ->get();
        // $rankingMotorista = DB::table('relatorio_trechos')
        //                 ->select(DB::raw('motorista,sum(cast(rendimento as float)) as rendimento'))
        //                 ->where('motorista', '<>', null)
        //                 ->groupBy('motorista')
        //                 ->orderBy('rendimento')
        //                 ->get();

        return view ('admin.home.index',[
            'countEventos'=>$countEventos,
            'countPlacas' =>$countPlacas,
            // 'eventoPorQtd' =>$eventoPorQtd,
            // 'rankingMotorista' => json_decode($rankingMotorista)
        ]);
    }
}
