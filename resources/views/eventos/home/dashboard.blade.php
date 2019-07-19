@extends('adminlte::page')

@section('title', 'AdminLTE')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<?php
// var_dump($motoristaInfracao);
    for($i=0; $i<8; $i++){
        $motoristaChart[] = substr($tempoParadoChart[$i]->motorista,0,10);
        $infracaomotChart[] = $tempoParadoChart[$i]->tempo_parado;

        $motoristaInfracaoChart[] = substr($motoristaInfracao[$i]->motorista,0,12);
        $infracaoTempoParadoChart[] = $motoristaInfracao[$i]->tempo_parado;
        $infracaoMarchaLentaChart[] = $motoristaInfracao[$i]->marcha_lenta;
        $infracaoRodSecoChart[] = $motoristaInfracao[$i]->rod_seco;
        $infracaoRotacaoChart[] = $motoristaInfracao[$i]->rotacao;

        if($i == 7){
        break;
     }
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
                <th> Rotulo de linha </th>
                <th> tempo parado</th>
                <th> tempo marcha lenta	excessiva</th>
                <th> excesso velocidade trecho trecho rod. seco </th>
                <th> excesso de rotacao </th>
                <th> total geral</th>
            </tr>
            </thead>
            <tbody>
            @for($i=0;$i<count($motoristaInfracao);$i++)
            <tr>
                <td>{{$motoristaInfracao[$i]->motorista}}</td>
                <td>{{$motoristaInfracao[$i]->tempo_parado}}</td>
                <td>{{$motoristaInfracao[$i]->marcha_lenta}}</td>
                <td>{{$motoristaInfracao[$i]->rod_seco}}</td>
                <td>{{$motoristaInfracao[$i]->rotacao}}</td>
                <td>{{((int)$motoristaInfracao[$i]->tempo_parado + (int)$motoristaInfracao[$i]->marcha_lenta + (int)$motoristaInfracao[$i]->rod_seco + (int)$motoristaInfracao[$i]->rotacao)}}</td>
            </tr>
            @endfor
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
                    <td>{{$totVelSeco[0]->count}}</td>
                    <td>{{$totRotacao[0]->count}}</td>
                    <td>{{$totGeral[0]->count}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
<div>

<div class="col-md-11" style="border-style:solid;margin-left:50px">
    <h3 style="text-align:center">Tempo Parado</h3>
    <canvas id="tempoParadoChart">></canvas>
</div>
<div class="col-md-11" style="border-style:solid;margin-left:50px">
    <h3 style="text-align:center">Infracao por Motorista</h3>
    <canvas id="InfracaoChart">></canvas>
</div>
@section('js')
<script>
       $(document).ready(function () {
        $('.data-table').dataTable(
        {   "pageLength": 5
        }
    );
    });
</script>
@stop
    <script>
        $(function () {
            let total = new Array();
            let i = 0;
            let motoristaChart = <?php echo json_encode($motoristaChart)?>;
            let infracaomotChart = <?php echo json_encode($infracaomotChart)?>;

            let motoristaInfracaoChart = <?php echo json_encode($motoristaInfracaoChart)?>;

            let infracaoTempoParadoChart = <?php echo json_encode($infracaoTempoParadoChart)?>;
            let infracaoMarchaLentaChart = <?php echo json_encode($infracaoMarchaLentaChart)?>;
            let infracaoRodSecoChart = <?php echo json_encode($infracaoRodSecoChart)?>;
            let infracaoRotacaoChart = <?php echo json_encode($infracaoRotacaoChart)?>;


            var ctx3 = document.getElementById("tempoParadoChart").getContext('2d');
            ctx3.height = 500;
            var ctx2 = document.getElementById("InfracaoChart").getContext('2d');


            var myChart = new Chart(ctx3, {
                type: 'pie',
                data:{
                    labels:motoristaChart,
                    datasets:[{
                        label:'Tempo Parado',
                        data:infracaomotChart,
                        backgroundColor:['lightblue',
                        'lightgreen',
                        'yellow',
                        'gray',
                        'orange',
                        'purple',
                        'red',
                        'pink'
                        ]
                    }]
                }
            });

            var myChart = new Chart(ctx2, {
                type: 'bar',
                options: {
                scales: {
                    xAxes: [{
                        ticks: {
                            fontSize: 10
                        }
                        }]
                    }
                },
                data:{
                    labels:motoristaInfracaoChart,
                    datasets:[
                    {
                        label: "Tempo Parado",
                        backgroundColor: "pink",
                        borderColor: "red",
                        borderWidth: 1,
                        data:infracaoTempoParadoChart
                    },
                    {
                        label: "Tempo de Marcha Lenta Excessivo",
                        backgroundColor: "lightblue",
                        borderColor: "blue",
                        borderWidth: 1,
                        data:infracaoMarchaLentaChart
                    },
                    {
                        label: "Excesso  Velocidade Seco    ",
                        backgroundColor: "lightgreen",
                        borderColor: "green",
                        borderWidth: 1,
                        data:infracaoRodSecoChart
                    },
                    {
                        label: "Excesso de rotacao",
                        backgroundColor: "yellow",
                        borderColor: "orange",
                        borderWidth: 1,
                        data:infracaoRotacaoChart
                    }
                ]
                }
            });
        });

    </script>
@stop
