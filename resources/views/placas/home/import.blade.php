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
            Importe o arquivo <b>RelatorioDetalheTodosTrecho.xls</b>
        </div>
        <div class="card-body">
            <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="filePlaca" class="form-control">
                <br>
                <button class="btn btn-success">Importar</button>
                <a class="btn btn-warning" href="{{ route('export') }}">Exportar</a>
            </form>
        </div>
    </div>
</div>

</body>
@stop
