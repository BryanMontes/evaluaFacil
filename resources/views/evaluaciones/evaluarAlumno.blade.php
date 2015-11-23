@extends('master')

@section('contenedor')
{!!Html::style('librerias/assets/global/css/components-md.css')!!}
<div class="row" ng-app="seleccionBimestre">
    <div ng-controller="seleccion">
        <div class="page-bar col-md-12 no_pad">
            <div class="col-md-4 pad">
                <i class="fa fa-home"></i>
                <a href="/">Home</a>
                <i class="fa fa-angle-right"></i>
                <a href="/evaluaciones">Evaluaciones</a>
                <i class="fa fa-angle-right"></i>
                <a href="javascript:;">Evaluando Alumno</a>
            </div>
        </div>
        <div class="col-md-12">
            <div>
                <h3>Evaluar a @{{arregloMateria.first_name}} @{{arregloMateria.last_name}} <i class="fa fa-pencil-square-o" style="font-size:30px;"></i></h3>
            </div>
            <div class="portlet-body" ng-cloak="" ng-init="arregloMaterias()">
                <ul class="nav nav-tabs">
                    <li ng-repeat="materia in arregloMateria.missing" ng-class="{'active tabss' :$first}" >
                        <a data-toggle="tab"  href="#@{{materia.title}}" class="signatureName">
                            @{{materia.title}} </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="@{{materia.title}}" class="tab-pane fade" ng-repeat="materia in arregloMateria.missing" ng-class="{'active in' :$first}">

                        <div class="row">
                            <div class="col-md-12">
                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                <div class="portlet box blue" ng-show="arregloMateria.missing.length > 0" ng-cloak="">
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
                                                <tr>
                                                    <td>
                                                        @{{arregloMateria.first_name}}
                                                    </td>
                                                    <td>
                                                        @{{arregloMateria.last_name}}
                                                    </td>
                                                    <td>
                                                        @{{arregloMateria.mothers_name}}
                                                    </td>
                                                    <td class="center">
                                                        <div ng-if="arregloMateria.gender == 'M'">Masculino</div>
                                                        <div ng-if="arregloMateria.gender == 'F'">Femenino</div>
                                                    </td>
                                                    <td>
                                                        <a class="delete" href="javascript:;" ng-click="evaluarAlumno(arregloMateria.id, materia.subject_id)">
                                                            <i class="fa fa-pencil"></i> Evaluar&nbsp;&nbsp;</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                                <div ng-show="arregloMateria.missing.length == 0" class="pad" ng-cloak="">
                                    <h3>Por el momento no hay evaluaciones disponibles para el alumno.</h3>
                                </div>
                                <!-- END EXAMPLE TABLE PORTLET-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>   
        </div>  
        <div>
            <script type="text/ng-template" id="evaluarAlumno">
                <div class="modal-header">
                <h3 class="modal-title"><i class="fa fa-pencil-square-o" style="font-size:30px;"></i> Indicadores del Alumno</h3>
                </div> 
                <div class="modal-body">

                <div class="col-md-12 pad-inputs">
                <label class="col-md-2">Alumno: </label>
                <div class="col-md-10 bold">
                @{{alumno.first_name}} @{{alumno.last_name}}                
                </div>
                </div>
                <div class="col-md-12 pad-inputs">
                <label class="col-md-2">Faltas:</label>
                <div class="col-md-10">
                <input type="text" class="form-control" ng-model="alumno.absences_count" maxlength="3">
                </div>
                </div>

                <div class="col-md-12 pad-inputs">
                <label class="col-md-2">Participación:</label>
                <div class="col-md-10">
                <input type="text" class="form-control" ng-model="alumno.participation_score" maxlength="3">

                </div>
                </div>

                <div class="col-md-12 pad-inputs">
                <label class="col-md-2">Desempeño:</label>
                <div class="col-md-10">
                <input type="text" class="col-md-12 form-control" ng-model="alumno.performance_score" maxlength="3">
                </div>
                </div>
                <div class="col-md-12 pad-inputs" ng-if="nombreMateria=='Español'">
                <label class="col-md-2 control-label">Comprensión lectora:</label>
                <div class="col-md-10">
                <input type="text" class="col-md-12 form-control" ng-model="alumno.reading_score" maxlength="3">

                </div>
                </div>
                <div class="col-md-12 pad-inputs" ng-if="nombreMateria=='Matemáticas'">
                <label class="col-md-2 control-label">Comprensión matemática:</label>
                <div class="col-md-10">
                <input type="text" class="col-md-12 form-control" ng-model="alumno.math_score" maxlength="3">
                </div>
                </div>
                <div class="col-md-12 pad-inputs" ng-if="nombreMateria=='FormaciónCívicayÉtica'">
                <label class="col-md-2 control-label">Convivencia escolar:</label>
                <div class="col-md-10">
                <input type="text" class="col-md-12 form-control" ng-model="alumno.friendship_score" maxlength="3">
                </div>
                </div>

                </div>
                <div class="modal-footer">
                <button class="btn btn-primary" type="button" ng-click="bimestreActual()">Guardar</button>
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
{!!Html::script('js/evaluaciones/evaluarAlumno.js')!!}

@stop