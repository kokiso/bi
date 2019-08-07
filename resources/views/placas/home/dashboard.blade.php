 <meta name="csrf-token" content="{{ csrf_token() }}">
@extends('adminlte::page')

@section('title', 'AdminLTE')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
@section('content_header')
    <h1 style="text-align:center">Dashboard de consumo</h1>
@stop
<?php
for($k=0; $k < count($consumo); $k++){
    $placa[] = $consumo[$k]->frota;
    $kmtotal[] = number_format((float)($consumo[$k]->mediaTot),2,'.','');
    if($k == 15){
        break;
     }
}
?>
@section('content')
<div class="row">
    <div class="col-md-4">
                {{Form::label('veiculoMedio', 'Escolha a Frota')}}
                {{-- <select class="form-control" name="selectName" id = "selectName">
                    @for($l=0; $l<count($frotas); $l++)
                      <option value="{{$frotas[$l]->frota}}">
                          {{$frotas[$l]->frota}}
                      </option>
                    @endfor
                  </select> --}}
                {{Form::select('selectName', $frotas, null,['class'=>'form-control','id'=>'selectName'])}}
    </div>
    <div id="container">
        @include('placas.home.external')
    </div>

    <div class="col-md-12">
        <div class="table-responsive bordered" style="max-height:450px;background-color:white;border:0.5px">
            <table class="data-table">
                <thead style="background-color:lightblue">
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
                    <td>{{number_format((float)($consumo[$i]->mediaTot),2,'.','')}}</td>
                </tr>
                @endfor
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-12">
            <canvas id="consumoChart"style="border-style:solid">></canvas>
    </div>
</div>
<style>
    /* td{
        text-align:center;
        max-width: 100%;
    } */
</style>
@section('js')
<script>
    let placa = <?php echo json_encode($placa)?>;
    let kmtotal = <?php echo json_encode($kmtotal)?>;
    var ctx = document.getElementById("consumoChart").getContext('2d');
    $(document).ready(function () {

     var myChart = new Chart(ctx, {
            type: 'line',
            data:{
                labels:placa,
                datasets:[{
                    label:'Frota x Kilometros Rodados',
                    data:kmtotal,
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

        $('.data-table thead tr').clone(true).appendTo( '.data-table thead' );
        $('.data-table thead tr:eq(1) th').each( function (i) {
            var title = $(this).text();
            $(this).html( '<input type="text"/>' );

            $( 'input', this ).on( 'keyup change', function () {
                if ( table.column(i).search() !== this.value ) {
                    table
                        .column(i)
                        .search( this.value )
                        .draw();
                }
            } );
        } );
        var table = $('.data-table').DataTable(
        {   "pageLength": 5,
            "orderCellsTop": true,
            "fixedHeader": true,
            "columnDefs": [
                { "width": "15%", "targets": 0 }
            ]
        });

        table.on( 'search.dt', function () {
            let coluns = table.columns({ filter : 'applied'}).data();
            let frotaFilter = coluns[0];
            let kmTotalFilter = coluns[5];
            myChart.destroy();
            myChart = new Chart(ctx, {
                type: 'line',
                data:{
                    labels:frotaFilter,
                    datasets:[{
                        label:'Frota x Kilometros Rodados',
                        data:kmTotalFilter,
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

    $( "#selectName" ).change(function(e) {
        let val = $("#selectName option:selected").text();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'GET',
            dataType: 'text',
            url: "dashboard",
            data: 'val='+val,
            success: function(data){
                document.getElementById('container').innerHTML = "";
                document.getElementById('container').innerHTML= data;
            },
            error: function(){
                alert('Erro no Ajax !');
            }
        });
    });
</script>
@stop
@stop
