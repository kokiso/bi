@extends('adminlte::page')
<style>
    td{
        font-weight: bold;
    }
</style>
@section('title', 'AdminLTE')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
@section('content_header')
    <h1 style="text-align:center">Dashboard de Eventos</h1>
@stop
<?php
$somaVin = 0;
for($i=0; $i<count($motorista); $i++){

     $motoristaChart[] = substr($motorista[$i]->motorista,0,10);
     $infracaomotChart[] = $motorista[$i]->infracao;
     if($i == 7){
        break;
     }

}
for($i=0; $i<count($base); $i++){

     $basechart[]=substr($base[$i]->nome_cerca,3,18);
     $ifnracaoBaseChart[] = $base[$i]->infracao;
     if($i == 7){
        break;
     }

}
?>
@section('content')
<div class="row">
    <h3 style="text-align:center">PICOS DE VELOCIDADE</h3>
    <div class="col-sm-12">
        <div class="table-responsive" style="max-height:320px">
            <table class="table">
                <thead>
                <tr>
                    <th style="background-color:blue">OPERACAO</th>
                    <th style="background-color:red">% PICOS POR OPERACAO</th>
                    <th style="background-color:red">QTD PICOS TOTAL</th>
                    <th style="background-color:blue">QTD PICOS SECO</th>
                    <th style="background-color:blue">QTD PICOS CHUVA</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>RODONAVES MATRIZ</td>
                    <td  style="background-color:red">100%</td>
                    <td>{{$noSeco[0]->count+$noMolhado[0]->count}}</td>
                    <td>{{$noSeco[0]->count}}</td>
                    <td>{{$noMolhado[0]->count}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-sm-12">
            <div class="table-responsive" style="max-height:320px">
                <table class="table">
                    <thead>
                    <tr>
                        <th style="background-color:green">ROTULOS DE LINHA</th>
                        <th style="background-color:green">PUNICAO</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>RODONAVES MATRIZ</td>
                        <td style="background-color:red">{{$matriz[0]->count}}</td>
                    </tr>
                    <tr>
                        <td>Total Geral</td>
                        <td style="background-color:red">{{$matrizTotal[0]->count}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
<!--         <div class="col-md-12">
                {{-- <h3 style="text-align:center">Analítico Operação</h3> --}}
                <canvas id="punicaoChart"style="border-style:solid">></canvas>
        </div> -->

</div>

<div class="row">
    <div class="col-sm-6" style="border:black,1px,1px,1px,1px">
            <div class="table-responsive" style="max-height:220px">
            <table id="table1" class="data-table1">
                <thead style="background-color:lightgray">
                <tr>
                    <th></th>
                    <th>Infracao - Base Vinculo</th>
                </tr>
                </thead>
                <tbody>
                @for($i=0; $i<count($base); $i++)
                <tr>
                    <td>{{$base[$i]->nome_cerca}}</td>
                    <td>{{$base[$i]->infracao}}</td>
                </tr>
                @endfor

                </tbody>
            </table>
        </div>
    </div>
    <div class="col-sm-6">
        <canvas id="baseVinculoChart"style="border-style:solid"></canvas>
    </div>

    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <div class="col-sm-6">
        <div class="table-responsive" style="max-height:320px">
            <table  id="table2" class="data-table">
                <thead>
                <tr>
                    <th style="background-color:lightblue">Rotulos de Linha</th>
                    <th style="background-color:lightblue">INFRACAO</th>
                </tr>
                </thead>
                <tbody>
                @for($i=0; $i<count($motorista); $i++)
                <tr>
                        <td>{{$motorista[$i]->motorista}}</td>
                        <td>{{$motorista[$i]->infracao}}</td>
                </tr>
                @endfor
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-sm-6">
        <canvas id="analiticoMotoristaChart"style="border-style:solid"></canvas>
    </div>
    <div class="col-sm-6">
        <canvas id="motoristaInfracoesChart"style="border-style:solid"></canvas>
    </div>
</div>
    @section('js')
    <script>
        let motoristaChart = <?php echo json_encode($motoristaChart)?>;
        let infracaomotChart = <?php echo json_encode($infracaomotChart)?>;
        let basechart = <?php echo json_encode($basechart)?>;
        let ifnracaoBaseChart = <?php echo json_encode($ifnracaoBaseChart)?>;


        var ctx1 = document.getElementById("baseVinculoChart").getContext('2d');
        var ctx2 = document.getElementById("analiticoMotoristaChart").getContext('2d');
        var ctx3 = document.getElementById("motoristaInfracoesChart").getContext('2d');

        $(document).ready(function () {

        var myChart3 = new Chart(ctx3, {
                type: 'line',
                options: {
                        scales: {
                            xAxes: [{
                                ticks: {
                                    fontSize: 8
                                }
                                }]
                            }
                        },
                data:{
                    labels:motoristaChart,
                    datasets:[{
                        label:'Motorista x Infracao',
                        data:infracaomotChart,
                          pointBackgroundColor:['lightblue',
                                'lightgreen',
                                'yellow',
                                'gray',
                                'orange',
                                'purple',
                                'red',
                                'pink']
                    }]
                }
            });
            var myChart2 = new Chart(ctx2, {
                type: 'bar',
                options: {
                        scales: {
                            xAxes: [{
                                ticks: {
                                    fontSize: 8
                                }
                                }]
                            }
                        },
                data:{
                    labels:motoristaChart,
                    datasets:[{
                        label:'Analitico Motorista',
                        data:infracaomotChart,
                        backgroundColor:['lightblue',
                                'lightgreen',
                                'yellow',
                                'gray',
                                'orange',
                                'purple',
                                'red',
                                'pink']
                    }]
                }
            });
            var myChart1 = new Chart(ctx1, {
                type: 'bar',
                options: {
                        scales: {
                            xAxes: [{
                                ticks: {
                                    fontSize: 8
                                }
                                }]
                            }
                        },
                data:{
                    labels:basechart,
                    datasets:[{
                        label:'Base Vinculo',
                        data:ifnracaoBaseChart,
                        backgroundColor:['lightblue',
                                'lightgreen',
                                'yellow',
                                'gray',
                                'orange',
                                'purple',
                                'red',
                                'pink']
                    }]
                }
            });

        let table2 = $('#table2').DataTable();
        let table = $('#table1').DataTable();

        table.on( 'search.dt', function () {
            let coluns = table.columns({ filter : 'applied'}).data();
            let baseVinculoFilter = coluns[0];
            let countFilter = coluns[1];
            let str
            let baseVinculoFilterLoop = [];
            let countFilterLoop = [];
            for ( i = 0; i < 8 ; i++){
                str = String(baseVinculoFilter[i]);
                baseVinculoFilter[i] = str.substring(0, 12);
                baseVinculoFilterLoop.push(baseVinculoFilter[i]);
                countFilterLoop.push(countFilter[i]);
                
            };
            myChart1.destroy();
            myChart1 = new Chart(ctx1, {
                type: 'bar',
                options: {
                        scales: {
                            xAxes: [{
                                ticks: {
                                    fontSize: 8
                                }
                                }]
                            }
                        },
                data:{
                    labels:baseVinculoFilterLoop,
                    datasets:[{
                        label:'Base Vinculo',
                        data:countFilterLoop,
                        backgroundColor:['lightblue',
                                'lightgreen',
                                'yellow',
                                'gray',
                                'orange',
                                'purple',
                                'red',
                                'pink']
                    }]
                }
            });
        });

        table2.on( 'search.dt', function () {
            let i;
            let coluns = table2.columns({ filter : 'applied'}).data();
            let motoristaFilter = coluns[0];
            let infracaoFilter = coluns[1];
            let str
            let infracaoFilterLoop = [];
            let motoristaFilterLoop = [];
            for ( i = 0; i < 8 ; i++){
                str = String(motoristaFilter[i]);
                motoristaFilter[i] = str.substring(0, 12);
                motoristaFilterLoop.push(motoristaFilter[i]);
                infracaoFilterLoop.push(infracaoFilter[i]);
                
            };
 

            myChart3.destroy();
           
            myChart3 = new Chart(ctx3, {
                type: 'line',
                options: {
                        scales: {
                            xAxes: [{
                                ticks: {
                                    fontSize: 6
                                }
                                }]
                            }
                        },
                data:{
                    labels:motoristaFilterLoop,
                    datasets:[{
                        label:'Motorista x Infracao',
                        data:infracaoFilterLoop,
                          pointBackgroundColor:['lightblue',
                                'lightgreen',
                                'yellow',
                                'gray',
                                'orange',
                                'purple',
                                'red',
                                'pink']
                    }]
                }
            });

            myChart2.destroy();
            myChart2 = new Chart(ctx2, {
                type: 'bar',
                options: {
                        scales: {
                            xAxes: [{
                                ticks: {
                                    fontSize: 6
                                }
                                }]
                            }
                        },
                data:{
                    labels:motoristaFilterLoop,
                    datasets:[{
                        label:'Analitico Motorista',
                        data:infracaoFilterLoop,
                        backgroundColor:['lightblue',
                                'lightgreen',
                                'yellow',
                                'gray',
                                'orange',
                                'purple',
                                'red',
                                'pink']
                    }]
                }
            });
        });
    });
    </script>
    @stop
@stop
