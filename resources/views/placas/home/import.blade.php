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
    <div style="background-color:white" >
            <h2 style="text-align:center">Passo a Passo</h2>

            <ul>
              <li>Entre no site da <a href="http://www.sascar.com.br" target="_blank">Sascar</a>.</li>
              <li>Entre na área de Clientes.</li>
              <li>Selecione Soluções Sascar Telemetria</li>
              <li>Entre com as credenciais de acesso.</li>
              <li>Selecione o campo <b>Detalhado de Todos os Trechos</b></li>
              <li>Na direita da sua tela, selecione a placa do veiculo</li>
              <li>Selecione a range de tempo e aperte </b>Visualizar Relatorio</li>
              <li>Ao abrir a Gridview, clique na opcao <b>XLS</b></li>
              <li>Abra o arquivo baixado <b>RelatorioDetalheTodosTrecho.xls</b></li>
              <li>verifique se nao possui nenhuma irregularidade( dados no final da planilha)</li>
              <li>Coloque o arquivo no formulario, e importe-o apertando <b>IMPORTAR</b></li>
            </ul>
    </div>
</div>

</body>
@stop
