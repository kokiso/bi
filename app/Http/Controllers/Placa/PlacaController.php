<?php

namespace App\Http\Controllers\Placa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exports\RelatorioTrechoExport;
use App\Imports\RelatorioTrechoImport;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use App\Models\RelatorioTrecho;
use Illuminate\Support\Facades\Route;
use yajra\Datatables\Datatables;
use App\Models\bcFrota;

class PlacaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        if(request()->ajax()){
            $gridConsumo = DB::table('relatorio_trechos')
            ->select(DB::raw("
            motorista
            ,b.frota as veiculo
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
            ,CASE WHEN cast(faixa_verde as float)<10 THEN 1 ELSE 0 end as faixa_verde_abaixo10
            ,CASE WHEN cast(faixa_verde as float)>10 and cast(faixa_verde as float) < 20 THEN 1 ELSE 0 end as faixa_verde_abaixo20
            ,CASE WHEN cast(faixa_verde as float)>20 and cast(faixa_verde as float) < 50 THEN 1 ELSE 0 end as faixa_verde_acima50
            "))->leftJoin('bcFrota AS b','b.placa_atual','=','veiculo')->get();
            return DataTables::of($gridConsumo)->make();
        }
        return view ('placas.home.index');
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
                sum(cast(consumo as float)) media_km_litros,
                sum(cast(consumo as float))/NULLIF(sum(cast(distancia as float)),0) AS mediaTot"))
        ->leftJoin('bcFrota AS b','b.placa_atual','=','a.veiculo')
        ->where('veiculo','<>','')
        ->where('distancia','<>','0')
        ->groupBy('b.frota','a.motorista','b.modelo','b.ano_modelo')
        ->orderBy('mediaTot')
        ->get();

        $totalConsumos = DB::table('relatorio_trechos')
        ->select(DB::raw('sum(cast(distancia as float)) as  total_km,
            sum(cast(consumo as float)) total_km_litros,
            sum(cast(consumo as float))/NULLIF(sum(cast(distancia as float)),0) AS mediaTot'))
        ->orderBy('mediaTot')
        ->get();
        $frotasSelect = DB::table('bcFrota as a') 
        ->select('a.frota')
        ->rightJoin('relatorio_trechos as b','a.placa_atual','=','b.veiculo')
        ->groupBy('a.frota')
        ->get();

        $frotaArray = $frotasSelect->pluck('frota')->all();

        //var_dump($frotaArray);die();
        // $frotaArray = $frotasSelect->pluck('frota');
        // $plucked = $frotaArray->all();
        // var_dump($plucked);die();

        if(isset($_GET['val'])){
            $startVal = $_GET['val'];
        }
        else{
            $startVal = $frotaArray[0];
        }

        $consumoMedia = db::select("select a.veiculo
        ,b.frota
        ,count(a.veiculo) as avaliadas
        ,c.meta_media as media_ideal
        ,(select sum(CAST(distancia AS float) / CAST(consumo AS float)) from relatorio_trechos WHERE veiculo = a.veiculo AND consumo <> '0') / count(a.veiculo) AS media_real
        ,(select count(consumo) from relatorio_trechos WHERE cast(consumo as float) < 2.9 AND veiculo = a.veiculo) AS fora_media
        ,(SELECT count(consumo) FROM relatorio_trechos WHERE (cast(consumo as float) < 2) AND veiculo = a.veiculo) AS abaixo_2kml
        ,(SELECT count(consumo) FROM relatorio_trechos WHERE (cast(consumo as float) BETWEEN 2 AND 2.9) AND veiculo = a.veiculo) AS entre_2kml_29kml
        ,(SELECT count(consumo) FROM relatorio_trechos WHERE (cast(consumo as float) > 2.9) AND veiculo = a.veiculo) AS acima_29kml
        ,(select sum(CAST(distancia AS float) / CAST(consumo AS float)) from relatorio_trechos WHERE veiculo = a.veiculo AND consumo <> '0') / count(a.veiculo) *100 / cast(c.meta_media as float) AS realizado
        ,(SELECT count(consumo) FROM relatorio_trechos WHERE (cast(consumo as float) > 2.9) AND veiculo = a.veiculo)*100 / count(a.veiculo) AS farol
        ,b.modelo AS modelo
        ,sum(CAST(a.faixa_verde AS float)) / count(a.veiculo) AS media_fv_real
        ,(SELECT count(faixa_verde) FROM relatorio_trechos WHERE (cast(faixa_verde as float ) < 50) AND veiculo = a.veiculo) AS fora_media_fv
        ,(SELECT count(faixa_verde) FROM relatorio_trechos WHERE (cast(faixa_verde as float ) < 10) AND veiculo = a.veiculo) AS abaixo_10_fv
        ,(SELECT count(faixa_verde) FROM relatorio_trechos WHERE (cast(faixa_verde as float) BETWEEN 10 AND 20) and veiculo = a.veiculo) AS entre_10_22_fv
        ,(SELECT count(faixa_verde) FROM relatorio_trechos WHERE (cast(faixa_verde as float) > 50) AND veiculo = a.veiculo) AS acima_50_fv
        ,(sum(CAST(a.faixa_verde AS float)) / count(a.veiculo))*100 / 50 AS realizado_fv
        ,(SELECT count(faixa_verde) FROM relatorio_trechos WHERE (cast(faixa_verde as float) > 50) AND veiculo = a.veiculo)*100 / count(a.veiculo) AS farol_fv
        FROM relatorio_trechos a
        LEFT OUTER JOIN bcFrota b ON b.placa_atual = a.veiculo
        LEFT OUTER JOIN metaMedia c ON c.veiculos = b.classe_mec
        WHERE b.frota = '".$startVal."'
        group by a.veiculo,b.frota,c.meta_media,b.modelo
        ");
        if(request()->ajax()) {
            $view = view('placas.home.external', [ 'consumoMedia'=>$consumoMedia]);
                return $view;
        }
        return view ('placas.home.dashboard',[
            'consumo'=>json_decode($consumo),
            'totalConsumos'=>json_decode($totalConsumos),
            'frotas' =>  $frotaArray,
            'consumoMedia' => $consumoMedia,
        ]);
    }
    public function rankingview(){
        $rankingPorMotorista = DB::table('relatorio_trechos')
        ->select(DB::raw("motorista,
        sum(cast(consumo AS float)) as consumo,
        sum(cast(distancia AS float)) AS distancia,
        sum(cast(distancia AS float)) / NULLIF(sum(cast(consumo AS float)), 0) as media"))
        ->groupBy('motorista')
        ->orderBy('media')
        ->get();


        $rankingPorPlaca= DB::table('relatorio_trechos')
        ->select(DB::raw("veiculo,
        sum(cast(consumo AS float)) as consumo,
        sum(cast(distancia AS float)) AS distancia,
        sum(cast(distancia AS float)) / NULLIF(sum(cast(consumo AS float)), 0) as media"))
        ->groupBy('veiculo')
        ->orderBy('media')
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

        DB::table('relatorio_trechos')->where('veiculo','')->delete();

        return redirect('/placa');
    }

}
