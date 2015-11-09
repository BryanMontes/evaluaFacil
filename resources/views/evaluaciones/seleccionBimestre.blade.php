@extends('master')

@section('contenedor')

{!!Html::style('css/select.css')!!}
{!!Html::style('css/seleccionBimestre.css')!!}
<div class="row pad">
    <div class="col-md-12 col-xs-12">
        <label class="col-md-12 col-xs-12">Seleccione un grupo</label>
        <select class="selectpicker col-md-5 col-xs-5" style="display: none;" data-style="btn-default" title="Bimestre">
            <option value="1">Bimestre 1</option>
            <option value="2">Bimestre 2</option>
            <option value="3">Bimestre 3</option>
            <option value="4">Bimestre 4</option>
        </select>
    </div>
    <div class="col-md-12 col-xs-12">
        <label class="col-md-12 col-xs-12">Seleccione una materia</label>
        <select class="selectpicker col-md-5 col-xs-5" style="display: none;" data-style="btn-default" title="Bimestre">
            <option value="1">Español</option>
            <option value="2">Matematícas</option>
            <option value="3">Física</option>
            <option value="4">Arte</option>
        </select>
    </div>
    
</div>
@stop


@section('js')
{!!Html::script('js/dependencias/select.js')!!}
{!!Html::script('js/dependencias/Chart.js')!!}
{!!Html::script('js/evaluaciones/seleccionBimestre.js')!!}

@stop