<?php

namespace App\Http\Controllers\Placa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exports\RelatorioTrechoExport;
use App\Imports\RelatorioTrechoImport;
use Maatwebsite\Excel\Facades\Excel;
use DB;

class PlacaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $gridConsumo = DB::table('relatorio_trechos')
                        ->select(DB::raw("motorista
                        ,veiculo
                        ,motor_ligado  as INICIO
                        ,veiculo_desligado  AS FIM
                        ,hodometro
                        ,distancia
                        ,faixa_verde
                        ,parada_motor_ligado
                        ,tempo_motor_ligado
                        ,consumo
                        ,rendimento
                        ,CASE WHEN cast(consumo as float) <2 THEN 1 ELSE 0 end as media_abaixo_2
                        ,CASE WHEN (cast(consumo as float) >= 2) and (cast(consumo as float)<=2.9) THEN 1 ELSE 0 end as media_de_2a29
                        ,CASE WHEN cast(consumo as float)>2.9 THEN 1 ELSE 0 end as media_acima_2
                        ,CASE WHEN cast(faixa_verde as float)<5 THEN 1 ELSE 0 end as faixa_verde_abaixo5
                        ,CASE WHEN cast(faixa_verde as float)<2 THEN 1 ELSE 0 end as faixa_verde_abaixo2
                        ,CASE WHEN cast(faixa_verde as float)>5 THEN 1 ELSE 0 end as faixa_verde_acima5
                        "))->get();
        return view ('placas.home.index',[
            'gridconsumo' => json_decode($gridConsumo)
        ]);
    }

    public function importview(){
        return view ('placas.home.import');
    }
    public function dashboardview(){
        $consumo = DB::table('relatorio_trechos as a')
        ->select(DB::raw("b.frota as frota,
                CASE WHEN motorista = '' THEN 'Sem Motorista' else motorista end as motorista,
                b.modelo as modelo,
                b.ano_modelo as ano_modelo,
                sum(cast(distancia as float)) as  km_rodado,
                sum(cast(consumo as float)) media_km_litros"))
        ->leftJoin('bcFrota AS b','b.placa_atual','=','a.veiculo')
        ->where('veiculo','<>','')
        ->groupBy('b.frota','a.motorista','b.modelo','b.ano_modelo')
        ->get();

        $totalConsumos = DB::table('relatorio_trechos')
        ->select(DB::raw('sum(cast(distancia as float)) as  total_km, sum(cast(consumo as float)) total_km_litros'))
        ->get();

        $frotasSelect = DB::table('bcFrota as a')
        ->select('a.frota')
        ->rightJoin('relatorio_trechos as b','a.placa_atual','=','b.veiculo')
        ->groupBy('a.frota')
        ->get();

        $frotaArray = json_decode(json_encode($frotasSelect), true);
        foreach ($frotaArray as $item){
            $frotas = $item['frota'];
        }
        return view ('placas.home.dashboard',[
            'consumo'=>json_decode($consumo),
            'totalConsumos'=>json_decode($totalConsumos),
            'frotas' => json_decode(json_encode($frotaArray), true)
        ]);
    }
    public function rankingview(){
        $rankingPorMotorista = DB::table('relatorio_trechos')
        ->select(DB::raw("motorista,sum(cast(consumo AS float)) as consumo, sum(cast(distancia AS float)) AS distancia"))
        ->where('motorista', '<>', null)
        ->groupBy('motorista')
        ->get();


        $rankingPorPlaca= DB::table('relatorio_trechos')
        ->select(DB::raw("veiculo,sum(cast(consumo AS float)) as consumo, sum(cast(distancia AS float)) AS distancia"))
        ->where('veiculo','<>', '')
        ->groupBy('veiculo')
        ->get();
        $totalRanking = DB::table('relatorio_trechos')
        ->select(DB::raw("sum(cast(consumo AS float)) as total"))->get();
        return view ('placas.home.ranking',[
            'rankingPorMotorista'=> json_decode($rankingPorMotorista),
            'rankingPorPlaca'=> json_decode($rankingPorPlaca),
            'totalRanking'=> (float)$totalRanking[0]->total
        ]);
    }

    public function export()
    {
        return Excel::download(new RelatorioTrechoExport, 'placa.xlsx');
    }

    public function import()
    {
        Excel::import(new RelatorioTrechoImport,request()->file('filePlaca'));

        DB::table('relatorio_trechos')->where('faixa_verde','0')->delete();

        return redirect('/placa');
    }

}
