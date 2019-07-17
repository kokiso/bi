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
            Importe o arquivo de frota
        </div>
        <div class="card-body">
            <form action="{{ route('frotaImport') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="fileFrota" class="form-control">
                <br>
                <button class="btn btn-success">Importar</button>
            </form>
        </div>
    </div>
</div>

</body>
@stop
