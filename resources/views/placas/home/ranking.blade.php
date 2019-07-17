@extends('adminlte::page')

@section('title', 'AdminLTE')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
@section('content_header')
    <h1 style="text-align:center">Dashboard de Eventos</h1>
@stop
<?php
for($i=0; $i<count($rankingPorPlaca); $i++){
     $veiculoJson[] = $rankingPorPlaca[$i]->veiculo;
     $media_consumoPlaca[] = $rankingPorPlaca[$i]->distancia/$rankingPorPlaca[$i]->consumo;
}
for($i=0; $i<count($rankingPorMotorista); $i++){
     $motoristaJson[]=substr($rankingPorMotorista[$i]->motorista, 0,10);
     $media_consumoMotorista[] = $rankingPorMotorista[$i]->distancia/$rankingPorMotorista[$i]->consumo;
}
?>
@section('content')
<div class="row">
    <h3 style="text-align:center">Ranking Motoristas Infratores Consumo</h3>
    <div class="col-md-6">
        <div class="table-responsive" style="max-height:220px">
            <table class="table">
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
                    <td>{{number_format((float)($rankingPorMotorista[$i]->distancia/$rankingPorMotorista[$i]->consumo),2,'.','')}}</td>
                </tr>
                @endfor
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-6">
            <canvas id="motoristaChart"style="border-style:solid">></canvas>
    </div>
</div>

<div class="row">
    <h3 style="text-align:center">Ranking Motoristas Infratores Consumo</h3>
    <div class="col-md-6">
            <div class="table-responsive" style="max-height:220px">
            <table class="table ">
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
                    <td>{{number_format((float)($rankingPorPlaca[$i]->distancia/$rankingPorPlaca[$i]->consumo),2,'.','')}}</td>
                </tr>
                @endfor
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-md-6">
            <canvas id="placaChart"style="border-style:solid"></canvas>
    </div>
</div>
<script>
        $(function () {

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

            var myChart = new Chart(ctx, {
                type: 'line',
                data:{
                    labels:motorista,
                    datasets:[{
                        label:'Consumo por motorista',
                        data:media_consumoMotorista,
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

            var myChart = new Chart(ctx3, {
                type: 'line',
                data:{
                    labels:placa,
                    datasets:[{
                        label:'Consumo por placa',
                        data:media_consumoPlaca,
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
@stop
