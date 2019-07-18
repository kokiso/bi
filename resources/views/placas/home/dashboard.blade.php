@extends('adminlte::page')

@section('title', 'AdminLTE')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
@section('content_header')
    <h1 style="text-align:center">Dashboard de consumo</h1>
@stop
<?php
for($k=0; $k < count($consumo); $k++){
    $placa[] = $consumo[$k]->frota;
    $kmtotal[] = number_format((float)($consumo[$k]->media_km_litros/$consumo[$k]->km_rodado),2,'.','');
    if($k == 7){
        break;
     }
}
?>
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive bordered" style="max-height:250px;background-color:white;border:0.5px">
            <table class="data-table">
                <thead style="background-color:green">
                <tr>
                    <th>Frota</th>
                    <th>Nome</th>
                    <th>Modelo</th>
                    <th>Ano do modelo</th>
                    <th>Soma - KM_Rodado</th>
                    <th>Média - Media_litros_KM</th>
                </tr>
                </thead>
                <tbody>
                @for($i=0; $i<count($consumo); $i++)
                <tr>
                    <td>{{$consumo[$i]->frota}}</td>
                    <td>{{$consumo[$i]->motorista}}</td>
                    <td>{{$consumo[$i]->modelo}}</td>
                    <td>{{$consumo[$i]->ano_modelo}}</td>
                    <td>{{(float)$consumo[$i]->km_rodado}}</td>
                    <td>{{number_format((float)($consumo[$i]->media_km_litros/$consumo[$i]->km_rodado),2,'.','')}}</td>
                </tr>
                @endfor
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-12">
        <div class="table-responsive" style="max-height:220px">
            <table class="table">
                <thead>
                <tr>
                    <th></th>
                    <th>Total km rodado</th>
                    <th>Total media por litros</th>
                </tr>
                </thead>
                <tbody>
                @for($j=0; $j<count($totalConsumos); $j++)
                <tr>
                    <td>Total Resultado</td>
                    <td>{{(float)$totalConsumos[$j]->total_km}}</td>
                    <td>{{number_format((float)($totalConsumos[$j]->total_km/$totalConsumos[$j]->total_km_litros),2,'.','')}}</td>
                </tr>
                @endfor
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-6">
            <canvas id="consumoChart"style="border-style:solid">></canvas>
    </div>
</div>
<style>
    /* td{
        text-align:center;
        max-width: 100%;
    } */
</style>
<script>
    $(function () {
    let placa = <?php echo json_encode($placa)?>;
    let kmtotal = <?php echo json_encode($kmtotal)?>;
    var ctx = document.getElementById("consumoChart").getContext('2d');

    var myChart = new Chart(ctx, {
                type: 'line',
                data:{
                    labels:placa,
                    datasets:[{
                        label:'Kilometros Rodados',
                        data:kmtotal,
                          pointBackgroundColor:[getRandomColor(),
                        getRandomColor(),
                        getRandomColor(),
                        getRandomColor(),
                        getRandomColor(),
                        getRandomColor(),
                        getRandomColor(),
                        getRandomColor(),
                        getRandomColor(),
                        getRandomColor(),
                        getRandomColor(),
                        getRandomColor(),
                        getRandomColor(),
                        getRandomColor(),
                        getRandomColor(),
                        getRandomColor(),
                        getRandomColor(),
                        getRandomColor()]
                    }]
                }
            });
        });
    function getRandomColor() {
            var letters = '0123456789ABCDEF'.split('');
            var color = '#';
            for (var i = 0; i < 6; i++ ) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }
</script>
@section('js')
<script>
    $(document).ready(function () {
        $('.data-table').dataTable(
        {   "pageLength": 5,
            "columnDefs": [
                { "width": "15%", "targets": 0 }
            ]
        }
    );
    });
</script>
@stop
@stop
