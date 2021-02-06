<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /**
         * Asi como podiamos agregar middlewares en las rutas, 
         * al especificarlo en el constructor de cualquier controlador
         * lo que estamos diciendo es que para entrar a cualquier de los métodos
         * de dicho controlador, primero tiene que pasar por el middleware
         * especificado. En este caso significa que no se pueden mirar posts,
         * editar el perfil, o mirar la home si no se está autenticado
         *
         * Mas información sobre esto: 
         * https://laravel.com/docs/5.3/controllers#controller-middleware
         */
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**
         * Muestra la pagina inicial que ve un usuario cuando se loguea
         * Por defecto muestra la vista home, pero yo la moví adentro de la
         * carpeta panel por lo que el nuevo path es panel.home
         */
        return view('panel.home');
    }	
}

