<?php

namespace App\Http\Controllers\Grupos;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class GruposController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        if (Session::get('tipoUsuario') == "director") {

            // Si tenemos sesión activa de tipo director, mostrará la página de inicio del maestro
            return view('grupos.listado');
        }
        // Si no hay sesión activa mostramos la pagina principal
        return view('home.home');
    }

}
