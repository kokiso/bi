@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Trecho por Placas - Importacao</h1>
@stop

@section('content')
<body>

<div class="container"style="max-width:80%;float:left">
    <div class="card bg-light mt-3">
        <div class="card-header">
            Importe o arquivo de motorista
        </div>
        <div class="card-body">
            <form action="{{ route('motoristaImport') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="fileMotorista" class="form-control">
                <br>
                <button class="btn btn-success">Importar</button>
            </form>
        </div>
    </div>
    <div style="background-color:white" >
            <h2 style="text-align:center">Ajuda:</h2>

            <ul>
            <li><b>IMPORTAR SEM CABECALHO<b></li>
            <li>Ordem das colunas:</li>
            <ul>
                    <li>NOME</li>
                    <li>MATRÍCULA</li>
                    <li>Status</li>
                    <li>BASE VÍNCULO</li>
                    <li>CARGO</li>
                    <li>CPF</li>
                    <li>RG</li>
                </ul>
            </ul>
    </div>
</div>
</body>
@stop
