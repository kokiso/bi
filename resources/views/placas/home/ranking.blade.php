@extends('adminlte::page')

@section('title', 'AdminLTE')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
@section('content_header')
    <h1 style="text-align:center">Dashboard de Eventos</h1>
@stop
<?php
for($i=0; $i<count($rankingPorPlaca); $i++){
     $veiculoJson[] = $rankingPorPlaca[$i]->veiculo;
     $media_consumoPlaca[] = $rankingPorPlaca[$i]->media;
     if($i == 7){
        break;
     }
}
for($i=0; $i<count($rankingPorMotorista); $i++){
     $motoristaJson[]=substr($rankingPorMotorista[$i]->motorista, 0,10);
     $media_consumoMotorista[] = $rankingPorMotorista[$i]->media;
     if($i == 7){
        break;
     }
}
?>
@section('content')
<div class="row">
    <h3 style="text-align:center">Ranking Motoristas Infratores Consumo</h3>
    <div class="col-sm-6">
        <div class="table-responsive" style="max-height:220px">
            <table class="data-table">
                <thead>
                <tr>
                    <th>Motorista</th>
                    <th>Media KM por Litros</th>
                </tr>
                </thead>
                <tbody>
                @for($i=0; $i<count($rankingPorMotorista); $i++)
                <tr>
                    <td>{{$rankingPorMotorista[$i]->motorista}}</td>
                    <td>{{number_format((float)($rankingPorMotorista[$i]->media),2,'.','')}}</td>
                </tr>
                @endfor
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-sm-6">
            <canvas id="motoristaChart"style="border-style:solid">></canvas>
    </div>
</div>

<div class="row">
    <h3 style="text-align:center">Ranking Placas Infratores Consumo</h3>
    <div class="col-sm-6">
            <div class="table-responsive table-bordered" style="max-height:220px">
            <table class="data-table2 ">
                <thead>
                <tr>
                    <th>Motorista</th>
                    <th>Media KM por Litros</th>
                </tr>
                </thead>
                <tbody>
                @for($i=0; $i<count($rankingPorPlaca); $i++)
                <tr>
                    <td>{{$rankingPorPlaca[$i]->veiculo}}</td>
                    <td>{{number_format((float)($rankingPorPlaca[$i]->media),2,'.','')}}</td>
                </tr>
                @endfor
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-sm-6">
            <canvas id="placaChart"style="border-style:solid"></canvas>
    </div>
</div>
@section('js')
<script>
let motorista = <?php echo json_encode($motoristaJson)?>;
motorista.push('Total resultado');
let media_consumoMotorista = <?php echo json_encode($media_consumoMotorista)?>;
media_consumoMotorista.push(<?php echo $totalRanking ?>);

let placa = <?php echo json_encode($veiculoJson)?>;
placa.push('Total resultado');
let media_consumoPlaca = <?php echo json_encode($media_consumoPlaca)?>;
media_consumoPlaca.push(<?php echo $totalRanking ?>);

var ctx = document.getElementById("motoristaChart").getContext('2d');
var ctx3 = document.getElementById("placaChart").getContext('2d');
    $(document).ready(function () {

        var myChart = new Chart(ctx, {
                type: 'line',
                data:{
                    labels:motorista,
                    datasets:[{
                        label:'Consumo por motorista',
                        data:media_consumoMotorista,
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

            var myChart2 = new Chart(ctx3, {
                type: 'line',
                data:{
                    labels:placa,
                    datasets:[{
                        label:'Consumo por placa',
                        data:media_consumoPlaca,
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

        let table = $('.data-table').DataTable(
        {   "pageLength": 5,
            "columnDefs": [
                { "width": "70%", "targets": 0 }
            ]
        }
    );
        let table2 = $('.data-table2').DataTable(
        {   "pageLength": 5,
            "columnDefs": [
                { "width": "70%", "targets": 0 }
            ]
        }
        );

    table.on( 'search.dt', function () {
        let coluns = table.columns({ filter : 'applied'}).data();
        let motoristaFilter = coluns[0];
        let mediaKmLitro = coluns[1];
        let str
        let motoristaFilterLoop = [];
        let mediaKmLitroLoop = [];
        for ( i = 0; i < 8 ; i++){
                str = String(motoristaFilter[i]);
                motoristaFilter[i] = str.substring(0, 12);
                motoristaFilterLoop.push(motoristaFilter[i]);
                mediaKmLitroLoop.push(mediaKmLitro[i]);

            };
        myChart.destroy();
        myChart = new Chart(ctx, {
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
                labels:motoristaFilterLoop,
                datasets:[{
                    label:'Consumo por motorista',
                    data:mediaKmLitroLoop,
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
    } );

    table2.on( 'search.dt', function () {
        let coluns = table2.columns({ filter : 'applied'}).data();
        let placaFilter = coluns[0];
        let mediaKmLitro = coluns[1];
        let placaFilterLoop = [];
        let mediaKmLitroLoop = [];
        for ( i = 0; i < 8 ; i++){
                placaFilterLoop.push(placaFilter[i]);
                mediaKmLitroLoop.push(mediaKmLitro[i]);

            };
        myChart2.destroy();
        myChart2 = new Chart(ctx3, {
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
                labels:placaFilterLoop,
                datasets:[{
                    label:'Consumo por motorista',
                    data:mediaKmLitroLoop,
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
    } );

    });
</script>
@stop
@stop
