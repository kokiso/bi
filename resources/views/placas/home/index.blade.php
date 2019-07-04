@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Dashboard de trechos por placa</h1>
@stop

@section('content')
<div class="table-responsive">
    <table class="table ">
        <thead>
        <tr>
            <th>Order ID</th>
            <th>Item</th>
            <th>Status</th>
            <th>Popularity</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><a href="pages/examples/invoice.html">OR9842</a></td>
            <td>Call of Duty IV</td>
            <td><span class="label label-success">Shipped</span></td>
            <td>
                <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
            </td>
        </tr>
        <tr>
            <td><a href="pages/examples/invoice.html">OR1848</a></td>
            <td>Samsung Smart TV</td>
            <td><span class="label label-warning">Pending</span></td>
            <td>
                <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>
            </td>
        </tr>
        <tr>
            <td><a href="pages/examples/invoice.html">OR7429</a></td>
            <td>iPhone 6 Plus</td>
            <td><span class="label label-danger">Delivered</span></td>
            <td>
                <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>
            </td>
        </tr>
        <tr>
            <td><a href="pages/examples/invoice.html">OR7429</a></td>
            <td>Samsung Smart TV</td>
            <td><span class="label label-info">Processing</span></td>
            <td>
                <div class="sparkbar" data-color="#00c0ef" data-height="20">90,80,-90,70,-61,83,63</div>
            </td>
        </tr>
        <tr>
            <td><a href="pages/examples/invoice.html">OR1848</a></td>
            <td>Samsung Smart TV</td>
            <td><span class="label label-warning">Pending</span></td>
            <td>
                <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>
            </td>
        </tr>
        <tr>
            <td><a href="pages/examples/invoice.html">OR7429</a></td>
            <td>iPhone 6 Plus</td>
            <td><span class="label label-danger">Delivered</span></td>
            <td>
                <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>
            </td>
        </tr>
        <tr>
            <td><a href="pages/examples/invoice.html">OR9842</a></td>
            <td>Call of Duty IV</td>
            <td><span class="label label-success">Shipped</span></td>
            <td>
                <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
            </td>
        </tr>
        </tbody>
    </table>
</div>
<div class="container"  style="width: 90%">
    <div class="row">
        <div class="col-lg-6">
                <canvas id="myChart"></canvas>
        </div>
        <div class="col-lg-6">
                <canvas id="myChart2"></canvas>
        </div>
        <div class="col-lg-12">
                <canvas id="myChart3"></canvas>
        </div>
    </div>
</div>
@stop
