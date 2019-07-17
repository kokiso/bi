<?php

namespace App\Http\Controllers\Evento;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exports\RelatorioEventosExport;
use App\Imports\RelatorioEventosImport;
use Maatwebsite\Excel\Facades\Excel;
use DB;

class EventoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $gridview = DB::table('relatorio_eventos')
        ->select(DB::RAW('DATA,HORA,FILIAL,VEICULO,GRUPO_MOTORISTA
        ,MOTORISTA,PEDAL_ACIONADO,TIPO_EVENTO,DESCRICAO_EVENTO,NOME_CERCA
        ,VELOCIDADE,HODOMETRO,DURACAO'))
        ->get();
        return view ('eventos.home.index',[
            'gridview'=>$gridview
        ]);
    }

    public function importview(){
        return view ('eventos.home.import');
    }
    public function velocidadeview(){
        $noSeco = DB::table('relatorio_eventos')
        ->select(DB::RAW('count(*) AS count'))
        ->where('tipo_evento','like',"'%NO%SECO%'")
        ->get();

        $noMolhado = DB::table('relatorio_eventos')
        ->select(DB::RAW(' count(*)AS count'))
        ->where('tipo_evento','like',"'%infraochuva%'")
        ->get();

        $matriz = DB::table('relatorio_eventos')
        ->select(DB::RAW('count(*)AS count'))
        ->where('filial','=',"''")
        ->get();

        $base = DB::table('relatorio_eventos')
        ->select(DB::RAW('nome_cerca,count(tipo_evento) AS infracao'))
        ->groupBy('nome_cerca')
        ->orderBy('infracao','desc')
        ->get();

        $baseTotal = DB::table('relatorio_eventos')
        ->select(DB::RAW('count(nome_cerca) AS count'))
        ->get();

        $motorista = DB::table('relatorio_eventos')
        ->select(DB::RAW(' motorista,count(tipo_evento)
        AS infracao'))
        ->where('motorista','<>',"''")
        ->groupBy('motorista')
        ->orderBy('infracao','desc')
        ->get();

        $motoristaTotal = DB::table('relatorio_eventos')
        ->select(DB::RAW(' count(motorista) as count'))
        ->where('motorista','<>',"''")
        ->get();

        return view ('eventos.home.velocidade',[
            'noSeco'=> $noSeco,
            'noMolhado'=> $noMolhado,
            'matriz'=> $matriz,
            'base'=> json_decode($base),
            'baseTotal'=> $baseTotal,
            'motorista'=> json_decode($motorista),
            'motoristaTotal'=> $motoristaTotal
        ]);
    }
    public function dashboardview(){
        $totTempoParado = DB::table('relatorio_eventos')
        ->select(DB::RAW(' count(descricao_evento) as count'))
        ->where('descricao_evento','like',"'%tempo%'")
        ->get();
        $totMarcha = DB::table('relatorio_eventos')
        ->select(DB::RAW(' count(descricao_evento) as count'))
        ->where('descricao_evento','like',"'%marcha%'")
        ->get();
        $totPreVelSeco = DB::table('relatorio_eventos')
        ->select(DB::RAW(' count(descricao_evento) as count'))
        ->where('descricao_evento','like',"'%pr%seco%'")
        ->get();
        $totVelSeco = DB::table('relatorio_eventos')
        ->select(DB::RAW(' count(descricao_evento) as count'))
        ->where('descricao_evento','like',"'%rodo%seco%'")
        ->get();
        $totRotacao = DB::table('relatorio_eventos')
        ->select(DB::RAW(' count(descricao_evento) as count'))
        ->where('descricao_evento','like',"'%rot%'")
        ->get();
        $totGeral = DB::table('relatorio_eventos')
        ->select(DB::RAW(' count(descricao_evento) as count'))
        ->get();
        $tempoParadoChart = DB::table('relatorio_eventos')
        ->select(DB::RAW('motorista,count(descricao_evento) as tempo_parado'))
        ->WHERE('descricao_evento','like','%tempo%')
        ->groupBy('motorista')
        ->orderBy('motorista','desc')
        ->get();


        return view ('eventos.home.dashboard',[
            'totTempoParado' =>$totTempoParado,
            'totMarcha' =>$totMarcha,
            'totPreVelSeco' =>$totPreVelSeco,
            'totVelSeco' =>$totVelSeco,
            'totRotacao' =>$totRotacao,
            'totGeral'=>$totGeral,
            'tempoParadoChart' =>json_decode($tempoParadoChart)
        ]);
    }

    public function export2()
    {
        return Excel::download(new RelatorioEventosExport, 'evento.xlsx');
    }

    public function import2()
    {
        Excel::import(new RelatorioEventosImport,request()->file('fileEvento'));

        return redirect('/evento');
    }
}
