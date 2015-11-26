@extends('master')

@section('contenedor')
{!!Html::style('librerias/assets/global/css/components-md.css')!!}

<div class="row" ng-app="evaluaciones">
    <div class="col-md-12 pad" ng-controller="captura_evaluaciones">
        <div class="page-bar col-md-12 no_pad">
            <div class="col-md-4 pad">
                <i class="fa fa-home"></i>
                <a href="/">Home</a>
                <i class="fa fa-angle-right"></i>
                <a href="/evaluaciones">Evaluaciones</a>
            </div>
        </div>
        <div class="col-md-12">
            <div>
                <h3>Evaluaciones Bimestrales <i class="fa fa-pencil-square-o" style="font-size:30px;"></i></h3>
            </div>
            <div class="portlet-body" ng-cloak="">
                <ul class="nav nav-tabs">
                    <li ng-repeat="local in arregloLocal" ng-class="{'active' :$first}" ng-click="listarEvaluaciones(local.id_grupo)">
                        <a data-toggle="tab" href="#@{{local.id_grupo}}">
                            @{{local.grado}}º@{{local.grupo}} </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="@{{local.id_grupo}}" class="tab-pane fade" ng-repeat="local in arregloLocal" ng-class="{'active in' :$first}">

                        <div class="row">
                            <div class="col-md-12">
                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                <div class="portlet box blue" ng-show="listarEvaluacion.length > 0" ng-cloak="">
                                    <div class="portlet-body">
                                        <table class="table table-striped table-hover table-bordered">
                                            <thead style="background-color: #FCF8E9;">
                                                <tr>
                                                    <th class="col-md-2"><a href="" ng-click="reverse = !reverse;
                                                                    order('first_name', reverse)"><i class="fa fa-graduation-cap"></i> Nombre(s) &nbsp;<i class="fa fa-sort"></i></a>
                                                    </th>
                                                    <th class="col-md-2"><a href="" ng-click="reverse = !reverse;
                                                                    order('last_name', reverse)"><i class="fa fa-user"></i> Apellido Paterno &nbsp;<i class="fa fa-sort"></i></a>
                                                    </th>
                                                    <th class="col-md-2"><a href="" ng-click="reverse = !reverse;
                                                                    order('mothers_name', reverse)"><i class="fa fa-user"></i> Apellido Materno &nbsp;<i class="fa fa-sort"></i></a>
                                                    </th>
                                                    <th class="col-md-2"><a href="" ng-click="reverse = !reverse;
                                                                    order('gender', reverse)"><i class="fa fa-female "></i>/<i class="fa fa-male "></i> Genero &nbsp;<i class="fa fa-sort"></i></a>
                                                    </th>
                                                    <th class="col-md-2"><i class="fa fa-pencil"></i> Evaluación</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="alumno in listarEvaluacion">
                                                    <td>
                                                        @{{alumno.first_name}}
                                                    </td>
                                                    <td>
                                                        @{{alumno.last_name}}
                                                    </td>
                                                    <td>
                                                        @{{alumno.mothers_name}}
                                                    </td>
                                                    <td class="center">
                                                        <div ng-if="alumno.gender == 'M'">Masculino</div>
                                                        <div ng-if="alumno.gender == 'F'">Femenino</div>
                                                    </td>
                                                    <td ng-show="alumno.missing.length>0">
                                                        <a href="/evaluaralumno/@{{alumno.id}}/@{{local.id_grupo}}">
                                                            <i class="fa fa-pencil"></i> Evaluar&nbsp;&nbsp;</a>
                                                    </td>
                                                    <td ng-show="alumno.missing.length==0">
                                                        Ya evaluado  <i class="fa fa-check"></i>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                                <div ng-show="listarEvaluacion.length == 0" class="pad" ng-cloak="">
                                    <h3>Por el momento no hay evaluaciones disponibles.</h3>
                                </div>
                                <!-- END EXAMPLE TABLE PORTLET-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop


@section('js')
{!!Html::script('js/evaluaciones/evaluaciones.js')!!}

@stop