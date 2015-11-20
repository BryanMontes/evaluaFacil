@extends('master')

@section('css')

<!-- BEGIN THEME STYLES -->
{!!Html::style('librerias/assets/global/css/components-md.css')!!}


@stop

@section('contenedor')

<div class="row" ng-app="asignaciones">
    <div class="row" ng-controller="listado">
        <div class="page-bar col-md-12 no_pad">
            <div class="col-md-4 pad">
                <i class="fa fa-home"></i>
                <a href="/">Home</a>
                <i class="fa fa-angle-right"></i>
                <a href="/docentes">Asignaciones</a>
                <i class="fa fa-angle-right"></i>
                <a href="javascript:;">Editar asignaciones</a>
            </div>
        </div>
        <div class="col-md-12">
            <div>
                <h3>Editar asignaciones de @{{listarInfoDocente.first_name}} <i class="fa fa-gavel "></i></h3>
            </div>


            <div class="row">
                <div class="col-md-6 pad-inputs">
                    <label>Nombre</label>
                    <input ng-model="listarInfoDocente.first_name" disabled="" class="form-control" maxlength="30"> 
                </div>
                <div class="col-md-6 pad-inputs">
                    <label>Apellidos</label>
                    <input ng-model="listarInfoDocente.last_name" disabled="" class="form-control" maxlength="30">
                </div>
                <div class="col-md-6 pad-inputs">
                    <label>Número de telefono</label>
                    <input ng-model="listarInfoDocente.contact_number" disabled="" class="form-control" maxlength="10"> 
                </div>
                <div class="col-md-6 pad-inputs">
                    <label>Titulo</label>
                    <input ng-model="listarInfoDocente.title" disabled="" class="form-control">
                </div>
                <div class="col-md-6 pad-inputs">
                    <label>E-mail</label>
                    <input ng-model="listarInfoDocente.email" disabled="" class="form-control">
                </div>
                <div class="col-md-6 pad-inputs">
                    <label>Puesto</label>
                    <input ng-model="listarInfoDocente.user.role.title" disabled="" class="form-control">
                </div>
                <div class="pad text-right col-md-12">
                    <input type="button" class="btn btn-primary" ng-click="agregarAsignacionModal()" value="+ Agregar">
                </div>
            </div>







            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box blue" ng-show="listarAsignaciones.length > 0" ng-cloak="">
                <div class="portlet-body">
                    <table class="table table-striped table-hover table-bordered">
                        <thead style="background-color: #FCF8E9;">
                            <tr>
                                <th class="col-md-2"><a href="" ng-click="reverse = !reverse;
                                            order('group.group_name', reverse)"><i class="fa fa-group"></i> Grupos &nbsp;<i class="fa fa-sort"></i></a>
                                </th>
                                <th class="col-md-2"><a href="" ng-click="reverse = !reverse;
                                            order('subject.title', reverse)"><i class="fa fa-list-alt"></i> Materia &nbsp;<i class="fa fa-sort"></i></a></th>
                                <th class="col-md-3"><i class="fa fa-cogs"></i> Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="asignacion in listarAsignaciones">
                                <td>
                                    @{{asignacion.grade.grade_number}}º@{{asignacion.group.group_name}}
                                </td>
                                <td>
                                    @{{asignacion.subject.title}}
                                </td>
                                <td>
                                    <a class="delete" style="color: red;" href="javascript:;" ng-click="borrarAsignacion(asignacion.id)">
                                        <i class="fa fa-trash-o"></i> Eliminar&nbsp;&nbsp;</a>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
            <div ng-show="listarAsignaciones.length == 0" class="pad" ng-cloak="">
                <h3>Por el momento no hay asignaciones capturadas para el actual docente.</h3>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
        <div>
            <script type="text/ng-template" id="agregarAsignacion">
                <div class="modal-header">
                <h3 class="modal-title">Seleccione una asignación</h3>
                </div> 
                <div class="modal-body">
                
                <div class="col-md-12 pad-inputs" ng-hide="listarAsignaciones.length==0" ng-clocka="">
                    <table class="table table-striped table-hover table-bordered">
                        <thead style="background-color: #FCF8E9;">
                            <tr>
                                <th class="col-md-2"><i class="fa fa-check-square-o"></i> Seleccionar</th>
                                <th class="col-md-2"><a href="" ng-click="reverse = !reverse;
                                            order('grade.grade_number', reverse)"><i class="fa fa-group"></i> Grupos &nbsp;<i class="fa fa-sort"></i></a>
                                </th>
                                <th class="col-md-2"><a href="" ng-click="reverse = !reverse;
                                            order('subject.title', reverse)"><i class="fa fa-list-alt"></i> Materia &nbsp;<i class="fa fa-sort"></i></a></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="asignacionDisponibles in listarAsignaciones">
                                <td>
                                    <input type="checkbox" checklist-model="asignacionDisponible.ides" data-checklist-value="asignacionDisponibles" ng-click="console()">
                                </td>
                                <td>
                                    @{{asignacionDisponibles.grade.grade_number}}º@{{asignacionDisponibles.school_group.group_name}}
                                </td>
                                <td>
                                    @{{asignacionDisponibles.subject.title}}
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
       
            <div ng-show="listarAsignaciones.length==0" class="pad" ng-cloak="">
                <h3>Por el momento no hay asignaciones disponibles.</h3>
            </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" ng-click="guardar()">Guardar</button>
                    <button class="btn btn-warning" type="button" ng-click="cancel()">Cancelar</button>
                    <ul ng-show="erroresInsertarAsignacion.length > 0" class="alert alert-danger text-center" style="margin-top: 10px;" ng-cloak>
                        <li ng-repeat="error in erroresInsertarAsignacion">@{{error.tipoError}}</li>
                    </ul>
                </div>
            </script>
        </div>
        
    </div>
</div>


@stop

@section('js')
{!!Html::script('js/docentes/asignaciones.js')!!}
{!!Html::script('js/dependencias/checklist-model.js')!!}
@stop