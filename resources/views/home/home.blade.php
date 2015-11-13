@extends('master')

@section('contenedor')
@if(Session::get('tipoUsuario') == "teacher")
<div class="row text-center">
    <h1 class="text-center pad">Bienvenido {{Session::get('usuario')}}!</h1>
    <h3 class="text-center pad"></h3>
    <i class="pad fa fa-mortar-board" style="font-size: 150px; margin-top: 10%;"></i>
</div>
@else
<div class="row text-center">
    <h1 class="text-center pad">Bienvenido Maestro!</h1>
    <h3 class="text-center pad">Para empezar a evaluar por favor inicia sesión</h3>
    <i class="pad fa fa-mortar-board" style="font-size: 150px; margin-top: 10%;"></i>
</div>
@endif

@stop


@section('js')
{!!Html::script('js/home/home.js')!!}
@stop