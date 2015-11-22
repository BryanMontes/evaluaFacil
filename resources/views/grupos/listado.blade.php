@extends('master')

@section('css')

<!-- BEGIN THEME STYLES -->
{!!Html::style('librerias/assets/global/css/components-md.css')!!}


@stop

@section('contenedor')
<div class="row" ng-app="grupos">
    <div class="row" ng-controller="listado" ng-init="listarGrupos()">

        <div class="page-bar col-md-12 no_pad">
            <div class="col-md-3 pad">
                <i class="fa fa-home"></i>
                <a href="/">Home</a>
                <i class="fa fa-angle-right"></i>
                <a href="#">Listado de Grupos</a>
            </div>
            <div class="pad text-right col-md-9">
                <input type="button" class="btn btn-primary" ng-click="agregarGrupoModal()" value="+ Agregar">
            </div>
        </div>

        <div class="col-md-12">

            <div>
                <h3>Listado de grupos <i class="fa fa-group"></i></h3>
            </div>
            <!-- BEGIN EXAMPLE TABLE PORTLET-->

            <div class="portlet box blue">
                <div class="portlet-body">
                    <table class="table table-striped table-hover table-bordered" ng-cloak="">
                        <thead style="background-color: #FCF8E9;">
                            <tr>
                                <th class="col-md-2"><a href="" ng-click="reverse = !reverse;
                                            order('grade_id', reverse)"><i class="fa fa-book"></i> Grado &nbsp;<i class="fa fa-sort"></i></a>
                                </th>
                                <th class="col-md-2"><a href="" ng-click="reverse = !reverse;
                                            order('group_name', reverse)"><i class="fa-language fa"></i> Grupo &nbsp;<i class="fa fa-sort"></i></a></th>
                                <th class="col-md-2"><a href="" ng-click="reverse = !reverse;
                                            order('total_students', reverse)"><i class="fa fa-users"></i>  Total de alumnos &nbsp;<i class="fa fa-sort"></i></a></th>
                                <th class="col-md-3"><i class="fa fa-cogs"></i> Opciones</th>
                            </tr>
                        </thead>
                        <tbody  ng-show="listarGrupo.length > 0">
                            <tr ng-repeat="grupo in listarGrupo">
                                <td>
                                    @{{grupo.grade_id}}
                                </td>
                                <td>
                                    @{{grupo.group_name}}
                                </td>
                                <td>
                                    @{{grupo.total_students}}
                                </td>
                                <td>
                                    <a class="delete" style="color: red;" href="javascript:;" ng-click="borrarGrupo(grupo.id)">
                                        <i class="fa fa-trash-o"></i> Eliminar&nbsp;&nbsp;</a>
                                    <a class="delete" href="javascript:;" ng-click="editarGrupo(grupo.id)">
                                        <i class="fa fa-pencil"></i> Editar&nbsp;&nbsp;</a>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
        <div>
            <script type="text/ng-template" id="agregarGrupo">
                <div class="modal-header">
                <h3 class="modal-title"><i class="fa-edit fa" style="font-size:30px;"></i> Registrar Grupo</h3>
                </div> 
                <div class="modal-body">

                <div class="col-md-12 pad-inputs">
                <label class="col-md-2 control-label" for="Rol">Grado:</label>
                <div class="col-md-10">
                <select id="grado" name="grado" class="form-control" ng-model="grupo.grade_number">
                <option value="1">1º Secundaria</option>
                <option value="2">2º Secundaria</option>
                <option value="3">3º Secundaria</option> 
                </select>
                </div>
                </div>

                <div class="col-md-12 pad-inputs">
                <label class="col-md-2">Grupo/Letra:</label>
                <div class="col-md-10">
                <input type="letra" class="form-control" ng-model="grupo.group_name" maxlength="1">
                </div>
                </div>

                </div>
                <div class="modal-footer">
                <button class="btn btn-primary" type="button" ng-click="guardarGrupo()">Guardar</button>
                <button class="btn btn-warning" type="button" ng-click="cancel()">Cancelar</button>
                <ul ng-show="erroresInsertarGrupo.length > 0" class="alert alert-danger text-center" style="margin-top: 10px;" ng-cloak>
                <li ng-repeat="error in erroresInsertarGrupo">@{{error.tipoError}}</li>
                </ul>
                </div>
            </script>
        </div> 
        <div>
            <script type="text/ng-template" id="editarGrupo">
                <div class="modal-header">
                <h3 class="modal-title"><i class="fa-pencil fa" style="font-size:30px;"></i> Editar Grupo</h3>
                </div> 
                <div class="modal-body">
                <div class="col-md-12 pad-inputs">
                <label class="col-md-2 control-label" for="Rol">Grado:</label>
                <div class="col-md-10">
                <input type="letra" class="form-control" ng-model="editar.grade_id" maxlength="1" disabled="">
                </div>
                </div>

                <div class="col-md-12 pad-inputs">
                <label class="col-md-2">Grupo/Letra:</label>
                <div class="col-md-10">
                <input type="letra" class="form-control" ng-model="editar.group_name" maxlength="1">
                </div>
                </div>


                </div>
                <div class="modal-footer">
                <button class="btn btn-primary" type="button" ng-click="guardarEditar()">Guardar Cambios</button>
                <button class="btn btn-warning" type="button" ng-click="cancel()">Cancelar</button>
                <ul ng-show="erroresInsertarGrupo.length > 0" class="alert alert-danger text-center" style="margin-top: 10px;" ng-cloak>
                <li ng-repeat="error in erroresInsertarGrupo">@{{error.tipoError}}</li>
                </ul>
                </div>
            </script>
        </div>
    </div>
</div>


@stop


@section('js')


<!-- BEGIN PAGE LEVEL PLUGINS -->

{!!Html::script('js/grupos/listado.js')!!}

@stop