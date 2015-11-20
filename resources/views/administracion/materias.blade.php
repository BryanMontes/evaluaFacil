@extends('master')

@section('contenedor')

<div class="row" ng-app="administracionMaterias">
    <div class="row" ng-controller="materias">
        <div class="page-bar col-md-12 no_pad">
            <div class="col-md-4 pad">
                <i class="fa fa-home"></i>
                <a href="/">Home</a>
                <i class="fa fa-angle-right"></i>
                <a href="javascript:;">Materias</a>
            </div>
            <!--            <div class="pad text-right col-md-9">
                            <input type="button" class="btn btn-primary" ng-click="agregarDocenteModal()" value="+ Agregar">
                        </div>-->
        </div>
        <div class="col-md-12">
            <div>
                <h3>Materias <i class="fa fa-list-alt"></i></h3>
            </div>
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box blue" ng-show="listarDataAdministrativa.length > 0" ng-cloak="">
                <div class="portlet-body">
                    <table class="table table-striped table-hover table-bordered">
                        <thead style="background-color: #FCF8E9;">
                            <tr>
                                <th class="col-md-2"><a href="" ng-click="reverse = !reverse;
                                            order('first_name', reverse)"><i class="fa fa-user"></i> Bimestre &nbsp;<i class="fa fa-sort"></i></a>
                                </th>
                                <th class="col-md-2"><a href="" ng-click="reverse = !reverse;
                                            order('last_name', reverse)"><i class="fa fa-calendar"></i> Inicia &nbsp;<i class="fa fa-sort"></i></a></th>
                                <th class="col-md-2"><a href="" ng-click="reverse = !reverse;
                                            order('user.username', reverse)"><i class="fa fa-calendar"></i> Termina &nbsp;<i class="fa fa-sort"></i></a></th>
                                <th class="col-md-3"><i class="fa fa-cogs"></i> Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="indicador in listarDataAdministrativa">
                                <td>
                                    @{{indicador.bimester}}
                                </td>
                                <td>
                                    @{{indicador.start}}
                                </td>
                                <td>
                                    @{{indicador.finish}}
                                </td>
                                <td>
                                    <a class="delete" href="javascript:;" ng-click="editarIndicadores(indicador.id)">
                                        <i class="fa fa-pencil"></i> Editar&nbsp;&nbsp;</a>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
            <div ng-show="listarDataAdministrativa.length == 0" class="pad" ng-cloak="">
                <h3>Por el momento no hay materias capturadas.</h3>
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
                <label class="col-md-2">Grupo:</label>
                <div class="col-md-10">
                <input type="text" class="form-control" ng-model="editar.group" maxlength="20" disabled="">
                </div>
                </div>
                <div class="col-md-12 pad-inputs">
                <label class="col-md-2">Inicia:</label>
                <div class="col-md-10">
                <input type="text" class="col-md-12 form-control" ng-model="editar.start" maxlength="20">
                </div>
                </div>
                <div class="col-md-12 pad-inputs">
                <label class="col-md-2">Termina:</label>
                <div class="col-md-10">
                <input type="text" class="form-control" ng-model="editar.finish">
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
{!!Html::script('js/administracion/materias.js')!!}
@stop