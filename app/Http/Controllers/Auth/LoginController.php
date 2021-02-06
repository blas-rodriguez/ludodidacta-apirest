<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    /**
     * NOTA
     * 
     * La logica de estos controladores está escondida dentro de los traits
     * que utilizan cada uno. En este caso la lógica para el logueo está dentro
     * del trait AuthenticateUsers, el cual no podemos modificar porque está en
     * la carpeta vendor!!
     *
     * Los métodos más importantes que aporta ese trait son showLoginForm y login
     * los cuales son utilizados al usar Auth::routes() en el archivo de rutas 
     */
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * NOTA
     *
     * Si quisieramos que en lugar de autenticarse con email y contraseña,
     * el usuario tuviera que utilizar DNI y contraseña, deberiamos agregar un
     * método en este controlador llamado username, que devuelva la cadena 'dni',
     * y en la tabla users deberiamos tener el campo dni
     *
     * public function username() { return 'dni'; }
     *
     * https://laravel.com/docs/5.3/authentication
     */
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }
}
