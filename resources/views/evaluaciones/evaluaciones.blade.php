@extends('master')

@section('contenedor')

{!!Html::style('css/select.css')!!}
{!!Html::style('css/evaluaciones.css')!!}
<div class="row">
    <div class="col-md-12 pad">
        <label class="col-md-12 bold">Seleccione el bimestre deseado</label>
    </div>
    <div class="col-md-12">
        
    </div>
</div>

@stop


@section('js')
{!!Html::script('js/dependencias/select.js')!!}
{!!Html::script('js/dependencias/Chart.js')!!}
{!!Html::script('js/evaluaciones/evaluaciones.js')!!}

@stop