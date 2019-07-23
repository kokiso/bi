@extends('adminlte::page')

@section('title', 'AdminLTE')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<?php
// var_dump($motoristaInfracao);
    for($i=0; $i<8; $i++){
        $motoristaChart[] = substr($tempoParadoChart[$i]->motorista,0,10);
        $motoristaChart2[] = substr($tempoParadoChart2[$i]->motorista,0,10);
        $motoristaChart3[] = substr($tempoParadoChart3[$i]->motorista,0,10);
        $motoristaChart4[] = substr($tempoParadoChart4[$i]->motorista,0,10);

        $infracaomotChart[] = $tempoParadoChart[$i]->tempo_parado;
        $infracaomotChart2[] = $tempoParadoChart2[$i]->tempo_parado;
        $infracaomotChart3[] = $tempoParadoChart3[$i]->tempo_parado;
        $infracaomotChart4[] = $tempoParadoChart4[$i]->tempo_parado;

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
    <div class="table-responsive" style="max-height:600px">
        <table class="table table-bordered table-hover dataTable data-table">
            <thead class>
            <tr style="background-color:lightblue">
                <th> Rotulo de linha </th>
                <th> Base Vinculo </th>
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
                <td style="width:300px">{{$motoristaInfracao[$i]->motorista}}</td>
                <td style="width:150px">{{$motoristaInfracao[$i]->base}}</td>
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
    <select id="chartType" class="form-control">
        <option value="1">Tempo Parado</option>
        <option value="2">Marcha Lenta</option>
        <option value="3">Excesso Velocidade</option>
        <option value="4">Excesso Rotacao</option>
    </select>
    <canvas id="tempoParadoChart">></canvas>
</div>
<div class="col-md-11" style="border-style:solid;margin-left:50px">
    <h3 style="text-align:center">Infracao por Motorista</h3>
    <canvas id="InfracaoChart">></canvas>
</div>
@section('js')
<script>
           $(document).ready(function () {

$('.data-table thead tr').clone(true).appendTo( '.data-table thead' );
$('.data-table thead tr:eq(1) th').each( function (i) {
    var title = $(this).text();
    $(this).html( '<input type="text"/ style = "width: 100px">' );

    $( 'input', this ).on( 'keyup change', function () {
        if ( table.column(i).search() !== this.value ) {
            table
                .column(i)
                .search( this.value )
                .draw();
        }
    } );
} );
let table = $('.data-table').DataTable(
{   "pageLength": 5,
    "orderCellsTop": true,
    "fixedHeader": true,
    "columnDefs": [
        { "width": "5%", "targets": 0 }
    ]
}
);
});
</script>
@stop
<script>
var currentChart;
var dataMap;
var ctx3 = document.getElementById("tempoParadoChart").getContext('2d');
var ctx2 = document.getElementById("InfracaoChart").getContext('2d');
       $(document).ready(function () {

			var total = new Array();
            var i = 0;

            var motoristaChart = <?php echo json_encode($motoristaChart)?>;
            var infracaomotChart = <?php echo json_encode($infracaomotChart)?>;
            var motoristaChart2 = <?php echo json_encode($motoristaChart2)?>;
            var infracaomotChart2 = <?php echo json_encode($infracaomotChart2)?>;
            var motoristaChart3 = <?php echo json_encode($motoristaChart3)?>;
            var infracaomotChart3 = <?php echo json_encode($infracaomotChart3)?>;
            var motoristaChart4 = <?php echo json_encode($motoristaChart4)?>;
            var infracaomotChart4 = <?php echo json_encode($infracaomotChart4)?>;

            var motoristaInfracaoChart = <?php echo json_encode($motoristaInfracaoChart)?>;

            var infracaoTempoParadoChart = <?php echo json_encode($infracaoTempoParadoChart)?>;
            var infracaoMarchaLentaChart = <?php echo json_encode($infracaoMarchaLentaChart)?>;
            var infracaoRodSecoChart = <?php echo json_encode($infracaoRodSecoChart)?>;
            var infracaoRotacaoChart = <?php echo json_encode($infracaoRotacaoChart)?>;

            dataMap = {
                "1":{
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
                },
                "2":{
                    type: 'pie',
                    data:{
                    labels:motoristaChart2,
                        datasets:[{
                            label:'Marcha Lenta',
                            data:infracaomotChart2,
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
                },
                "3":{
                    type: 'pie',
                    data:{
                    labels:motoristaChart3,
                        datasets:[{
                            label:'Excesso de velocidade em pista seco',
                            data:infracaomotChart3,
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
                },
                "4":{
                    type: 'pie',
                    data:{
                    labels:motoristaChart4,
                        datasets:[{
                            label:'Excesso de Rotacao',
                            data:infracaomotChart4,
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
                }
            };

            currentChart = new Chart(ctx3, {
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
                hover: { animationDuration: 0},
                options: {
                    tooltipTemplate: "<%= value %>",

                    showTooltips: true,

                    onAnimationComplete: function()
                    {
                        this.showTooltip(this.datasets[0].bars, true);
                    },
                    tooltipEvents: [],
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
  function updateChart() {
    if(typeof currentChart != "undefined"){
    	currentChart.destroy();
    }

    var determineChart = $("#chartType").val();

    var params = dataMap[determineChart]
    currentChart = new Chart(ctx3, params);
  }

  $('#chartType').on('change', updateChart);
        </script>
@stop
