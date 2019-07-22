<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
@php
    $val = 30317;
    if(isset($_POST['val']))
    $val = $_POST['val'];
    $consumoMedia = db::select("select a.veiculo,b.frota, count(a.veiculo) as avaliadas
        ,c.meta_media as media_ideal
        ,sum(CAST(a.consumo AS float)) / sum(CAST(a.distancia AS float)) AS media_real
            ,(select count(a.consumo) from relatorio_trechos a
            LEFT OUTER JOIN bcFrota b ON b.placa_atual = a.veiculo
            LEFT OUTER JOIN metaMedia c ON c.veiculos = b.classe_mec
            WHERE a.consumo <> c.meta_media) AS fora_media
        ,(SELECT count(consumo) FROM relatorio_trechos WHERE (cast(consumo as float) < 2) AND b.frota = ".$val.") AS abaixo_2kml
        ,(SELECT count(consumo) FROM relatorio_trechos WHERE (cast(consumo as float) BETWEEN 2 AND 2.9) AND b.frota = ".$val.") AS entre_2kml_29kml
        ,(SELECT count(consumo) FROM relatorio_trechos WHERE (cast(consumo as float) > 2.9) AND b.frota = ".$val.") AS acima_29kml
        ,(SELECT count(consumo) FROM relatorio_trechos WHERE (cast(consumo as float) > 2.9) AND b.frota = ".$val.")*100 / count(a.veiculo) AS realizado
        ,b.modelo AS modelo
        ,sum(CAST(a.faixa_verde AS float)) / count(a.veiculo) AS media_fv_real
        ,(select count(a.faixa_verde) from relatorio_trechos a
        LEFT OUTER JOIN bcFrota b ON b.placa_atual = a.veiculo
        LEFT OUTER JOIN metaMedia c ON c.veiculos = b.classe_mec
        WHERE a.faixa_verde <> '50') AS fora_media_fv
        ,(SELECT count(faixa_verde) FROM relatorio_trechos WHERE (cast(faixa_verde as float ) < 10) AND b.frota = ".$val.") AS abaixo_10_fv
        ,(SELECT count(faixa_verde) FROM relatorio_trechos WHERE (cast(faixa_verde as float) BETWEEN 10 AND 20) and b.frota = ".$val.") AS entre_10_22_fv
        ,(SELECT count(faixa_verde) FROM relatorio_trechos WHERE (cast(faixa_verde as float) > 50) AND b.frota = ".$val.") AS acima_50_fv
        ,(SELECT count(faixa_verde) FROM relatorio_trechos WHERE (cast(faixa_verde as float) > 50) AND b.frota = ".$val.")*100 / count(a.veiculo) AS realizado_fv
        FROM relatorio_trechos a
        LEFT OUTER JOIN bcFrota b ON b.placa_atual = a.veiculo
        LEFT OUTER JOIN metaMedia c ON c.veiculos = b.classe_mec
        WHERE b.frota = '".$val."'
        group by a.veiculo,b.frota,c.meta_media,b.modelo
        ");
@endphp
<div class="col-md-4">
    {{Form::label('veiculoMedio', 'Escolha a Frota')}}
    {{Form::select('selectName', $frotas, null,['class'=>'form-control','id'=>'selectName'])}}
</div>
<style type="text/css">
    td{
        text-align: center;
    }

</style>
<div class="col-md-12"></div>
<div class="col-md-11">
        <div class="table-responsive" style="max-height:220px">
            <table class="table">
                <thead style="background-color:green">
                        <tr style="text-align:center;font-size:12px">
                            <th></th>
                            <th>Produtividade Faixa Verde</th>
                            <th></th>
                            <th></th>
                            <th>Total</th>
                            <th></th>
                            <th></th>
                            <th>Ranging</th>
                            <th></th>
                            <th></th>
                            <th>Prod.Consumo</th>
                        </tr>
                        </thead>
                <thead>
                <tr style="font-size:12px;color:white">
                    <th style="background-color:blue">Placa</th>
                    <th style="background-color:blue">Frota</th>
                    <th style="background-color:blue">Avaliadas</th>
                    <th style="background-color:blue">Media Ideal</th>
                    <th style="background-color:blue">Media Real</th>
                    <th style="background-color:blue">Fora da Media</th>
                    <th style="background-color:red">Media Abaixo de 2KM/L</th>
                    <th style="background-color:yellow">Media de 2 a 2.9KM/L</th>
                    <th style="background-color:green">Media Acima de 2.9KM/L</th>
                    <th style="background-color:orange">Meta</th>
                    <th style="background-color:orange">Realizado</th>
                </tr>
                <tbody>
                @for($i=0; $i<count($consumoMedia); $i++)
                <tr style="font-size:12px">
                    <td>{{$consumoMedia[$i]->veiculo}}</td>
                    <td>{{$consumoMedia[$i]->frota}}</td>
                    <td>{{$consumoMedia[$i]->avaliadas}}</td>
                    <td>{{(float)$consumoMedia[$i]->media_ideal}}</td>
                    <td>{{number_format((float)$consumoMedia[$i]->media_real,2,'.','')}}</td>
                    <td>{{$consumoMedia[$i]->fora_media}}</td>
                    <td>{{$consumoMedia[$i]->abaixo_2kml}}</td>
                    <td>{{$consumoMedia[$i]->entre_2kml_29kml}}</td>
                    <td>{{$consumoMedia[$i]->acima_29kml}}</td>
                    <td>90</td>
                    <td>{{$consumoMedia[$i]->realizado}}</td>
                </tr>
                <tr style="font-size:12px">
                        <td style="background-color:rgb(255,230,153)">{{$consumoMedia[$i]->modelo}}</td>
                        <td style="background-color:rgb(255,230,153)">{{(float)$consumoMedia[$i]->media_ideal}}</td>
                        <td style="background-color:gray">{{$consumoMedia[$i]->avaliadas}}</td>
                        <td style="background-color:gray">{{(float)$consumoMedia[$i]->media_ideal}}</td>
                        <td style="background-color:gray">{{number_format((float)$consumoMedia[$i]->media_real,2,'.','')}}</td>
                        <td style="background-color:gray">{{$consumoMedia[$i]->fora_media}}</td>
                        <td style="background-color:gray">{{$consumoMedia[$i]->abaixo_2kml}}</td>
                        <td style="background-color:gray">{{$consumoMedia[$i]->entre_2kml_29kml}}</td>
                        <td style="background-color:gray">{{$consumoMedia[$i]->acima_29kml}}</td>
                        <td>90</td>
                        <td>{{$consumoMedia[$i]->realizado}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-11">
            <div class="table-responsive" style="max-height:220px">
                <table class="table">
                    <thead style="background-color:green">
                            <tr style="text-align:center;font-size:12px">
                                <th></th>
                                <th>Produtividade Faixa Verde</th>
                                <th></th>
                                <th></th>
                                <th>Total</th>
                                <th></th>
                                <th></th>
                                <th>Ranging</th>
                                <th></th>
                                <th></th>
                                <th>Prod.Consumo</th>
                            </tr>
                            </thead>
                    <thead>
                    <tr style="font-size:12px;color:white">
                        <th style="background-color:blue">Placa</th>
                        <th style="background-color:blue">Frota</th>
                        <th style="background-color:blue">Avaliadas</th>
                        <th style="background-color:blue">Faixa Ideal</th>
                        <th style="background-color:blue">Media de Faixa Verde %</th>
                        <th style="background-color:blue">Fora de Faixa Verde</th>
                        <th style="background-color:red">F.V. Abaixo de 10%</th>
                        <th style="background-color:yellow">F.V. Abaixo de 20%</th>
                        <th style="background-color:green">F.V. Acima de 50%</th>
                        <th style="background-color:orange">Meta</th>
                        <th style="background-color:orange">Realizado</th>
                    </tr>
                    <tbody>
                    <tr style="font-size:12px">
                        <td>{{$consumoMedia[$i]->veiculo}}</td>
                        <td>{{$consumoMedia[$i]->frota}}</td>
                        <td>{{$consumoMedia[$i]->avaliadas}}</td>
                        <td>50</td>
                        <td>{{number_format((float)$consumoMedia[$i]->media_fv_real,2,'.','')}}</td>
                        <td>{{$consumoMedia[$i]->fora_media_fv}}</td>
                        <td>{{$consumoMedia[$i]->abaixo_10_fv}}</td>
                        <td>{{$consumoMedia[$i]->entre_10_22_fv}}</td>
                        <td>{{$consumoMedia[$i]->acima_50_fv}}</td>
                        <td>80</td>
                        <td>{{$consumoMedia[$i]->realizado_fv}}</td>
                    </tr>
                    <tr style="font-size:12px">
                        <td style="background-color:rgb(255,230,153)">{{$consumoMedia[$i]->modelo}}</td>
                        <td style="background-color:rgb(255,230,153)">50</td>
                        <td style="background-color:gray">{{$consumoMedia[$i]->avaliadas}}</td>
                        <td style="background-color:gray">50</td>
                        <td style="background-color:gray">{{number_format((float)$consumoMedia[$i]->media_fv_real,2,'.','')}}</td>
                        <td style="background-color:gray">{{$consumoMedia[$i]->fora_media_fv}}</td>
                        <td style="background-color:gray">{{$consumoMedia[$i]->abaixo_10_fv}}</td>
                        <td style="background-color:gray">{{$consumoMedia[$i]->entre_10_22_fv}}</td>
                        <td style="background-color:gray">{{$consumoMedia[$i]->acima_50_fv}}</td>
                        <td>80</td>
                        <td>{{$consumoMedia[$i]->realizado_fv}}</td>
                    </tr>
                    @endfor
                    </tbody>
                </table>
            </div>
        </div>

