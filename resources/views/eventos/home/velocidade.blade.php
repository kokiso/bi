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
for($i=0; $i<count($motorista); $i++){
     $motoristaChart[] = substr($motorista[$i]->motorista,0,10);
     $infracaomotChart[] = $motorista[$i]->infracao;
}
for($i=0; $i<count($base); $i++){
     $basechart[]=substr($base[$i]->nome_cerca,0,10);
     $ifnracaoBaseChart[] = $base[$i]->infracao;
}
?>
@section('content')
<div class="row">
    <h3 style="text-align:center">PICOS DE VELOCIDADE</h3>
    <div class="col-md-16">
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
    <div class="col-md-12">
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
    <div class="col-md-6" style="border:black,1px,1px,1px,1px">
            <div class="table-responsive" style="max-height:220px">
            <table class="data-table1">
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
    <div class="col-md-6">
        <canvas id="baseVinculoChart"style="border-style:solid"></canvas>
    </div>

    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <div class="col-md-6">
        <div class="table-responsive" style="max-height:320px">
            <table class="data-table">
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
    <div class="col-md-6">
        <canvas id="analiticoMotoristaChart"style="border-style:solid"></canvas>
    </div>
    <div class="col-md-6">
        <canvas id="motoristaInfracoesChart"style="border-style:solid"></canvas>
    </div>
</div>
@section('js')
<script>
    $(document).ready(function () {
        $('.data-table').dataTable();
        $('.data-table1').dataTable();
    });
</script>
@stop
<script>
$(function () {

    let motoristaChart = <?php echo json_encode($motoristaChart)?>;
    let infracaomotChart = <?php echo json_encode($infracaomotChart)?>;
    let basechart = <?php echo json_encode($basechart)?>;
    let ifnracaoBaseChart = <?php echo json_encode($ifnracaoBaseChart)?>;
    //let matriz = <?//php echo (int)$matriz[0]->count?>;

    var ctx1 = document.getElementById("baseVinculoChart").getContext('2d');
    var ctx2 = document.getElementById("analiticoMotoristaChart").getContext('2d');
    var ctx3 = document.getElementById("motoristaInfracoesChart").getContext('2d');
    //var ctx = document.getElementById("punicaoChart").getContext('2d');

    var myChart = new Chart(ctx3, {
        type: 'line',
        data:{
            labels:motoristaChart,
            datasets:[{
                label:'Motorista x Infracao',
                data:infracaomotChart,
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
    var myChart = new Chart(ctx2, {
        type: 'bar',
        data:{
            labels:motoristaChart,
            datasets:[{
                label:'Analitico Motorista',
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
    var myChart = new Chart(ctx1, {
        type: 'bar',
        data:{
            labels:basechart,
            datasets:[{
                label:'Base Vinculo',
                data:ifnracaoBaseChart,
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
    // var myChart = new Chart(ctx, {
    //     type: 'bar',
    //     data:{
    //         labels:'Rodonaves Matriz',
    //         datasets:[{
    //             label:'Base Vinculo',
    //             data:[matriz]
    //         }]
    //     }
    // });
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
