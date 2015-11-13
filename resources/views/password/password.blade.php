@extends('master')

@section('contenedor')
{!!Html::style('css/select.css')!!}

<div class="row" ng-app="password">
    <div class="col-md-12" ng-controller="cambiarPassword">
        <div class="col-md-12 pad">
            <i class="fa fa-home"></i>
            <a href="/" style="color: black;">Home</a>
            <i class="fa fa-angle-right"></i>
            <a href="javascript:;" style="color: black;">Cambiar contraseña</a>
        </div>
        <h3 class="text-center pad"><i class="fa fa-exchange" style="font-size: 30px;"></i> Cambiar contraseña</h3>
        <div class="col-md-6 form-group input-group center-block pad">
            <label>Contraseña Anterior</label>
            <input type="password" placeholder="Contraseña Anterior*" class="form-control ng-pristine ng-valid ng-touched" ng-model="password.anterior">
        </div>

        <div class="col-md-6 form-group input-group center-block pad">
            <div>
                <label>Nueva Contraseña</label>
                <input type="password" placeholder="Nueva Contraseña*" class="form-control ng-pristine ng-valid ng-touched" ng-model="password.nueva">
            </div>
            <div>
                <label>Repite tu nueva contraseña</label>
                <input type="password" placeholder="Repite tu nueva contraseña*" class="form-control ng-pristine ng-valid ng-touched" ng-model="password.repetirPassword">
            </div>
            <p sttyle="font-size: 12px" class="help-block text-left">Una contraseña segura debe contener minimo 8 caracteres, al menos una mayuscula, un numero y un simbolo.</p>
        </div>
        <div class="col-md-6 form-group input-group center-block">
            <button ng-click="cambiarPass()" class="btn btn-primary"><i class="fa fa-exchange"></i> Cambiar contraseña</button>
        </div>

    </div>
</div>


@stop


@section('js')
{!!Html::script('js/dependencias/select.js')!!}
{!!Html::script('js/password/password.js')!!}

@stop
