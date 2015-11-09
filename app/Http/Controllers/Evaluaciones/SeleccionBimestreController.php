<?php

namespace App\Http\Controllers\Evaluaciones;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SeleccionBimestreController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        if (Session::get('usuario')) {

            // Si tenemos sesión activa, mostrará la página de inicio del maestro
            return view('evaluaciones.seleccionBimestre');
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
