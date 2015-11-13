@extends('master')

@section('css')

<!-- BEGIN THEME STYLES -->
{!!Html::style('librerias/assets/global/css/components-md.css')!!}


@stop

@section('contenedor')
<div class="row" ng-app="alumnos">
    <div class="row" ng-controller="listado" ng-init="listarAlumnos()">

        <div class="page-bar col-md-12 no_pad">
            <div class="col-md-4 pad">
                <i class="fa fa-home"></i>
                <a href="/">Home</a>
                <i class="fa fa-angle-right"></i>
                <a href="/listadoGrupos">Listado de Grupos</a>
                <i class="fa fa-angle-right"></i>
                <a href="javascript:;">Listado de alumnos</a>
            </div>
            <div class="pad text-right col-md-8">
                <input type="button" class="btn btn-primary" ng-click="agregarAlumnoModal()" value="+ Agregar">
            </div>
        </div>

        <div class="col-md-12">
            <div class="pad">
                <h3>Listado de Alumnos <i class="fa fa-child"></i></h3>
            </div>


            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box blue" ng-show="listarAlumno.length > 0" ng-cloak="">
                <div class="portlet-body">
                    <table class="table table-striped table-hover table-bordered">
                        <thead style="background-color: #FCF8E9;">
                            <tr>
                                <th class="col-md-3"><a href="" ng-click="reverse = !reverse;
                                            order('first_name', reverse)"><i class="fa fa-graduation-cap"></i> Nombre(s) &nbsp;<i class="fa fa-sort"></i></a>
                                </th>
                                <th class="col-md-3"><a href="" ng-click="reverse = !reverse;
                                            order('last_name', reverse)"><i class="fa fa-user"></i> Apellido Paterno &nbsp;<i class="fa fa-sort"></i></a></th>
                                <th class="col-md-2"><a href="" ng-click="reverse = !reverse;
                                            order('mothers_name', reverse)"><i class="fa fa-user"></i> Apellido Materno &nbsp;<i class="fa fa-sort"></i></a></th>
                                <th class="col-md-2"><a href="" ng-click="reverse = !reverse;
                                            order('gender', reverse)"><i class="fa fa-female "></i>/<i class="fa fa-male "></i> Genero &nbsp;<i class="fa fa-sort"></i></a></th>
                                <th class="col-md-2"><i class="fa fa-cogs"></i> Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="alumno in listarAlumno">
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
                                <td>
                                    <a class="delete" style="color: red;" href="javascript:;" ng-click="borrarAlumno(alumno.id)">
                                        <i class="fa fa-trash-o"></i> Eliminar&nbsp;&nbsp;</a>
                                    <a class="delete" href="javascript:;" ng-click="editarAlumno(alumno.id)">
                                        <i class="fa fa-pencil"></i> Editar&nbsp;&nbsp;</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
            <div ng-show="listarAlumno.length == 0" class="pad" ng-cloak="">
                <h3>Por el momento no hay alumnos capturados.</h3>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
        <div>
            <script type="text/ng-template" id="agregarAlumno">
                <div class="modal-header">
                <h3 class="modal-title">Registrar Alumno</h3>
                </div> 
                <div class="modal-body">

                <div class="col-md-12 pad-inputs">
                <label class="col-md-2">Grupo:</label>
                <div class="col-md-10">
                <input type="text" class="form-control" ng-model="alumno.school_group_id" disabled="">
                </div>
                </div>
                <div class="col-md-12 pad-inputs">
                <label class="col-md-2">Nombre(s):</label>
                <div class="col-md-10">
                <input type="text" class="form-control" ng-model="alumno.first_name" maxlength="20">
                </div>
                </div>
                <div class="col-md-12 pad-inputs">
                <label class="col-md-2">Apellido Paterno:</label>
                <div class="col-md-10">
                <input type="text" class="col-md-12 form-control" ng-model="alumno.last_name" maxlength="20">
                </div>
                </div>
                <div class="col-md-12 pad-inputs">
                <label class="col-md-2">Apellido Materno:</label>
                <div class="col-md-10">
                <input type="text" class="col-md-12 form-control" ng-model="alumno.mothers_name" maxlength="20">
                </div>
                </div>
                <div class="col-md-12 pad-inputs">
                <label class="col-md-2 control-label" for="genero">Genero:</label>
                <div class="col-md-10">
                <select id="genero" name="genero" class="form-control" ng-model="alumno.gender">
                <option value="M">Masculino</option>
                <option value="F">Femenino</option>
                </select>
                </div>
                </div>


                </div>
                <div class="modal-footer">
                <button class="btn btn-primary" type="button" ng-click="guardar()">Guardar</button>
                <button class="btn btn-warning" type="button" ng-click="cancel()">Cancelar</button>
                <ul ng-show="erroresInsertarAlumno.length > 0" class="alert alert-danger text-center" style="margin-top: 10px;" ng-cloak>
                <li ng-repeat="error in erroresInsertarAlumno">@{{error.tipoError}}</li>
                </ul>
                </div>
            </script>
        </div> 
        <div>
            <script type="text/ng-template" id="editarAlumno">
                <div class="modal-header">
                <h3 class="modal-title"><i class="fa-pencil fa" style="font-size:30px;"></i> Editar Alumno</h3>
                </div> 
                <div class="modal-body">
                <div class="col-md-12 pad-inputs">
                <label class="col-md-2">Grupo:</label>
                <div class="col-md-10">
                <input type="text" class="form-control" ng-model="alumno.school_group_id" disabled="">
                </div>
                </div>
                <div class="col-md-12 pad-inputs">
                <label class="col-md-2">Nombre(s):</label>
                <div class="col-md-10">
                <input type="text" class="form-control" ng-model="editar.first_name" maxlength="20">
                </div>
                </div>
                <div class="col-md-12 pad-inputs">
                <label class="col-md-2">Apellido Paterno:</label>
                <div class="col-md-10">
                <input type="text" class="col-md-12 form-control" ng-model="editar.last_name" maxlength="20">
                </div>
                </div>
                <div class="col-md-12 pad-inputs">
                <label class="col-md-2">Apellido Materno:</label>
                <div class="col-md-10">
                <input type="text" class="col-md-12 form-control" ng-model="editar.mothers_name" maxlength="20">
                </div>
                </div>
                <div class="col-md-12 pad-inputs">
                <label class="col-md-2 control-label" for="genero">Genero:</label>
                <div class="col-md-10">
                <select id="genero" name="genero" class="form-control" ng-model="editar.gender">
                <option value="M">Masculino</option>
                <option value="F">Femenino</option>
                </select>
                </div>
                </div>


                </div>
                <div class="modal-footer">
                <button class="btn btn-primary" type="button" ng-click="guardarEditar()">Guardar Cambios</button>
                <button class="btn btn-warning" type="button" ng-click="cancel()">Cancelar</button>
                <ul ng-show="erroresInsertarAlumno.length > 0" class="alert alert-danger text-center" style="margin-top: 10px;" ng-cloak>
                <li ng-repeat="error in erroresInsertarAlumno">@{{error.tipoError}}</li>
                </ul>
                </div>
            </script>
        </div>
        <div>
            <script type="text/ng-template" id="recuperarPasswordAlumno">
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
                <button class="btn btn-primary" type="button" ng-click="recuperarPasswordAlumno()">Guardar Cambios</button>
                <button class="btn btn-warning" type="button" ng-click="cancel()">Cancelar</button>
                <ul ng-show="erroresInsertarAlumno.length > 0" class="alert alert-danger text-center" style="margin-top: 10px;" ng-cloak>
                <li ng-repeat="error in erroresInsertarAlumno">@{{error.tipoError}}</li>
                </ul>
                </div>
            </script>
        </div>
    </div>
</div>


@stop


@section('js')


<!-- BEGIN PAGE LEVEL PLUGINS -->

{!!Html::script('js/alumnos/listado.js')!!}

@stop