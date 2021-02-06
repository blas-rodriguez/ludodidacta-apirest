<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    /**
     * NOTA
     * 
     * La logica de estos controladores está escondida dentro de los traits
     * que utilizan cada uno. En este caso la lógica para el registro está dentro
     * del trait RegisterUsers, el cual no podemos modificar porque está en
     * la carpeta vendor!!
     *
     * Los métodos más importantes que aporta ese trait son showRegistrationForm
     * y register, los cuales son utilizados al usar Auth::routes() en el archivo
     * de rutas 
     *
     * https://laravel.com/docs/5.3/authentication
     */
    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /**
         * De forma similar a la que agregabamos uno o varios middlewares
         * a nuestras rutas mediante los archivos de rutas (api.php, web.php),
         * en cualquier de nuestros controllers, podemos especificar middlewares
         * para cada uno de los métodos del controlador en el que estamos parados
         * o para alguno de todos ellos.
         *
         * Podemos aprender sobre como hacer esto aca:
         * https://laravel.com/docs/5.3/controllers#controller-middleware
         *
         * Aconsejo de todas formas que configuremos nuestros middlewares en los
         * archivos de rutas, o en Kernel.php si es un middleware que tiene que
         * utilizarse para todas las rutas. En este caso este middleware viene por
         * defecto.
         *
         ******************************************************************
         * ----------------------------------------------------------------
         *
         *               ¿Para que sirve el middleware guest?
         * 
         * ----------------------------------------------------------------
         ******************************************************************
         *
         * Asi como el middleware auth no nos permitia entrar a una ruta a menos
         * que estemos logueados, el middleware guest, no nos deja entrar a una
         * ruta si estamos logueados, y nos redirige por defecto a /home si
         * estamos autenticados. Esto sirve por ejemplo cuando alguien intenta 
         * entrar a /login o /register cuando ya está logueado, en lugar de 
         * mostrarle el formulario para que se vuelvan a loguear los manda directo 
         * a casa (/home).
         *
         * Podemos ver en App/Http/Kernel.php, que el middleware guest está
         * disponible para ser usado en cualquier ruta que lo necesitemos y ademas
         * nos dice que está en App/Http/Middleware/RedirectIfAuthenticaded.php,
         * o sea que es parte de nuestro proyecto y si queremos podemos editarlo!! 
         * Por ejemplo si en lugar de que querramos que nos mande a /home
         * quisieramos que mande al usuario a una ruta distinta.
         *
         */
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            /**
             * Agrego las reglas de validacion para el apellido
             * ya que es un campo que agregué manualmente en mi
             * tabla de usuarios.
             *
             * Si tuviera cualquier otro campo custom en el formulario
             * de registro también tendria que agregarlo aca
             */
            'lastname'  => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        /**
         * Asi como antes recogiamos la data enviada desde el formulario
         * a traves del objeto Request, haciendo $request->atributo, en este 
         * método nos llega toda la información enviada en el formulario de registro
         * en el array $data, por lo que para leer un atributo debo hacer:
         *
         * $data['nombre_atributo']
         */
        return User::create([
            'name' => $data['name'],

            /**
             * Si no agrego manualmente este campo, al intentar crearse un nuevo
             * usuario se va a intentar guardar sin el apellido. Cualquier otro
             * campo que quiera setear en un usuario apenas se registra tengo que
             * especificarlo acá
             */
            'lastname'  => $data['lastname'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
