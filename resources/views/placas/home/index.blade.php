@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 style="text-align:center">Gridview de consumo por placa</h1>
@stop
@section('content')
<div class="col-md-11" style="margin-left:50px">
    <div class="table-responsive" style="max-height:450px">
        <table class="data-table">
            <thead class>
            <tr style="background-color:darkgrey">
                <th> NOME </th>
                <th> PLACA </th>
                <th> INICIO	</th>
                <th> FIM HODOMETRO_INI </th>
                <th> KM_Rodado </th>
                <th> FAIXA_VERDE % </th>
                <th> PARADA COM O MOTOR LIGADO (hh:mm:ss)</th>
                <th> MOTOR_LIGADO </th>
                <th> TEMPO_MOVIMENTO </th>
                <th> CONSUMO TOTAL </th>
                <th> Media_litros_KM </th>
                <th> MEDIA ABAIXO DE 2 </th>
                <th> MEDIA DE 2 A 2,9 </th>
                <th> MEDIA A CIMA DE 2,9 </th>
                <th> FAIXA VERDE A BAIXO DE 5% </th>
                <th> FAIXA VERDE A BAIXO DE 2% </th>
                <th> FAIXA VERDE A CIMA 5% </th>
            </tr>
            </thead>
            <tbody>
            @for($i=0;$i<count($gridconsumo);$i++)
            <tr>
                <td>{{$gridconsumo[$i]->motorista}}</td>
                <td>{{$gridconsumo[$i]->veiculo}}</td>
                <td>{{$gridconsumo[$i]->INICIO}}</td>
                <td>{{$gridconsumo[$i]->FIM}}</td>
                <td>{{$gridconsumo[$i]->hodometro}}</td>
                <td>{{$gridconsumo[$i]->distancia}}</td>
                <td>{{$gridconsumo[$i]->faixa_verde}}</td>
                <td>{{$gridconsumo[$i]->parada_motor_ligado}}</td>
                <td>{{$gridconsumo[$i]->tempo_movimento}}</td>
                <td>{{$gridconsumo[$i]->consumo}}</td>
                <td>{{$gridconsumo[$i]->rendimento}}</td>
                <td>{{$gridconsumo[$i]->media_abaixo_2}}</td>
                <td>{{$gridconsumo[$i]->media_de_2a29}}</td>
                <td>{{$gridconsumo[$i]->media_acima_2}}</td>
                <td>{{$gridconsumo[$i]->faixa_verde_abaixo5}}</td>
                <td>{{$gridconsumo[$i]->faixa_verde_abaixo2}}</td>
                <td>{{$gridconsumo[$i]->faixa_verde_acima5}}</td>
            </tr>
            @endfor
            </tbody>
        </table>
    </div>
</div>

        @section('js')
        <script>
            $(document).ready(function () {
                $('.data-table').dataTable();
            });
        </script>
    @stop


@stop
