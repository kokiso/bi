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
    <div style="background-color:white" >
            <h2 style="text-align:center">Passo a Passo</h2>

            <ul>
              <li>Entre no site da <a href="http://www.sascar.com.br" target="_blank">Sascar</a>.</li>
              <li>Entre na área de Clientes.</li>
              <li>Selecione Soluções Sascar Telemetria</li>
              <li>Entre com as credenciais de acesso.</li>
              <li>Selecione o campo <b>Eventos</b></li>
              <li>Selecione a range de tempo e aperte </b>Visualizar Relatorio</li>
              <li>Ao abrir a Gridview, clique na opcao <b>XLS</b></li>
              <li>Abra o arquivo baixado <b>RelatorioEventos.xls</b></li>
              <li>Verifique se nao possui nenhuma irregularidade(dados no final da planilha fora de padrao)</li>
              <li>Coloque o arquivo no formulario, e importe-o apertando <b>IMPORTAR</b></li>
            </ul>
    </div>
</div>

</body>
@stop
