@extends('adminlte::page')

@section('title', 'AdminLTE')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<?php
    for($i=0; $i<13; $i++){
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

        if($i == 12){
        break;
     }
    }
?>
@section('content_header')
    <h1 style="text-align:center">Eventos</h1>
@stop
@section('content')
<div class="col-sm-11" style="margin-left:50px">
    <div class="ref_search"></div>
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
<div class="col-sm-11" style="margin-left:50px">
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

<div class="col-sm-11" style="border-style:solid;margin-left:50px">
    <select id="chartType" class="form-control">
        <option value="1">Tempo Parado</option>
        <option value="2">Marcha Lenta</option>
        <option value="3">Excesso Velocidade</option>
        <option value="4">Excesso Rotacao</option>
    </select>
    <canvas id="tempoParadoChart">></canvas>
</div>
<div class="col-sm-11" style="border-style:solid;margin-left:50px">
    <h3 style="text-align:center">Infracao por Motorista</h3>
    <canvas id="InfracaoChart">></canvas>
</div>

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
                            'pink',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)'
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
                            'pink',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)'
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
                            'pink',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)'
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
                            'pink',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)'
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
                            'pink',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)'
                        ]
                    }]
                }
            });

            var myChart = new Chart(ctx2, {
                type: 'bar',
                data:{
                    labels:motoristaInfracaoChart,
                    datasets:[
                    {
                        label: "Tempo Parado",
                        backgroundColor: "pink",
                        borderColor: "red",
                        borderWidth: 1,
                        data:infracaoTempoParadoChart,
                        fillColor: "#79D1CF",
                        strokeColor: "#79D1CF",
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
                },
                showTooltips: false,
                options: {
                    "hover": {
                        "animationDuration": 0
                    },
                    "animation": {
                        "duration": 0,
                                    "onComplete": function () {
                                        var chartInstance = this.chart,
                                            ctx = chartInstance.ctx;

                                        ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
                                        ctx.textAlign = 'center';
                                        ctx.textBaseline = 'bottom';

                                        this.data.datasets.forEach(function (dataset, i) {
                                            var meta = chartInstance.controller.getDatasetMeta(i);
                                            meta.data.forEach(function (bar, index) {
                                                var data = dataset.data[index];
                                                ctx.fillText(data, bar._model.x, bar._model.y - 5);
                                            });
                                        });
                                    }
                    },

                    tooltips: {
                        "enabled": false
                    },
                    legend: {
                        "display": false
                    }

                }
            });
        $('.data-table thead tr').clone(true).appendTo( '.data-table thead' );
        $('.data-table thead tr:eq(1) th').each( function (i) {
            var title = $(this).text();
            $(this).html( '<input type="text"/ style = "width: 100px">' );

            $( 'input', this ).on( 'keyup change', function () {
                if ( ref_table.column(i).search() !== this.value ) {
                    ref_table
                        .column(i)
                        .search( this.value )
                        .draw();
                }
            } );
        });
        var ref_table = $('.data-table').DataTable(
        {   "pageLength": 5,
            "orderCellsTop": true,
            "fixedHeader": true,
            "columnDefs": [
                { "width": "5%", "targets": 0 }
            ]
        });

        var search = $(
                '<div class="ref_field">'+
                    '<div class="ref_label"> <h3 style="text-align:center">Filtro por Base Vinculo:</h3></div>'+
                    '<div class="ref_input"></div>'+
                '</div>'
        ).appendTo( 'div.ref_search' );

        ref_table.column(1).data().unique().each( function (item, i) {
            var input = search.find('div.ref_input');

            input.append(
                $('<button class="btn btn-info btn-flat" style="color:black;font-weight:bolder">'+item+'</a>')
                    .on( 'click', function () {
                        $(this).toggleClass('active');

                        var items = input.find('.active').map( function () {
                            return $(this).text();
                        } ).toArray().join('|');

                        ref_table.column(1).search( items, true, false ).draw();
                    } )
            );
        });

        ref_table.on( 'search.dt', function () {
            let coluns = ref_table.columns({ filter : 'applied'}).data();
            let rotuloFilter = coluns[0];
            let tempoParadoFilter = coluns[2];
            let marchaLentaFilter = coluns[3];
            let excessoVelocFilter = coluns[4];
            let rotFilter = coluns[5];
            let str
            var determineChartFiltered = $("#chartType").val();
            let rotuloFilterLoop = [];

            let tempoParadoFilterLoop = [];
            let marchaLentaFilterLoop = [];
            let excessoVelocFilterLoop = [];
            let rotFilterLoop = [];

            for ( i = 0; i < 12 ; i++){
                str = String(rotuloFilter[i]);
                rotuloFilter[i] = str.substring(0, 12);
                rotuloFilterLoop.push(rotuloFilter[i]);
                tempoParadoFilterLoop.push(tempoParadoFilter[i]);
                marchaLentaFilterLoop.push(marchaLentaFilter[i]);
                excessoVelocFilterLoop.push(excessoVelocFilter[i]);
                rotFilterLoop.push(rotFilter[i]);
                
            };
            if(determineChartFiltered === "1")
                pieChartFiltered = tempoParadoFilterLoop
            else if(determineChartFiltered === "2")
                pieChartFiltered = marchaLentaFilterLoop
            else if(determineChartFiltered === "3")
                pieChartFiltered = marchaLentaFilterLoop
            else if(determineChartFiltered === "4")
                pieChartFiltered = rotFilterLoop

            currentChart.destroy();
            currentChart = new Chart(ctx3, {
                type: 'pie',
                data:{
                    labels:rotuloFilterLoop,
                    datasets:[{
                        label:'Tempo Parado',
                        data: pieChartFiltered,
                        backgroundColor:['lightblue',
                            'lightgreen',
                            'yellow',
                            'gray',
                            'orange',
                            'purple',
                            'red',
                            'pink',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)'
                        ]
                    }]
                }
            });
            
            myChart.destroy();
            myChart = new Chart(ctx2, {
                type: 'bar',
                data:{
                    labels:rotuloFilterLoop,
                    datasets:[
                    {
                        label: "Tempo Parado",
                        backgroundColor: "pink",
                        borderColor: "red",
                        borderWidth: 1,
                        data:tempoParadoFilterLoop,
                        fillColor: "#79D1CF",
                        strokeColor: "#79D1CF",
                    },
                    {
                        label: "Tempo de Marcha Lenta Excessivo",
                        backgroundColor: "lightblue",
                        borderColor: "blue",
                        borderWidth: 1,
                        data:marchaLentaFilterLoop
                    },
                    {
                        label: "Excesso  Velocidade Seco    ",
                        backgroundColor: "lightgreen",
                        borderColor: "green",
                        borderWidth: 1,
                        data:excessoVelocFilter
                    },
                    {
                        label: "Excesso de rotacao",
                        backgroundColor: "yellow",
                        borderColor: "orange",
                        borderWidth: 1,
                        data:rotFilterLoop
                    }
                ]
                },
                showTooltips: false,
                options: {
                    cales: {
                            xAxes: [{
                                ticks: {
                                    fontSize: 8
                                }
                                }]
                            },
                    "hover": {
                        "animationDuration": 0
                    },
                    "animation": {
                        "duration": 0,
                                    "onComplete": function () {
                                        var chartInstance = this.chart,
                                            ctx = chartInstance.ctx;

                                        ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
                                        ctx.textAlign = 'center';
                                        ctx.textBaseline = 'bottom';

                                        this.data.datasets.forEach(function (dataset, i) {
                                            var meta = chartInstance.controller.getDatasetMeta(i);
                                            meta.data.forEach(function (bar, index) {
                                                var data = dataset.data[index];
                                                ctx.fillText(data, bar._model.x, bar._model.y - 5);
                                            });
                                        });
                                    }
                    },

                    tooltips: {
                        "enabled": false
                    },
                    legend: {
                        "display": false
                    }

                }
        });
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
