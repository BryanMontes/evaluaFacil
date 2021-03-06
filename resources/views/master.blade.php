<!DOCTYPE html>
<html lang="en">
    <!-- Head BEGIN -->
    <head>
        <meta charset="utf-8">
        <title>Evalúa Fácil | CET III</title>
        <!--Escalado para moviles-->
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <!--Escalado para moviles-->

        <!-- Fonts START -->
        {!!Html::style('css/fonts.css')!!}
        <!-- Fonts END -->

        <!-- Global styles START -->
        {!!Html::style('librerias/font-awesome/css/font-awesome.min.css')!!}
        {!!Html::style('librerias/bootstrap/css/bootstrap.min.css')!!}
        {!!Html::style('css/bootsnipp.min.css')!!}
        {!!Html::style('librerias/css/components.css')!!}
        {!!Html::style('librerias/layout/css/style.css')!!}
        {!!Html::style('librerias/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')!!}
        {!!Html::style('librerias/layout/css/custom.css')!!}
        {!!Html::style('css/sweetalert.css')!!}

        @yield('css')

        <!--BEGIN Nuestros estilos -->
        {!!Html::style('css/master.css')!!}
        <!--END Nuestros estilos -->

    </head>
    <body style="background-color:#FFF;">

        <div class="pre-header gris">
            <div class="container" style="width: 95% !important; ">
                <div class="row">
                    <!-- BEGIN TOP BAR LEFT PART -->
                    <div class="col-md-3 col-sm-3 additional-shop-info text-right">

                        <ul class="list-unstyled list-inline text-left">
<!--                            <a href="/"><img src="{!!asset('images/logo.png')!!}" style="width: 200px; height: 80px;"></a>-->
                            <a href="/"><h1 class="bold">EvalúaFácil</h1></a>
                        </ul>

                    </div>
                    <!-- END TOP BAR LEFT PART -->
                    <!-- BEGIN TOP BAR MENU -->
                    <div class="col-md-7 col-xs-7 additional-shop-info">

                        @if(Session::get('tipoUsuario') == "teacher" || Session::get('tipoUsuario') == "director")
                        <ul class="nav navbar-nav ">
                            <li class="classic-menu-dropdown no_pad">
                                <a data-close-others="true" data-hover="megamenu-dropdown" href="javascript:;" data-toggle="dropdown" class="hover-initialized bold">
                                    Reportes <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu pull-left">
                                    <li>
                                        <a href="/consolidado">
                                            <i class="fa fa-copy"></i> Consolidado de reportes </a>
                                    </li>
                                    <li>
                                        <a href="/reportes">
                                            <i class="fa fa-file-text"></i> Reportes General </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav">
                            <li class="classic-menu-dropdown no_pad">
                                <a data-close-others="true" data-hover="megamenu-dropdown" href="javascript:;" data-toggle="dropdown" class="hover-initialized bold">
                                    Indicadores E.<i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu pull-left">
                                    <li>
                                        <a href="/evaluaciones">
                                            <i class="fa fa-legal"></i> Evaluaciones </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        @endif
                        @if(Session::get('tipoUsuario') == "director")
                        <ul class="nav navbar-nav">
                            <li class="classic-menu-dropdown no_pad">
                                <a data-close-others="true" data-hover="megamenu-dropdown" href="javascript:;" data-toggle="dropdown" class="hover-initialized bold">
                                    Docentes<i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu pull-left">
                                    <li>
                                        <a href="/docentes">
                                            <i class="fa fa-folder-open"></i> Listado </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav">
                            <li class="classic-menu-dropdown no_pad">
                                <a data-close-others="true" data-hover="megamenu-dropdown" href="javascript:;" data-toggle="dropdown" class="hover-initialized bold">
                                    Grupos<i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu pull-left">
                                    <li>
                                        <a href="/mis_grupos">
                                            <i class="fa fa-group"></i> Mis Grupos </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav">
                            <li class="classic-menu-dropdown no_pad">
                                <a data-close-others="true" data-hover="megamenu-dropdown" href="javascript:;" data-toggle="dropdown" class="hover-initialized bold">
                                    Administración<i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu pull-left">
                                    <li>
                                        <a href="/administracion">
                                            <i class="fa fa-bookmark-o"></i> Fechas Indicadores </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav">
                            <li class="classic-menu-dropdown no_pad">
                                <a data-close-others="true" data-hover="megamenu-dropdown" href="javascript:;" data-toggle="dropdown" class="hover-initialized bold">
                                    Alumnos<i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu pull-left">
                                    <li>
                                        <a href="/listadoGrupos">
                                            <i class="fa fa-mortar-board"></i> Listado </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        @endif


                    </div>
                    @if(!Session::get('usuario'))
                    <div class="col-md-2 col-xs-2 additional-shop-info text-center" id="loginRegister">
                        <div ng-controller="iniciarSesion" id="login">
                            <div class="col-md-12">
                                <h4 ng-click="iniciarS()" style="cursor: pointer; line-height: 34px;color:black;" id="Ingresar"><i class="fa fa-key"></i> Ingresar</h4>
                            </div>



                            <!--modal-->
                            <script type="text/ng-template" id="inicioSesion">
                                <div class="modal-header">
                                <h3 class="modal-title col-md-11 col-xs-11 bold"><i class="fa fa-unlock" style="font-size:30px;"></i> Iniciar Sesión</h3>
                                <div class="glyphicon glyphicon-remove" ng-click="ok()" style="cursor:pointer;"></div>
                                </div>

                                <div class="col-md-6 col-md-offset-3 col-xs-6 col-xs-offset-3 form-group input-group" style="margin-top:2%;">
                                <input type="text" name="usuario" ng-model="sesion.usuario" id="usuario" class="form-control" placeholder="Usuario">
                                </div>


                                <div class="col-md-6 col-md-offset-3 col-xs-6 col-xs-offset-3 form-group input-group ng-scope form-group input-group">
                                <input name="password" ng-model="sesion.password" id="password" class="form-control" placeholder="Contraseña" type="password">


                                </div>

                                </div>
                                <div class="modal-footer">

                                <button class="btn btn-primary center-block bold" ng-click="ingresar()" ><i class="fa fa-key "></i> INGRESAR</button>
                                <ul ng-show="erroresIniciarS.length > 0" class="alert alert-danger text-center" style="margin-top: 10px;" ng-cloak>
                                <li ng-repeat="error in erroresIniciarS">@{{error.tipoError}}</li>
                                </ul>
                                </div>
                            </script>
                            <!-- End modal-->


                        </div>
                    </div>

                    @else
                    <div class="col-md-2 col-sm-2 additional-shop-info text-center no_pad" id="loginRegister2" style="font-size: 21px">
                        <ul class="nav navbar-nav pull-right" ng-controller="iniciarSesion">
                            <li class="dropdown dropdown-user">
                                <a data-close-others="true" data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle" href="javascript:;">
                                    <div style="display: none;" id="sessionID">{{Session::get('access_token')}}</div>
                                    <span class="username username-hide-on-mobile">{{Session::get('usuario')}} </span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-default">
                                    <li>
                                        <a href="/perfil">
                                            <i class="fa fa-user"></i> Mi Perfil
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/cambiarPassword">
                                            <i class="fa fa-exchange"></i> Cambiar mi contraseña
                                        </a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="javascript:;" ng-click="salir()"><i class="fa fa-sign-out"></i> Salir de la sesión</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                    @endif
                    <!-- END TOP BAR MENU -->
                </div>

            </div>

            <hr style="margin: 0px;">  
        </div>
        <article style="margin-bottom: 7%;">
            <div class="container">
                <div class="content">
                    @yield('contenedor')
                </div>
            </div>
        </article>
        <footer>            
            <div class="footer text-center segundo-pie">
                <div class="container">
                    <div class="row">
                        <!-- BEGIN COPYRIGHT -->
                        <div class="col-md-12 col-sm-12">
                            <!--<a href="/">Aviso de Privacidad</a> |-->
                            ® Derechos reservados a CET III
                        </div>
                        <!-- END COPYRIGHT -->
                    </div>
                </div>
            </div>
            <!-- END FOOTER -->
        </footer>

        <!--{!!Html::script('js/dependencias/jquery-2.1.4.js')!!}-->
        {!!Html::script('js/dependencias/sweetalert-dev.js')!!}
        {!!Html::script('librerias/jquery.min.js')!!}
        {!!Html::script('librerias/jquery-migrate.min.js')!!}
        {!!Html::script('librerias/bootstrap/js/bootstrap.min.js')!!}
        <!-- END CORE PLUGINS -->

        <!-- BEGIN PAGE LEVEL PLUGINS -->
        {!!Html::script('librerias/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js')!!}
        {!!Html::script('librerias/assets/global/plugins/jquery-validation/js/jquery.validate.min.js')!!}
        {!!Html::script('librerias/assets/global/plugins/jquery-validation/js/additional-methods.min.js')!!}
        {!!Html::script('librerias/assets/global/plugins/select2/select2.min.js')!!}
        {!!Html::script('librerias/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')!!}
        {!!Html::script('librerias/assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js')!!}
        {!!Html::script('librerias/assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js')!!}
        {!!Html::script('librerias/assets/global/plugins/ckeditor/ckeditor.js')!!}
        {!!Html::script('librerias/assets/global/plugins/bootstrap-markdown/js/bootstrap-markdown.js')!!}
        {!!Html::script('librerias/assets/global/plugins/bootstrap-markdown/lib/markdown.js')!!}



        {!!Html::script('librerias/assets/global/scripts/metronic.js')!!}
        {!!Html::script('librerias/assets/admin/layout/scripts/layout.js')!!}
        {!!Html::script('librerias/assets/admin/layout/scripts/quick-sidebar.js')!!}
        {!!Html::script('librerias/assets/admin/layout/scripts/demo.js')!!}
        {!!Html::script('librerias/assets/admin/pages/scripts/form-validation.js')!!}
        {!!Html::script('librerias/assets/admin/pages/scripts/ui-blockui.js')!!}




        <!-- END PAGE LEVEL STYLES -->
        {!!Html::script('js/dependencias/lodash.js')!!}
        {!!Html::script('js/dependencias/angular.min.js')!!}
        {!!Html::script('js/dependencias/animate.js')!!}
        {!!Html::script('js/dependencias/angular-local-storage.min.js')!!}
        {!!Html::script('js/dependencias/ui-bootstrap-tpls-0.13.4.js')!!}
        {!!Html::script('js/services/servicios.js')!!}
        {!!Html::script('js/login/login.js')!!}

        <script>
            angular.bootstrap(document.getElementById("loginRegister"), ["loginRegister"]);
            angular.bootstrap(document.getElementById("loginRegister2"), ["loginRegister"]);
        </script>
        @yield('js')
    </body>
</html>
