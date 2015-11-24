@extends('master')

@section('contenedor')

{!!Html::style('librerias/assets/global/css/components-md.css')!!}

<div class="row" ng-app="administracion">
    <div class="row" ng-controller="administrar" ng-init="listarAdministracion()">
        <div class="page-bar col-md-12 no_pad">
            <div class="col-md-4 pad">
                <i class="fa fa-home"></i>
                <a href="/">Home</a>
                <i class="fa fa-angle-right"></i>
                <a href="javascript:;">Fechas para Indicadores Educativos</a>
            </div>
            <!--            <div class="pad text-right col-md-9">
                            <input type="button" class="btn btn-primary" ng-click="agregarDocenteModal()" value="+ Agregar">
                        </div>-->
        </div>
        <div class="col-md-12">
            <div>
                <h3>Indicadores Educativos <i class="fa fa-database"></i></h3>
            </div>
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box blue" ng-show="listarDataAdministrativa.length > 0" ng-cloak="">
                <div class="portlet-body">
                    <table class="table table-striped table-hover table-bordered">
                        <thead style="background-color: #FCF8E9;">
                            <tr>
                                <th class="col-md-2"><a href="" ng-click="reverse = !reverse;
                                            order('first_name', reverse)"><i class="fa fa-user"></i>No Bimestre &nbsp;<i class="fa fa-th-list"></i></a>
                                </th>
                                <th class="col-md-4"><a href="" ng-click="reverse = !reverse;
                                            order('last_name', reverse)"><i class="fa fa-calendar"></i> Inicia &nbsp;<i class="fa fa-sort"></i></a></th>
                                <th class="col-md-4"><a href="" ng-click="reverse = !reverse;
                                            order('user.username', reverse)"><i class="fa fa-calendar"></i> Termina &nbsp;<i class="fa fa-sort"></i></a></th>
<!--                                <th class="col-md-2"><i class="fa fa-cogs"></i> Opciones</th>-->
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="indicador in listarDataAdministrativa">
                                <td>
                                    @{{indicador.bimester_number}}
                                </td>
                                <td>
                                    @{{indicador.start_timestamp}}
                                </td>
                                <td>
                                    @{{indicador.end_timestamp}}
                                </td>
<!--                                <td>
                                    <a class="delete" href="javascript:;" ng-click="editarIndicadores(indicador.bimester_number)">
                                        <i class="fa fa-pencil"></i> Editar&nbsp;&nbsp;</a>
                                </td>-->
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
            <div ng-show="listarDataAdministrativa.length == 0" class="pad" ng-cloak="">
                <h3>Por el momento no hay indicadores capturados.</h3>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
        
        <div>
            <script type="text/ng-template" id="editarIndicador">
                <div class="modal-header">
                <h3 class="modal-title"><i class="fa-calendar-o fa" style="font-size:30px;"></i> Editar Fecha</h3>
                </div> 
                <div class="modal-body">
                <div class="col-md-12 pad-inputs">
                <label class="col-md-2">Bimestre:</label>
                <div class="col-md-10">
                <input type="text" class="form-control" ng-model="editar.id" maxlength="2" disabled="">
                </div>
                </div>
                <div class="col-md-12 pad-inputs">
                <label class="col-md-2">Inicia:</label>
                <div class="col-md-10">
                <input type="text" class="col-md-12 form-control" ng-model="editar.start_timestamp" maxlength="20" placeholder="año/mes/día">
                </div>
                </div>
                <div class="col-md-12 pad-inputs">
                <label class="col-md-2">Termina:</label>
                <div class="col-md-10">
                <input type="text" class="form-control" ng-model="editar.end_timestamp" placeholder="año/mes/día">
                </div>
                </div>

                </div>
                <div class="modal-footer">
                <button class="btn btn-primary" type="button" ng-click="editarIndicadores()">Guardar</button>
                <button class="btn btn-warning" type="button" ng-click="cancel()">Cancelar</button>
                <ul ng-show="erroresEditarIndicadores.length > 0" class="alert alert-danger text-center" style="margin-top: 10px;" ng-cloak>
                <li ng-repeat="error in erroresEditarIndicadores">@{{error.tipoError}}</li>
                </ul>
                </div>
            </script>
        </div>
    </div>
</div>

@stop


@section('js')
{!!Html::script('js/administracion/administracion.js')!!}
@stop