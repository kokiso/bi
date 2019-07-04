@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Eventos - Importacao</h1>
@stop

@section('content')
<body>

<div class="container" style="max-width:80%;float:left">
    <div class="card bg-light mt-3">
        <div class="card-header">
            Importe o arquivo <b>RelatorioEventos.xls</b>
        </div>
        <div class="card-body">
            <form action="{{ route('import2') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="fileEvento" class="form-control">
                <br>
                <button class="btn btn-success">Importar</button>
                <a class="btn btn-warning" href="{{ route('export2') }}">Exportar</a>
            </form>
        </div>
    </div>
</div>

</body>
@stop
