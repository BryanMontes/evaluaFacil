<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */
/*Inicio de sesión home*/
Route::get('/', ['as' => 'home', 'uses' => 'Home\HomeController@index']);
Route::post('login', ['as' => 'login', 'uses' => 'Home\HomeController@login']);
Route::get('logOut', ['as' => 'logOut', 'uses' => 'Home\HomeController@logOut']);

/*Reportes*/
Route::get('/reportes', ['as' => 'reportes', 'uses' => 'Reportes\ReportesController@index']);

/*Consolidado*/
Route::get('/consolidado', ['as' => 'consolidado', 'uses' => 'Consolidado\ConsolidadoController@index']);

/*Perfil*/
Route::get('/perfil', ['as' => 'perfil', 'uses' => 'Perfil\PerfilController@index']);

/*Cambiar contraseña*/
Route::get('/cambiarPassword', ['as' => 'cambiarPassword', 'uses' => 'Password\PasswordController@index']);
Route::get('/cambioPass', ['as' => 'cambioPass', 'uses' => 'Password\PasswordController@cambioPass']);

/*Evaluaciones*/
Route::get('/evaluaciones', ['as' => 'evaluaciones', 'uses' => 'Evaluaciones\EvaluacionesController@index']);
Route::get('/evaluaralumno/{id}/{idGrupo}', ['as' => 'evaluaralumno', 'uses' => 'Evaluaciones\EvaluarAlumnoController@index']);

/*Docentes*/
Route::get('/docentes', ['as' => 'docentes', 'uses' => 'Docentes\DocentesController@index']);
Route::get('/asignaciones/{id}', ['as' => 'asignaciones', 'uses' => 'Docentes\AsignacionesController@index']);

/*Alumnos*/
Route::get('/listadoGrupos', ['as' => 'listadoGrupos', 'uses' => 'Alumnos\ListadoGruposController@index']);
Route::get('/alumnos/{id}', ['as' => 'alumnos', 'uses' => 'Alumnos\AlumnosController@index']);

/*Grupos*/
Route::get('/mis_grupos', ['as' => 'mis_grupos', 'uses' => 'Grupos\GruposController@index']);

/*Administracion*/
Route::get('/administracion', ['as' => 'administracion', 'uses' => 'Administracion\AdministracionController@index']);
Route::get('/materias', ['as' => 'materias', 'uses' => 'Administracion\MateriasController@index']);





