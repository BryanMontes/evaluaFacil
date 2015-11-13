@extends('master')

@section('contenedor')

{!!Html::style('css/select.css')!!}


<div class="row">
    <div class="col-md-4 pad">
        <i class="fa fa-home"></i>
        <a href="/" style="color: black;">Home</a>
        <i class="fa fa-angle-right"></i>
        <a href="javascript:;" style="color: black;">Consolidado</a>
    </div>
    <h3 class="text-center pad col-md-12">Consolidado</h3>
    <div class="col-md-12 col-xs-12 caja_blanca contorno margen_arriba">
        <div class="col-md-6 text-center">
            <h3 class="bold">Participación en clase</h3>

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Concepto</th>
                        <th>Col 1</th>
                        <th>Col 2</th>
                        <th>Col 3</th>
                        <th>Col 4</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>2 da Sesión</td>
                        <td>3</td>
                        <td>4</td>
                        <td>2</td>
                        <td>3</td>
                    </tr>
                    <tr>
                        <td>4 ta Sesión</td>
                        <td>3</td>
                        <td>4</td>
                        <td>2</td>
                        <td>3</td>
                    </tr>
                    <tr>
                        <td>6 ta Sesión</td>
                        <td>3</td>
                        <td>4</td>
                        <td>2</td>
                        <td>3</td>
                    </tr>
                </tbody>
            </table>        </div>
        <div class="col-md-6">
            <canvas id="participacion" height="200" width="500"></canvas>
        </div>
    </div>

    <div class="col-md-12 col-xs-12 caja_blanca contorno margen_arriba">
        <div class="col-md-6 text-center">
            <h3 class="bold">Niveles de desempeño alcanzados</h3>

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Concepto</th>
                        <th>Col 1</th>
                        <th>Col 2</th>
                        <th>Col 3</th>
                        <th>Col 4</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>2 da Sesión</td>
                        <td>3</td>
                        <td>4</td>
                        <td>2</td>
                        <td>3</td>
                    </tr>
                    <tr>
                        <td>4 ta Sesión</td>
                        <td>3</td>
                        <td>4</td>
                        <td>2</td>
                        <td>3</td>
                    </tr>
                    <tr>
                        <td>6 ta Sesión</td>
                        <td>3</td>
                        <td>4</td>
                        <td>2</td>
                        <td>3</td>
                    </tr>
                </tbody>
            </table>        </div>
        <div class="col-md-6">
            <canvas id="desempeno" height="200" width="500"></canvas>
        </div>
    </div>

    <div class="col-md-12 col-xs-12 caja_blanca contorno margen_arriba">
        <div class="col-md-6 text-center">
            <h3 class="bold">Asistencia</h3>

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Concepto</th>
                        <th>Col 1</th>
                        <th>Col 2</th>
                        <th>Col 3</th>
                        <th>Col 4</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>2 da Sesión</td>
                        <td>3</td>
                        <td>4</td>
                        <td>2</td>
                        <td>3</td>
                    </tr>
                    <tr>
                        <td>4 ta Sesión</td>
                        <td>3</td>
                        <td>4</td>
                        <td>2</td>
                        <td>3</td>
                    </tr>
                    <tr>
                        <td>6 ta Sesión</td>
                        <td>3</td>
                        <td>4</td>
                        <td>2</td>
                        <td>3</td>
                    </tr>
                </tbody>
            </table>        </div>
        <div class="col-md-6">
            <canvas id="asistencia" height="200" width="500"></canvas>
        </div>
    </div>

    <div class="col-md-12 col-xs-12 caja_blanca contorno margen_arriba">
        <div class="col-md-6 text-center">
            <h3 class="bold">Evaluación de comprensión lectora</h3>

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Concepto</th>
                        <th>Col 1</th>
                        <th>Col 2</th>
                        <th>Col 3</th>
                        <th>Col 4</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>2 da Sesión</td>
                        <td>3</td>
                        <td>4</td>
                        <td>2</td>
                        <td>3</td>
                    </tr>
                    <tr>
                        <td>4 ta Sesión</td>
                        <td>3</td>
                        <td>4</td>
                        <td>2</td>
                        <td>3</td>
                    </tr>
                    <tr>
                        <td>6 ta Sesión</td>
                        <td>3</td>
                        <td>4</td>
                        <td>2</td>
                        <td>3</td>
                    </tr>
                </tbody>
            </table>        </div>
        <div class="col-md-6">
            <canvas id="lectora" height="200" width="500"></canvas>
        </div>
    </div>

    <div class="col-md-12 col-xs-12 caja_blanca contorno margen_arriba">
        <div class="col-md-6 text-center">
            <h3 class="bold">Competencia matemática</h3>

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Concepto</th>
                        <th>Col 1</th>
                        <th>Col 2</th>
                        <th>Col 3</th>
                        <th>Col 4</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>2 da Sesión</td>
                        <td>3</td>
                        <td>4</td>
                        <td>2</td>
                        <td>3</td>
                    </tr>
                    <tr>
                        <td>4 ta Sesión</td>
                        <td>3</td>
                        <td>4</td>
                        <td>2</td>
                        <td>3</td>
                    </tr>
                    <tr>
                        <td>6 ta Sesión</td>
                        <td>3</td>
                        <td>4</td>
                        <td>2</td>
                        <td>3</td>
                    </tr>
                </tbody>
            </table>        </div>
        <div class="col-md-6">
            <canvas id="matematica" height="200" width="500"></canvas>
        </div>
    </div>

    <div class="col-md-12 col-xs-12 caja_blanca contorno margen_arriba margen_abajo">
        <div class="col-md-6 text-center">
            <h3 class="bold">Convivencia escolar</h3>

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Concepto</th>
                        <th>Col 1</th>
                        <th>Col 2</th>
                        <th>Col 3</th>
                        <th>Col 4</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>2 da Sesión</td>
                        <td>3</td>
                        <td>4</td>
                        <td>2</td>
                        <td>3</td>
                    </tr>
                    <tr>
                        <td>4 ta Sesión</td>
                        <td>3</td>
                        <td>4</td>
                        <td>2</td>
                        <td>3</td>
                    </tr>
                    <tr>
                        <td>6 ta Sesión</td>
                        <td>3</td>
                        <td>4</td>
                        <td>2</td>
                        <td>3</td>
                    </tr>
                </tbody>
            </table>        </div>
        <div class="col-md-6">
            <canvas id="convivencia" height="200" width="500"></canvas>
        </div>
    </div>

</div>




@stop


@section('js')
{!!Html::script('js/dependencias/select.js')!!}
{!!Html::script('js/dependencias/Chart.js')!!}
{!!Html::script('js/consolidado/consolidado.js')!!}

@stop