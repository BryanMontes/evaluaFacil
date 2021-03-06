@extends('master')

@section('css')

<!-- BEGIN THEME STYLES -->
{!!Html::style('librerias/assets/global/css/components-md.css')!!}


@stop

@section('contenedor')
<div class="row" ng-app="docentes">
    <div class="row" ng-controller="listado" ng-init="listarDocentes()">
        <div class="page-bar col-md-12 no_pad">
            <div class="col-md-3 pad">
                <i class="fa fa-home"></i>
                <a href="/">Home</a>
                <i class="fa fa-angle-right"></i>
                <a href="javascript:;">Listado de docentes</a>
            </div>
            <div class="pad text-right col-md-9">
                <input type="button" class="btn btn-primary" ng-click="agregarDocenteModal()" value="+ Agregar">
            </div>
        </div>
        <div class="col-md-12">
            <div>
                <h3>Listado de docentes <i class="fa fa-gavel "></i></h3>
            </div>
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box blue" ng-show="listarDocente.length > 0" ng-cloak="">
                <div class="portlet-body">
                    <table class="table table-striped table-hover table-bordered">
                        <thead style="background-color: #FCF8E9;">
                            <tr>
                                <th class="col-md-2"><a href="" ng-click="reverse = !reverse;
                                            order('first_name', reverse)"><i class="fa fa-user"></i> Nombre(s) &nbsp;<i class="fa fa-sort"></i></a>
                                </th>
                                <th class="col-md-2"><a href="" ng-click="reverse = !reverse;
                                            order('last_name', reverse)"><i class="fa fa-user"></i> Apellido Paterno &nbsp;<i class="fa fa-sort"></i></a></th>
                                <th class="col-md-2"><a href="" ng-click="reverse = !reverse;
                                            order('user.username', reverse)"><i class="fa fa-user"></i> Usuario &nbsp;<i class="fa fa-sort"></i></a></th>
                                <th class="col-md-3"><a href="" ng-click="reverse = !reverse;
                                            order('age', reverse)"><i class="fa fa-cubes"></i> Asignaciones &nbsp;<i class="fa fa-sort"></i></a></th>
                                <th class="col-md-3"><i class="fa fa-cogs"></i> Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="docente in listarDocente">
                                <td>
                                    @{{docente.first_name}}
                                </td>
                                <td>
                                    @{{docente.last_name}}
                                </td>
                                <td>
                                    @{{docente.user_data.username}}
                                </td>
                                <td class="center">
                                    <!--@{{docente.asignaciones}}-->
                                    <a href="/asignaciones/@{{docente.id}}">Asignaciones del docente</a>
                                </td>
                                <td>
                                    <a class="delete" style="color: red;" href="javascript:;" ng-click="borrarDocente(docente.id,docente.user_data.username)">
                                        <i class="fa fa-trash-o"></i> Eliminar&nbsp;&nbsp;</a>
                                    <a class="delete" href="javascript:;" ng-click="editarDocente(docente.id)">
                                        <i class="fa fa-pencil"></i> Editar&nbsp;&nbsp;</a>
                                    <a class="delete" href="javascript:;" ng-click="recuperarPasswordDocente(docente.id)">
                                        <i class="fa fa-retweet"></i> Recuperar Clave</a>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
            <div ng-show="listarDocente.length == 0" class="pad" ng-cloak="">
                <h3>Por el momento no hay docentes capturados.</h3>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
        <div>
            <script type="text/ng-template" id="agregarDocente">
                <div class="modal-header">
                <h3 class="modal-title">Registrar Docente</h3>
                </div> 
                <div class="modal-body">
                <div class="col-md-12 pad-inputs">
                <label class="col-md-2">Nombre:</label>
                <div class="col-md-10">
                <input type="text" class="form-control" ng-model="docente.nombre" maxlength="20">
                </div>
                </div>
                <div class="col-md-12 pad-inputs">
                <label class="col-md-2">Apellidos:</label>
                <div class="col-md-10">
                <input type="text" class="col-md-12 form-control" ng-model="docente.apellido" maxlength="20">
                </div>
                </div>
                <div class="col-md-12 pad-inputs">
                <label class="col-md-2">Email:</label>
                <div class="col-md-10">
                <input type="email" class="form-control" ng-model="docente.email">
                </div>
                </div>
                <div class="col-md-12 pad-inputs">
                <label class="col-md-2">Teléfono:</label>
                <div class="col-md-10">
                <input type="text" class="form-control" ng-model="docente.telefono" maxlength="10">
                </div>
                </div>
                <div class="col-md-12 pad-inputs">
                <label class="col-md-2">Usuario:</label>
                <div class="col-md-10">
                <input type="text" class="form-control" ng-model="docente.usuario" maxlength="20">
                </div>
                </div>
                <div class="col-md-12 pad-inputs">
                <label class="col-md-2 control-label" for="Rol">Rol:</label>
                <div class="col-md-10">
                <select id="Rol" name="Rol" class="form-control" ng-model="docente.rol">
                <option value="teacher">Maestro</option>
                <option value="director">Director</option>
                </select>
                </div>
                </div>
                <div class="col-md-12 pad-inputs">
                <label class="col-md-2">Contraseña:</label>
                <div class="col-md-10">
                <input type="password" class="form-control" ng-model="docente.contrasena" maxlength="10">
                </div>
                </div>
                <div class="col-md-12 pad-inputs">
                <label class="col-md-2">Confirmar Contraseña:</label>
                <div class="col-md-10">
                <input type="password" class="form-control" ng-model="docente.confirmContrasena" maxlength="10">
                </div>
                </div>

                </div>
                <div class="modal-footer">
                <button class="btn btn-primary" type="button" ng-click="guardar()">Guardar</button>
                <button class="btn btn-warning" type="button" ng-click="cancel()">Cancelar</button>
                <ul ng-show="erroresInsertarDocente.length > 0" class="alert alert-danger text-center" style="margin-top: 10px;" ng-cloak>
                <li ng-repeat="error in erroresInsertarDocente">@{{error.tipoError}}</li>
                </ul>
                </div>
            </script>
        </div> 
        <div>
            <script type="text/ng-template" id="editarDocente">
                <div class="modal-header">
                <h3 class="modal-title"><i class="fa-pencil fa" style="font-size:30px;"></i> Editar Docente</h3>
                </div> 
                <div class="modal-body">
                <div class="col-md-12 pad-inputs">
                <label class="col-md-2">Nombre:</label>
                <div class="col-md-10">
                <input type="text" class="form-control" ng-model="editar.first_name" maxlength="20">
                </div>
                </div>
                <div class="col-md-12 pad-inputs">
                <label class="col-md-2">Apellidos:</label>
                <div class="col-md-10">
                <input type="text" class="col-md-12 form-control" ng-model="editar.last_name" maxlength="20">
                </div>
                </div>
                <div class="col-md-12 pad-inputs">
                <label class="col-md-2">Email:</label>
                <div class="col-md-10">
                <input type="email" class="form-control" ng-model="editar.email">
                </div>
                </div>
                <div class="col-md-12 pad-inputs">
                <label class="col-md-2">Teléfono:</label>
                <div class="col-md-10">
                <input type="text" class="form-control" ng-model="editar.contact_number" maxlength="10">
                </div>
                </div>


                </div>
                <div class="modal-footer">
                <button class="btn btn-primary" type="button" ng-click="guardarEditar()">Guardar Cambios</button>
                <button class="btn btn-warning" type="button" ng-click="cancel()">Cancelar</button>
                <ul ng-show="erroresInsertarDocente.length > 0" class="alert alert-danger text-center" style="margin-top: 10px;" ng-cloak>
                <li ng-repeat="error in erroresInsertarDocente">@{{error.tipoError}}</li>
                </ul>
                </div>
            </script>
        </div>
        <div>
            <script type="text/ng-template" id="recuperarPasswordDocente">
                <div class="modal-header">
                <h3 class="modal-title">Reinicializar Contraseña</h3>
                </div> 
                <div class="modal-body">
                <div class="col-md-12 pad-inputs">
                <label class="col-md-3">Nombre:</label>
                <div class="col-md-9">
                <input type="text" class="form-control" ng-model="recuperarPassword.first_name" maxlength="20" disabled="">
                </div>
                </div>
                <div class="col-md-12 pad-inputs">
                <label class="col-md-3">Apellidos:</label>
                <div class="col-md-9">
                <input type="text" class="col-md-12 form-control" ng-model="recuperarPassword.last_name" maxlength="20" disabled="">
                </div>
                </div>
                <div class="col-md-12 pad-inputs">
                <label class="col-md-3">Nombre de usuario:</label>
                <div class="col-md-9">
                <input type="email" class="form-control" ng-model="recuperarPassword.user.username" disabled="">
                </div>
                </div>
                <div class="col-md-12 pad-inputs">
                <label class="col-md-3">Nueva Contraseña:</label>
                <div class="col-md-9">
                <input type="password" class="form-control" ng-model="recuperarPassword.nuevoPassword" maxlength="10">
                </div>
                </div>
                <div class="col-md-12 pad-inputs">
                <label class="col-md-3">Confirmar Contraseña:</label>
                <div class="col-md-9">
                <input type="password" class="form-control" ng-model="recuperarPassword.confirmarPassword" maxlength="10">
                </div>
                </div>

                </div>
                <div class="modal-footer">
                <button class="btn btn-primary" type="button" ng-click="recuperarPasswordDocente()">Guardar Cambios</button>
                <button class="btn btn-warning" type="button" ng-click="cancel()">Cancelar</button>
                <ul ng-show="erroresInsertarDocente.length > 0" class="alert alert-danger text-center" style="margin-top: 10px;" ng-cloak>
                <li ng-repeat="error in erroresInsertarDocente">@{{error.tipoError}}</li>
                </ul>
                </div>
            </script>
        </div>
    </div>
</div>


@stop


@section('js')


<!-- BEGIN PAGE LEVEL PLUGINS -->

{!!Html::script('js/docentes/listado.js')!!}

@stop