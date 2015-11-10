@extends('master')

@section('css')

<!-- BEGIN THEME STYLES -->
{!!Html::style('librerias/assets/global/css/components-md.css')!!}


@stop

@section('contenedor')
<div class="row" ng-app="grupos">
    <div class="row" ng-controller="listado" ng-init="listarGrupos()">
        <div class="pad text-center col-md-12">
            <h3>Selecciona el grupo deseado</h3>
        </div>
        <div class="col-md-12">
            <div>
                <h3>Listado de Grupos <i class="fa fa-group"></i></h3>
            </div>


            <!-- BEGIN EXAMPLE TABLE PORTLET-->

            <div class="portlet box blue" ng-show="listarGrupo.length > 0" ng-cloak="">
                <div class="portlet-body">
                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th class="col-md-2"><a href="" ng-click="reverse = !reverse;
                                            order('grade_id', reverse)">Grado y Grupo &nbsp;<i class="fa fa-sort"></i></a>
                                </th>
                                <th class="col-md-2"><a href="" ng-click="reverse = !reverse;
                                            order('total_students', reverse)">Total de alumnos &nbsp;<i class="fa fa-sort"></i></a></th>
                                <th class="col-md-2">Opciones &nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="grupo in listarGrupo">
                                <td>
                                    <a ng-href="/alumnos/@{{grupo.id}}">
                                        @{{grupo.grade_id}}&nbsp;@{{grupo.group_name}}
                                    </a>
                                </td>
                                <td>
                                    @{{grupo.total_students}}
                                </td>
                                <td>
                                    <a ng-href="/alumnos/@{{grupo.id}}">
                                        Ver Grupo <i class="fa fa-external-link"></i>
                                    </a>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
            <div ng-show="listarGrupo.length == 0" class="pad" ng-cloak="">
                <h3>Por el momento no hay grupos capturados.</h3>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>

    </div>
</div>


@stop


@section('js')


<!-- BEGIN PAGE LEVEL PLUGINS -->

{!!Html::script('js/grupos/listado.js')!!}

@stop