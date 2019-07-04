@extends('adminlte::page')

@section('title', 'AdminLTE')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
@section('content_header')
<h1>Dashboard</h1>
@stop
    <?php
    $array = json_decode($eventoPorQtd);
    for($i = 0; $i<count($array);$i++){
        $descricao_evento[] = (string)($array[$i]->descricao_evento);
        $qtd[] =  $array[$i]->qtd;
    }
    for($i = 0; $i<count($rankingMotorista);$i++){
        $motorista[] = (string)($rankingMotorista[$i]->motorista);
        $rendimento[] =  $rankingMotorista[$i]->rendimento;
    }
    ?>
@section('content')
<div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total de relatorios de evento</span>
                    <span class="info-box-number"><?php echo $countEventos?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-truck" aria-hidden="true"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total de relatorios de trecho por placa</span>
                        <span class="info-box-number"><?php echo $countPlacas?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
    </div>

    <div class="container"  style="width: 90%">
        <div class="row">
            <div class="col-lg-12">
                <h2 style="text-align:center">Quantidade de Evento por alerta</h2>
                    <canvas id="myChart"></canvas>
            </div>
            <div class="col-md-12">
                    <h2 style="text-align:center">Ranking de rendimento</h2>
                    <canvas id="myChart3"></canvas>
            </div>
        </div>
    </div>

@stop
<script>
    $(function () {
        let descricao_evento = <?php echo json_encode($descricao_evento)?>;
        let qtd = <?php echo json_encode($qtd)?>;
        let motorista = <?php echo json_encode($motorista)?>;
        let rendimento = <?php echo json_encode($rendimento)?>;
        var ctx = document.getElementById("myChart").getContext('2d');
        var ctx3 = document.getElementById("myChart3").getContext('2d');

        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: descricao_evento,
                datasets: [{
                    label: 'Quantidade de Evento por alerta',
                    data: qtd,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 9, 4, 0.2)',
                        'rgba(182, 159, 64, 0.2)',
                        'rgba(111, 159, 64, 0.2)',
                        'rgba(98, 159, 64, 0.2)',
                        'rgba(33, 159, 64, 0.2)',
                        'rgba(1, 159, 64, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 9, 4, 0.2)',
                        'rgba(182, 159, 64, 0.2)',
                        'rgba(111, 159, 64, 0.2)',
                        'rgba(98, 159, 64, 0.2)',
                        'rgba(33, 159, 64, 0.2)',
                        'rgba(1, 159, 64, 0.2)',
                    ],
                    borderWidth: 1
                }]
            },
        });

        var myChart3 = new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: motorista,
                datasets: [{
                    data: rendimento,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },

        });
    });
    </script>
