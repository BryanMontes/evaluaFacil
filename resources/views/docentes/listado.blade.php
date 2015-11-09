@extends('master')

@section('css')

<!-- BEGIN PAGE LEVEL STYLES -->
{!!Html::style('librerias/assets/global/plugins/select2/select2.css')!!}
{!!Html::style('librerias/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css')!!}
<!-- END PAGE LEVEL STYLES -->
<!-- BEGIN THEME STYLES -->
{!!Html::style('librerias/assets/global/css/components-md.css')!!}
{!!Html::style('librerias/assets/global/css/plugins-md.css')!!}
{!!Html::style('librerias/assets/admin/layout/css/layout.css')!!}
{!!Html::style('librerias/assets/admin/layout/css/custom.css')!!}
@stop

@section('contenedor')
<div class="row" ng-app="docentes">
    <div class="row" ng-controller="listado" ng-init="listarDocentes()">
        <div class="pad text-right col-md-12">
            <input type="button" class="btn btn-primary" ng-click="agregarDocenteModal()" value="+ Agregar">
        </div>
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box blue">

                <div class="portlet-body">
                    <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                        <thead>
                            <tr>
                                <th>
                                    Nombre(s)
                                </th>
                                <th>
                                    Apellido Paterno
                                </th>
                                <th>
                                    Usuario
                                </th>
                                <th>
                                    Asignaciones
                                </th>
                                <th> 
                                    Borrar
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="docente in listarDocentes" ng-if="listarDocentes.length>0">
                                <td>
                                    @{{docente.nombre}}
                                </td>
                                <td>
                                    @{{docente.apellido}}
                                </td>
                                <td>
                                    @{{docente.usuario}}
                                </td>
                                <td class="center">
                                    @{{docente.asignaciones}}
                                </td>
                                <td>
                                    <a class="delete" href="javascript:;">
                                        Delete </a>
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
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
                            <input type="text" class="form-control" ng-model="docente.nombre">
                        </div>
                    </div>
                    <div class="col-md-12 pad-inputs">
                        <label class="col-md-2">Apellidos:</label>
                        <div class="col-md-10">
                            <input type="text" class="col-md-12 form-control" ng-model="docente.apellido">
                        </div>
                    </div>
                    <div class="col-md-12 pad-inputs">
                        <label class="col-md-2">Email:</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" ng-model="docente.email">
                        </div>
                    </div>
                    <div class="col-md-12 pad-inputs">
                        <label class="col-md-2">Teléfono:</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" ng-model="docente.telefono">
                        </div>
                    </div>
                    <div class="col-md-12 pad-inputs">
                        <label class="col-md-2">Usuario:</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" ng-model="docente.usuario">
                        </div>
                    </div>
                    <div class="col-md-12 pad-inputs">
                        <label class="col-md-2">Contraseña:</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" ng-model="docente.contrasena">
                        </div>
                    </div>
                        <div class="col-md-12 pad-inputs">
                        <label class="col-md-2">Confirmar Contraseña:</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" ng-model="docente.confirmContrasena">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" ng-click="guardar()">Guardar</button>
                    <button class="btn btn-warning" type="button" ng-click="cancel()">Cancelar</button>
                </div>
            </script>
        </div>  
    </div>
</div>


@stop


@section('js')


<!-- BEGIN PAGE LEVEL PLUGINS -->
{!!Html::script('librerias/assets/global/plugins/select2/select2.min.js')!!}
{!!Html::script('librerias/assets/global/plugins/datatables/media/js/jquery.dataTables.min.js')!!}
{!!Html::script('librerias/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js')!!}
{!!Html::script('librerias/assets/admin/pages/scripts/table-editable.js')!!}
<script>
    jQuery(document).ready(function () {
        Metronic.init(); // init metronic core components
        TableEditable.init();
    });
</script>
{!!Html::script('js/docentes/listado.js')!!}

@stop