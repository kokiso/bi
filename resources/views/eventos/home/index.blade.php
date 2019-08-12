@extends('adminlte::page')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('title', 'AdminLTE')

@section('content_header')
    <h1 style="text-align:center">Gridview de Eventos/Infrações</h1>
@stop
<style>
    #data-table th{
        text-align: center !important;
    }
     td {
         border: 1px solid black;
        text-align: center !important;
        font-size: 13px;
</style>
@section('content')
<div class="col-md-12">
    <div class="table-responsive" style="max-height:800px">
        <table id = 'data-table' class="display compact" style="width:100%">
            <thead class>
            <tr>
                <th> DATA </th>
                <th> HORA </th>
                <th> FILIAL	</th>
                <th> VEICULO </th>
                <th> GRUPO MOTORISTA </th>
                <th> MOTORISTA </th>
                <th> PEDAL ACIONADO</th>
                <th> TIPO EVENTO </th>
                <th> DESCRICAO EVENTO </th>
                <th> NOME CERCA </th>
                <th> VELOCIDADE </th>
                <th> HODOMETRO </th>
                <th> DURACAO </th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
    @section('js')
    <script>$.fn.dataTable.pipeline = function ( opts ) {
    // Configuration options
    var conf = $.extend( {
        pages: 5,     // number of pages to cache
        url: '',      // script url
        data: null,   // function or object with parameters to send to the server
                        // matching how `ajax.data` works in DataTables
        method: 'GET' // Ajax HTTP method
    }, opts );

    // Private variables for storing the cache
    var cacheLower = -1;
    var cacheUpper = null;
    var cacheLastRequest = null;
    var cacheLastJson = null;

    return function ( request, drawCallback, settings ) {
        var ajax          = false;
        var requestStart  = request.start;
        var drawStart     = request.start;
        var requestLength = request.length;
        var requestEnd    = requestStart + requestLength;

        if ( settings.clearCache ) {
            // API requested that the cache be cleared
            ajax = true;
            settings.clearCache = false;
        }
        else if ( cacheLower < 0 || requestStart < cacheLower || requestEnd > cacheUpper ) {
            // outside cached data - need to make a request
            ajax = true;
        }
        else if ( JSON.stringify( request.order )   !== JSON.stringify( cacheLastRequest.order ) ||
                    JSON.stringify( request.columns ) !== JSON.stringify( cacheLastRequest.columns ) ||
                    JSON.stringify( request.search )  !== JSON.stringify( cacheLastRequest.search )
        ) {
            // properties changed (ordering, columns, searching)
            ajax = true;
        }

        // Store the request for checking next time around
        cacheLastRequest = $.extend( true, {}, request );

        if ( ajax ) {
            // Need data from the server
            if ( requestStart < cacheLower ) {
                requestStart = requestStart - (requestLength*(conf.pages-1));

                if ( requestStart < 0 ) {
                    requestStart = 0;
                }
            }

            cacheLower = requestStart;
            cacheUpper = requestStart + (requestLength * conf.pages);

            request.start = requestStart;
            request.length = requestLength*conf.pages;

            // Provide the same `data` options as DataTables.
            if ( typeof conf.data === 'function' ) {
                // As a function it is executed with the data object as an arg
                // for manipulation. If an object is returned, it is used as the
                // data object to submit
                var d = conf.data( request );
                if ( d ) {
                    $.extend( request, d );
                }
            }
            else if ( $.isPlainObject( conf.data ) ) {
                // As an object, the data given extends the default
                $.extend( request, conf.data );
            }

            settings.jqXHR = $.ajax( {
                "type":     conf.method,
                "url":      conf.url,
                "data":     request,
                "dataType": "json",
                "cache":    false,
                "success":  function ( json ) {
                    cacheLastJson = $.extend(true, {}, json);

                    if ( cacheLower != drawStart ) {
                        json.data.splice( 0, drawStart-cacheLower );
                    }
                    if ( requestLength >= -1 ) {
                        json.data.splice( requestLength, json.data.length );
                    }

                    drawCallback( json );
                }
            } );
        }
        else {
            json = $.extend( true, {}, cacheLastJson );
            json.draw = request.draw; // Update the echo for each response
            json.data.splice( 0, requestStart-cacheLower );
            json.data.splice( requestLength, json.data.length );

            drawCallback(json);
        }
    }
    };

    // Register an API method that will empty the pipelined data, forcing an Ajax
    // fetch on the next draw (i.e. `table.clearPipeline().draw()`)
    $.fn.dataTable.Api.register( 'clearPipeline()', function () {
    return this.iterator( 'table', function ( settings ) {
        settings.clearCache = true;
    } );
    } );


    //
    // DataTables initialisation
    //
    $(document).ready(function() {
    $('#data-table').DataTable( {
        "displayLength": 15, //Começaremos com apenas 15 registros
        "paginate": true,    //Queremos paginas
        "filter": true,      //Queremos que o usuário possa procurar entre os 5k registros
        "processing": true,
        "serverSide": true,
        "ajax": $.fn.dataTable.pipeline( {
            url: 'evento',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'GET',
            pages: 5 // number of pages to cache
        } ),
        columns:[
                    { data: 'data', name: 'data' },
                    { data: 'hora', name: 'hora' },
                    { data: 'filial', name: 'filial' },
                    { data: 'veiculo', name: 'veiculo' },
                    { data: 'grupo_motorista', name: 'grupo_motorista' },
                    { data: 'motorista', name: 'motorista' },
                    { data: 'pedal_acionado', name: 'pedal_acionado' },
                    { data: 'tipo_evento', name: 'tipo_evento' },
                    { data: 'descricao_evento', name: 'descricao_evento' },
                    { data: 'nome_cerca', name: 'nome_cerca' },
                    { data: 'velocidade', name: 'velocidade' },
                    { data: 'hodometro', name: 'hodometro' },
                    { data: 'duracao', name: 'duracao' }
                ]
    } );
        } );
        </script>
    @stop

@stop
