@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 style="text-align:center">Formulario de Meta Media</h1>
@stop
@section('content')
<body>
@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif
<div class="row" style="max-width:50%;margin-left:25%;background-color:white">
    {{ Form::open(array('route' => 'update')) }}
    <div class="col-md-12">
        <div class="form-group">
        {{Form::label('veiculoMedio', 'Veiculo Medio')}}
        {{Form::text('veiculoMedio',(float)$veiculomedio,['class'=>'form-control'])}}
            </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">

            {{Form::label('veiculoLeve', 'Veiculo Leve')}}
            {{Form::text('veiculoLeve',(float)$veiculoleve,['class'=>'form-control'])}}
        </div>
    </div>


    <div class="col-md-12">
        <div class="form-group">

        {{Form::label('cavaloMecanico', 'Cavalo Mecanico')}}
        {{Form::text('cavaloMecanico',(float)$cavalo,['class'=>'form-control'])}}
        </div>
    </div>


    <div class="col-md-12">
        <div class="form-group">

        {{Form::label('veiculoPesado', 'Veiculo Pesado')}}
        {{Form::text('veiculoPesado',(float)$veiculopesado,['class'=>'form-control'])}}
        </div>
    </div>
    {{Form::submit('Atualizar',['class'=>'btn btn-success btn-sm','style'=>'width:100px;float:right'])}}
    {{ Form::close() }}
</div>
</body>
@stop
