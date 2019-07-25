<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<style type="text/css">
    td{
        text-align: center;
    }
</style>

<div class="col-md-12"></div>
<div class="col-md-11">
        <div class="table-responsive" style="max-height:300px">
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
                            <th></th>
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
                    <th style="background-color:orange">Farol</th>
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
                    <td>{{number_format((float)$consumoMedia[$i]->realizado,2,'.','')}}</td>
                    <td>{{number_format((float)$consumoMedia[$i]->farol,2,'.','')}}</td>
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
                        <td>{{number_format((float)$consumoMedia[$i]->realizado,2,'.','')}}</td>
                        <td>{{number_format((float)$consumoMedia[$i]->farol,2,'.','')}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-11">
            <div class="table-responsive" style="max-height:300px">
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
                                <th></th>
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
                        <th style="background-color:orange">Farol</th>
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
                        <td>{{number_format((float)$consumoMedia[$i]->realizado_fv,2,'.','')}}</td>
                        <td>{{number_format((float)$consumoMedia[$i]->farol_fv,2,'.','')}}</td>

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
                        <td>{{number_format((float)$consumoMedia[$i]->realizado_fv,2,'.','')}}</td>
                        <td>{{number_format((float)$consumoMedia[$i]->farol_fv,2,'.','')}}</td>
                    </tr>
                    @endfor
                    </tbody>
                </table>
            </div>
        </div>


