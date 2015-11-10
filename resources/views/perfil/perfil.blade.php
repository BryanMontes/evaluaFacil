@extends('master')

@section('contenedor')
{!!Html::style('css/select.css')!!}

<div class="row" ng-app="perfil">
    <div class="col-md-12" ng-controller="informacionPerfil">
        <h3 class="text-center pad">Perfil de usuario</h3>

        <div class="col-md-6 pad-inputs">
            <label>Nombre</label>
            <input ng-model="perfil.first_name" class="form-control" maxlength="30"> 
        </div>
        <div class="col-md-6 pad-inputs">
            <label>Apellidos</label>
            <input ng-model="perfil.last_name" class="form-control" maxlength="30">
        </div>
        <div class="col-md-6 pad-inputs">
            <label>Número de telefono</label>
            <input ng-model="perfil.contact_number" class="form-control" maxlength="10"> 
        </div>
        <div class="col-md-6 pad-inputs">
            <label>Titulo</label>
            <input ng-model="perfil.title" class="form-control">
        </div>
        <div class="col-md-6 pad-inputs">
            <label>E-mail</label>
            <input ng-model="perfil.email" disabled="" class="form-control">
        </div>
        <div class="col-md-6 pad-inputs">
            <label>Puesto</label>
            <input ng-model="perfil.user.role" disabled="" class="form-control">
        </div>
        

        <div class="col-md-12 text-center">
            <input class="btn btn-success" type="button" value="Guardar Cambios" ng-click="editarPerfil()"> 
            <input class="btn" type="button" value="Cancelar" onclick="window.location='/'"> 
        </div>

    </div>
</div>


@stop


@section('js')
{!!Html::script('js/dependencias/select.js')!!}
{!!Html::script('js/perfil/perfil.js')!!}

@stop
