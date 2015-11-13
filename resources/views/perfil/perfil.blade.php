@extends('master')

@section('contenedor')
{!!Html::style('css/select.css')!!}

<div class="row" ng-app="perfil">
    <div class="col-md-12" ng-controller="informacionPerfil">
        <div class="col-md-12 pad">
            <i class="fa fa-home"></i>
            <a href="/" style="color: black;">Home</a>
            <i class="fa fa-angle-right"></i>
            <a href="javascript:;" style="color: black;">Perfil de usuario</a>
        </div>
        <h3 class="text-center pad"><i class="fa fa-user" style="font-size: 30px;"></i> Perfil de usuario</h3>

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


        <div class="col-md-12 text-center pad">
            <button ng-click="editarPerfil()" class="btn btn-success"><i class="fa fa-save"></i> Guardar Cambios</button>
            <button ng-click="editarPerfil()" class="btn btn-danger" onclick="window.location = '/'"><i class="fa fa-trash-o"></i> Cancelar</button>
        </div>

    </div>
</div>


@stop


@section('js')
{!!Html::script('js/dependencias/select.js')!!}
{!!Html::script('js/perfil/perfil.js')!!}

@stop
