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
    <div style="background-color:white" >
            <h2 style="text-align:center">Ajuda:</h2>

            <ul>
              <li><b>IMPORTAR SEM CABECALHO<b></li>
              <li>Ordem das colunas:</li>
            	<ul>
                    <li>Especie</li>
                    <li>Empresa</li>
                    <li>Placa Atual</li>
                    <li>Frota</li>
                    <li>Modelo</li>
                    <li>Estado</li>
                    <li>Ano Fabr.</li>
                    <li>Ano Mod.</li>
                    <li>Cambio</li>
                    <li>Descricao Setor</li>
                    <li>Num.Chassi</li>
                    <li>Renavan<</li>
                    <li>C.Custo</li>
                    <li>Cor</li>
                    <li>Classe Mec</li>
                    <li>TIPO DE VEÍCULO</li>
                    <li>MEDIA ESTIPULADA</li>
                  </ul>
            </ul>
    </div>
</div>

</body>
@stop
