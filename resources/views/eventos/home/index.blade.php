@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 style="text-align:center">Gridview de consumo por placa</h1>
@stop
@section('content')
<div class="col-md-11" style="margin-left:50px">
    <div class="table-responsive" style="max-height:500px">
        <table class="data-table">
            <thead class>
            <tr style="background-color:darkgrey">
                <th> DATA </th>
                <th> HORA </th>
                <th> FILIAL	</th>
                <th> VEICULO </th>
                <th> GRUPO MOTORISTA </th>
                <th> MOTORISTA </th>
                <th> PEDAL ACIONADO</th>
                <th> TIPO EVENTO </th>
                <th> DESCRICAO EVENTO </th>
                <th> NOME CERCA </th>
                <th> VELOCIDADE </th>
                <th> HODOMETRO </th>
                <th> DURACAO </th>
            </tr>
            </thead>
            <tbody>
            @for($i=0;$i<count($gridview);$i++)
            <tr>
                <td>{{$gridview[$i]->DATA}}</td>
                <td>{{$gridview[$i]->HORA}}</td>
                <td>{{$gridview[$i]->FILIAL}}</td>
                <td>{{$gridview[$i]->VEICULO}}</td>
                <td>{{$gridview[$i]->GRUPO_MOTORISTA}}</td>
                <td>{{$gridview[$i]->MOTORISTA}}</td>
                <td>{{$gridview[$i]->PEDAL_ACIONADO}}</td>
                <td>{{$gridview[$i]->TIPO_EVENTO}}</td>
                <td>{{$gridview[$i]->DESCRICAO_EVENTO}}</td>
                <td>{{$gridview[$i]->NOME_CERCA}}</td>
                <td>{{$gridview[$i]->VELOCIDADE}}</td>
                <td>{{$gridview[$i]->HODOMETRO}}</td>
                <td>{{$gridview[$i]->DURACAO}}</td>
            </tr>
            @endfor
            </tbody>
        </table>
    </div>
</div>
<div>
        @section('js')
        <script>
            $(document).ready(function () {
                $('.data-table').dataTable();
            });
        </script>
    @stop

@stop
