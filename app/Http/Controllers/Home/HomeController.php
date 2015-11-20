<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        if (Session::get('usuario')) {

            // Si tenemos sesión activa, mostrará la página de inicio del maestro
            return view('reportes.reportes');
        }
        // Si no hay sesión activa mostramos la pagina principal
        return view('home.home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function login(Request $request) {
        if ($request->usuario != "" && $request->access_token != "" && $request->refresh_token != "" && $request->tipoUsuario != "") {
            Session::flush();
            Session::put('usuario', $request->usuario);
            Session::put('tipoUsuario', $request->tipoUsuario);
            Session::put('access_token', $request->access_token);
            Session::put('refresh_token', $request->refresh_token);
            return json_encode(array("status" => TRUE));
        } else {
            return view('home.home');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function logOutSesionUsuario() {
        Session::flush();
        return json_encode(array("status" => true));
    }

}
