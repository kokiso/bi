@extends('adminlte::page')

@section('title', 'AdminLTE')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<?php
    for($i=0; $i<8; $i++){
        $motoristaChart[] = substr($tempoParadoChart[$i]->motorista,0,10);
        $infracaomotChart[] = $tempoParadoChart[$i]->tempo_parado;
    }
?>
@section('content_header')
    <h1 style="text-align:center">Eventos</h1>
@stop
@section('content')
<div class="col-md-11" style="margin-left:50px">
    <div class="table-responsive" style="max-height:500px">
        <table class="data-table">
            <thead class>
            <tr style="background-color:lightblue">
                {{-- <th> Rotulo de linha </th>
                <th> tempo parado </th>
                <th> tempo marcha lenta	</th>
                <th> pre-infracao excesso de veloc seco </th>
                <th> excesso velocidade trecho rod seco </th>
                <th> excesso rotacao </th>
                <th> total geral</th> --}}
            </tr>
            </thead>
            <tbody>
            {{-- @for($i=0;$i<count($gridview);$i++) --}}
            <tr>
                {{-- <td>{{$gridview[$i]->DATA}}</td>
                <td>{{//$gridview[$i]->HORA}}</td>
                <td>{{//$gridview[$i]->FILIAL}}</td>
                <td>{{//$gridview[$i]->VEICULO}}</td>
                <td>{{//$gridview[$i]->GRUPO_MOTORISTA}}</td>
                <td>{{//$gridview[$i]->MOTORISTA}}</td>
                <td>{{//$gridview[$i]->PEDAL_ACIONADO}}</td> --}}
            </tr>
            {{-- @endfor --}}
            </tbody>
        </table>
    </div>
</div>
<div class="col-md-11" style="margin-left:50px">
        <div class="table-responsive" style="max-height:500px">
            <table class="table">
                <thead class>
                <tr style="background-color:lightblue">
                    <th>-</th>
                    <th>tempo parado total</th>
                    <th>tempo marcha lenta total</th>
                    <th>pre-infracao excesso de veloc seco total</th>
                    <th>excesso velocidade trecho rod seco total</th>
                    <th>excesso rotacao total</th>
                    <th>total geral</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Total Geral</td>
                    <td>{{$totTempoParado[0]->count}}</td>
                    <td>{{$totMarcha[0]->count}}</td>
                    <td>{{$totPreVelSeco[0]->count}}</td>
                    <td>{{$totVelSeco[0]->count}}</td>
                    <td>{{$totRotacao[0]->count}}</td>
                    <td>{{$totGeral[0]->count}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
<div>
<div class="col-md-6" style="border-style:solid;margin-left:50px">
    <h3 style="text-align:center">Tempo Parado</h3>
    <canvas id="tempoParadoChart">></canvas>
</div>
        {{-- @section('js')
        <script>
            $(document).ready(function () {
                $('.data-table').dataTable();
            });
        </script>
    @stop --}}
    <script>
        $(function () {

            let motoristaChart = <?php echo json_encode($motoristaChart)?>;
            let infracaomotChart = <?php echo json_encode($infracaomotChart)?>;

            var ctx3 = document.getElementById("tempoParadoChart").getContext('2d');


            var myChart = new Chart(ctx3, {
                type: 'pie',
                data:{
                    labels:motoristaChart,
                    datasets:[{
                        label:'Tempo Parado',
                        data:infracaomotChart,
                        backgroundColor:[getRandomColor(),
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
@stop
