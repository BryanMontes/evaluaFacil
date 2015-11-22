<?php

namespace App\Http\Controllers\Evaluaciones;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class EvaluarAlumnoController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        if (Session::get('tipoUsuario') == "director" || Session::get('tipoUsuario') == "teacher") {

            // Si tenemos sesión activa, mostrará la página de inicio del maestro
            return view('evaluaciones.evaluarAlumno');
        }
        // Si no hay sesión activa mostramos la pagina principal
        return view('home.home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function traerEvaluaciones(Request $request) {
        
    }

}
