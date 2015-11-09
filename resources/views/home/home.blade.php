@extends('master')

@section('contenedor')
<div class="row">
    <h1 class="text-center pad">Bienvenido Maestro!</h1>
    <h3 class="text-center pad">Para empezar a evaluar por favor inicia sesión</h3>
</div>


@stop


@section('js')
{!!Html::script('js/home/home.js')!!}
@stop