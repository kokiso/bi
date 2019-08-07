<?php

namespace App\Http\Controllers\Evento;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exports\RelatorioEventosExport;
use App\Imports\RelatorioEventosImport;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use App\Models\RelatorioEventos;
use Illuminate\Support\Facades\Route;
use yajra\Datatables\Datatables;

class EventoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        if(request()->ajax()){
            return DataTables::of(RelatorioEventos::all())->make();
        }
        return view ('eventos.home.index');
    }

    public function importview(){
        return view ('eventos.home.import');
    }
    public function velocidadeview(){
        $noSeco = DB::table('relatorio_eventos')
        ->select(DB::RAW('count(*) AS count'))
        ->where('descricao_evento','like',"%SECO%")
        ->get();

        $noMolhado = DB::table('relatorio_eventos')
        ->select(DB::RAW(' count(*)AS count'))
        ->where('descricao_evento','like',"%chuva%")
        ->get();

        $matriz = DB::table('relatorio_eventos')
        ->select(DB::RAW('count(nome_cerca)AS count'))
        ->where('filial','=',"")
        ->get();

        $matrizTotal = DB::table('relatorio_eventos')
        ->select(DB::RAW('count(nome_cerca)AS count'))
        ->get();

        $base = DB::table('relatorio_eventos as a')
        ->select(DB::RAW("coalesce(b.base_vinculo,'-----') as nome_cerca,count(a.tipo_evento) AS infracao"))
        ->leftJoin('bcMotorista AS b',DB::RAW("'%'+b.nome+'%'"),'like',DB::RAW("'%'+a.motorista+'%'"))
        ->groupBy('b.base_vinculo')
        ->orderBy('infracao','desc')
        ->get();

        $baseTotal = DB::table('relatorio_eventos')
        ->select(DB::RAW('count(nome_cerca) AS count'))
        ->get();

        $motorista = DB::table('relatorio_eventos')
        ->select(DB::RAW('motorista,count(tipo_evento)
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
            'matrizTotal'=> $matrizTotal,
            'base'=> json_decode($base),
            'baseTotal'=> $baseTotal,
            'motorista'=> json_decode($motorista),
            'motoristaTotal'=> $motoristaTotal
        ]);
    }
    public function dashboardview(){
        $totTempoParado = DB::table('relatorio_eventos')
        ->select(DB::RAW(' count(descricao_evento) as count'))
        ->where('descricao_evento','like',DB::RAW("'%tempo%'"))
        ->get();
        $totMarcha = DB::table('relatorio_eventos')
        ->select(DB::RAW(' count(descricao_evento) as count'))
        ->where('descricao_evento','like',DB::RAW("'%marcha%'"))
        ->get();
        $totVelSeco = DB::table('relatorio_eventos')
        ->select(DB::RAW(' count(descricao_evento) as count'))
        ->where('descricao_evento','like',DB::RAW("'%rodo%seco%'"))
        ->get();
        $totRotacao = DB::table('relatorio_eventos')
        ->select(DB::RAW(' count(descricao_evento) as count'))
        ->where('descricao_evento','like',DB::RAW("'%rot%'"))
        ->get();
        $totGeral = DB::table('relatorio_eventos')
        ->select(DB::RAW(' count(descricao_evento) as count'))
        ->get();

        $tempoParadoChart = DB::table('relatorio_eventos')
        ->select(DB::RAW('motorista,count(descricao_evento) as tempo_parado'))
        ->WHERE('descricao_evento','like',DB::RAW("'%tempo%'"))
        ->groupBy('motorista')
        ->orderBy('tempo_parado','desc')
        ->get();
        $tempoParadoChart2 = DB::table('relatorio_eventos')
        ->select(DB::RAW('motorista,count(descricao_evento) as tempo_parado'))
        ->WHERE('descricao_evento','like',DB::RAW("'%marcha%'"))
        ->groupBy('motorista')
        ->orderBy('tempo_parado','desc')
        ->get();
        $tempoParadoChart3 = DB::table('relatorio_eventos')
        ->select(DB::RAW('motorista,count(descricao_evento) as tempo_parado'))
        ->WHERE('descricao_evento','like',DB::RAW("'%rodo%seco%'"))
        ->groupBy('motorista')
        ->orderBy('tempo_parado','desc')
        ->get();
        $tempoParadoChart4 = DB::table('relatorio_eventos')
        ->select(DB::RAW('motorista,count(descricao_evento) as tempo_parado'))
        ->WHERE('descricao_evento','like',DB::RAW("'%rot%'"))
        ->groupBy('motorista')
        ->orderBy('tempo_parado','desc')
        ->get();

        $motoristaInfracao= DB::select("
        select case when motorista = '' then 'SEM MOTORISTA' ELSE LTRIM(motorista) END as motorista
        ,CASE WHEN b.base_vinculo IS NULL THEN 'SEM BASE' ELSE b.base_vinculo END as base
        ,count(descricao_evento) as contador
        ,(select count(descricao_evento) FROM relatorio_eventos WHERE motorista = a.motorista AND descricao_evento like '%tempo%') AS tempo_parado
        ,(select count(descricao_evento) FROM relatorio_eventos WHERE motorista = a.motorista AND descricao_evento like '%marcha%') as marcha_lenta
        ,(select count(descricao_evento) FROM relatorio_eventos WHERE motorista = a.motorista AND descricao_evento like '%rodo%seco%') AS rod_seco
        ,(select count(descricao_evento) FROM relatorio_eventos WHERE motorista = a.motorista AND descricao_evento like '%rot%') AS rotacao
        from relatorio_eventos a
        LEFT OUTER JOIN bcMotorista b ON b.nome like LTRIM(a.motorista)
        GROUP BY motorista,b.base_vinculo
        ORDER BY contador DESC
        ");

        return view ('eventos.home.dashboard',[
            'totTempoParado' =>$totTempoParado,
            'totMarcha' =>$totMarcha,
            'totVelSeco' =>$totVelSeco,
            'totRotacao' =>$totRotacao,
            'totGeral'=>$totGeral,
            'tempoParadoChart' =>json_decode($tempoParadoChart),
            'tempoParadoChart2' =>json_decode($tempoParadoChart2),
            'tempoParadoChart3' =>json_decode($tempoParadoChart3),
            'tempoParadoChart4' =>json_decode($tempoParadoChart4),
            'motoristaInfracao' => $motoristaInfracao
        ]);
    }

    public function export2()
    {
        return Excel::download(new RelatorioEventosExport, 'evento.xlsx');
    }

    public function import2()
    {
        Excel::import(new RelatorioEventosImport,request()->file('fileEvento'));

        DB::table('relatorio_eventos')
        ->where('velocidade','<',-60)
        ->delete();

        DB::table('relatorio_eventos')
        ->where('velocidade','>',0)
        ->whereBetween('velocidade', [94, 131])
        ->delete();

        DB::table('relatorio_eventos')
        ->where('tipo_evento','like','PR-%')
        ->delete();

        DB::table('relatorio_eventos')
        ->where('data','like','')
        ->delete();

        DB::table('relatorio_eventos')
        ->where('data','like','%Pedal%')
        ->delete();

        return redirect('/evento/dashboard');
    }
}
