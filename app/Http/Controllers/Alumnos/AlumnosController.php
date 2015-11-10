<?php

namespace App\Http\Controllers\Alumnos;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class AlumnosController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        if (Session::get('tipoUsuario') == "director") {

            // Si tenemos sesión activa de tipo director, mostrará la página de inicio del maestro
            return view('alumnos.listadoAlumnos');
        }
        // Si no hay sesión activa mostramos la pagina principal
        return view('home.home');
    }

}
