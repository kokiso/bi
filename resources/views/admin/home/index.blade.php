@extends('adminlte::page')

@section('title', 'AdminLTE')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
@section('content_header')
<h1>Dashboard</h1>
@stop
{{-- @php var_dump($_SESSION) @endphp --}}
@section('content')
<div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total de relatorios de evento</span>
                    <span class="info-box-number"><?php echo isset($countEventos) ? $countEventos : 0 ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-truck" aria-hidden="true"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total de relatorios de trecho por placa</span>
                        <span class="info-box-number"><?php echo isset($countPlacas) ? $countPlacas : 0?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
    </div>
@stop
