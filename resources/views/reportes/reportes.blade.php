@extends('master')

@section('contenedor')

<div class="row" ng-app="reportes">
    <div class="row" ng-controller="llenadoReportes">
        <div class="page-bar col-md-12 no_pad">
            <div class="col-md-3 pad">
                <i class="fa fa-home"></i>
                <a href="/">Home</a>
            </div>
        </div>
        <div class="col-md-6 pad" ng-init="llenadoInformacion()" ng-cloak="">
            <div class="col-md-6 col-xs-6">
                <select class="form-control" data-style="btn-default" id="bimestre" title="Bimestre" ng-model="bimestreId" ng-change="traerEspecifico()">
                    <option value="@{{bimestre.id}}" ng-repeat="bimestre in bimestres">Bimestre @{{bimestre.bimester_number}}</option>
                </select>
            </div>
            <div class="col-mdç col-xs-6">
                <select class="form-control col-md-5 col-xs-5" title="Grupo" id="grupo" ng-model="grupoId" ng-change="traerEspecifico()">
                    <option  value="@{{grupo.id}}" ng-repeat="grupo in grupos">@{{grupo.grade_id}}º@{{grupo.group_name}}</option>
                </select>
            </div>
        </div>

        <div class="col-md-12 col-xs-12" ng-cloak="" >
            <div class="col-md-5 col-xs-5 contorno text-center caja_blanca">
                <span class="bold">Asistencia</span>
                <div id="canvas-holder" style="margin-top: 20px;">
                    <canvas id="asistencia" width="150" height="150"/>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Concepto</th>
                            <th>Valor</th>
                            <th>Porcentaje</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="asistencia in asistencias">
                            <td>@{{asistencia.item}}</td>
                            <td>@{{asistencia.count}}</td>
                            <td>@{{(asistencia.ratio * 100).toFixed(2)}}%</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="col-md-2 col-xs-2"></div>
            <div class="col-md-5 col-xs-5 contorno text-center caja_blanca">
                <span class="bold">Participación</span>
                <div id="canvas-holder" style="margin-top: 20px">
                    <canvas id="participacion" width="150" height="150"/>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Concepto</th>
                            <th>Valor</th>
                            <th>Porcentaje</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="participa in participacion">
                            <td>@{{participa.item}}</td>
                            <td>@{{participa.count}}</td>
                            <td>@{{(participa.ratio * 100).toFixed(2)}}%</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="col-md-5 col-xs-5 contorno text-center caja_blanca">
                <span class="bold">Desempeño</span>
                <div id="canvas-holder" style="margin-top: 20px">
                    <canvas id="desempeno" width="150" height="150"/>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Concepto</th>
                            <th>Valor</th>
                            <th>Porcentaje</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="des in desempeno">
                            <td>@{{des.item}}</td>
                            <td>@{{des.count}}</td>
                            <td>@{{(des.ratio * 100).toFixed(2)}}%</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-2 col-xs-2"></div>
            <div class="col-md-5 col-xs-5 contorno text-center caja_blanca">
                <span class="bold">Comprensión Lectora</span>
                <div id="canvas-holder" style="margin-top: 20px">
                    <canvas id="lectora" width="150" height="150"/>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Concepto</th>
                            <th>Valor</th>
                            <th>Porcentaje</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="lector in lectora">
                            <td>@{{lector.item}}</td>
                            <td>@{{lector.count}}</td>
                            <td>@{{(lector.ratio * 100).toFixed(2)}}%</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="col-md-5 col-xs-5 contorno text-center caja_blanca">
                <span class="bold">Comprensión Matemática</span>
                <div id="canvas-holder" style="margin-top: 20px">
                    <canvas id="matematica" width="150" height="150"/>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Concepto</th>
                            <th>Valor</th>
                            <th>Porcentaje</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="mate in matematica">
                            <td>@{{mate.item}}</td>
                            <td>@{{mate.count}}</td>
                            <td>@{{(mate.ratio * 100).toFixed(2)}}%</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-2 col-xs-2"></div>
            <div class="col-md-5 col-xs-5 contorno text-center caja_blanca">
                <span class="bold">Convivencia Escolar</span>
                <div id="canvas-holder" style="margin-top: 20px">
                    <canvas id="escolar" width="150" height="150"/>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Concepto</th>
                            <th>Valor</th>
                            <th>Porcentaje</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="actitudes in actitud">
                            <td>@{{actitudes.item}}</td>
                            <td>@{{actitudes.count}}</td>
                            <td>@{{(actitudes.ratio * 100).toFixed(2)}}%</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div ng-cloak="" ng-show="cargando">
            <h2>Cargando Información, por favor espere.</h2>
        </div>
        <div ng-cloak="" ng-show="cargando==false && asistencias.length == 0 && participacion.length == 0 && desempeno.length == 0 && lectora.length == 0 && matematica.length == 0">
            <h2>No hay información del bimestre y grupo seleccionado.</h2>
        </div>
    </div>


</div>


@stop


@section('js')
{!!Html::script('js/dependencias/Chart.js')!!}
{!!Html::script('js/reportes/reportes.js')!!}

@stop