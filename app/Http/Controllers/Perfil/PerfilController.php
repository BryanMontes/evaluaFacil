<?php

namespace App\Http\Controllers\Perfil;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class PerfilController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        if (Session::get('usuario')) {

            // Si tenemos sesión activa, mostrará la página de inicio del maestro
            return view('perfil.perfil');
        }
        // Si no hay sesión activa mostramos la pagina principal
        return view('home.home');
    }

    public function algo(Request $request) {
        //
    }

}
