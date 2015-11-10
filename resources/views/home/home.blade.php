@extends('master')

@section('contenedor')
@if(Session::get('tipoUsuario') == "teacher")
<div class="row">
    <h1 class="text-center pad">Bienvenido {{Session::get('usuario')}}!</h1>
    <h3 class="text-center pad"></h3>
</div>
@else
<div class="row">
    <h1 class="text-center pad">Bienvenido Maestro!</h1>
    <h3 class="text-center pad">Para empezar a evaluar por favor inicia sesión</h3>
</div>
@endif

@stop


@section('js')
{!!Html::script('js/home/home.js')!!}
@stop