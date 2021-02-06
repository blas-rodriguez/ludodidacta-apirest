<?php

/**
 * Mini ejemplo de como utilizar la autenticación en Laravel 5.3 para
 * el turno tarde del curso Full Stack de Digital House (Noviembre 2016)
 *
 * El sistema también incluye un mini api para que nuestro sistema pueda
 * ser consumido externamente (por ejemplo por una aplicación mobile)
 * 
 * @author Sebastián A. Rinaldi <sebastian.agustin.rinaldi@gmail.com>
 */

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
  error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}
Route::get('/', 'PublicController@index');
Route::get('/ayuda', 'PublicController@showHelp')->name('help');

/**
 * Agrupo todas las rutas a las que no se puede acceder sin estar logueado para
 * no tener que especificarles el middleware 
 *
 * También le digo que el nombre de todos las rutas contenidas va a empezar
 * con panel::, entonces para generar el link de las rutas lo haria de la
 * siguiente forma
 *
 * route('panel::posts.index'), route('panel::profile.index')
 *
 * https://laravel.com/docs/5.1/routing#named-routes
 *
 */
Route::group(['middleware'=>'auth', 'as' => 'panel::'], function() {
  /**
   * Notar que en estas rutas ya no uso el user_id como uno de los parametros
   * ya que obtengo el usuario a traves de Auth::user().
   *
   * Siguiendo los principios rest las rutas deberian ser
   * user/{id}/posts y user/{id}/profile, sin embargo no los estamos siguiendo
   * intencionalmente ya que estas rutas tienen que ser lo más user-friendly
   * posible. En un CMS (sistema de gestión de contenido) si está bueno y es
   * importante que las sigamos al pie de la letra al igual que un API.
   *
   * Para crear un controlador dentro de una carpeta y que me setee el namespace
   * del controlador correcta y automaticamente se hace de la siguiente forma:
   *
   * php artisan make:controller Panel/NombreControlador
   *
   * Notar que lo pone adentro de la carpeta Panel, y que el namespace
   * de la clase generada lo prefija con Panel\...
   */

  /**
   * Rutas para los posts
   */
  Route::get('posts', 'Panel\PostsController@index')->name('posts.index');

  /**
   * Rutas para el perfil del usuario
   */
  Route::get('perfil', 'Panel\ProfileController@edit')->name('profile.edit');
  Route::post('perfil', 'Panel\ProfileController@update')->name('profile.update');
});


/**
 * Por defecto cuando creamos un nuevo proyecto de larave, aunque no ejecutemos
 * php artisan make:auth tenemos en la app/Http/Controllers/Auth los controladores
 * necesarios tanto para el registro, el login y la recuperación de contraseña.
 *
 * Para poder aprovechar toda esa lógica y no tener que codearla desde cero debemos
 * definir las rutas que utilicen los métodos de dichos controllers.
 *
 * Bien podemos tener un conocimiento exhaustivo de esos controladores, o podemos
 * simplemente poner Auth::routes() y genera todas las rutas apuntando a los métodos
 * que corresponden de cada uno de los controladores automaticamente!!
 *
 * Solamente nos serviria hacerlo a mano en caso de que quisieramos de que
 * quisieramos modificar los paths de dichas rutas. Por ejemplo si quisieramos 
 * que al registro se entre desde /nueva-cuenta pondriamos lo siguiente
 *
 * Route::get('nueva-cuenta', 'Auth/LoginController@showLoginForm')
 * Para ver las rutas que nos agrega Auth::routes() en consola debemos poner
 * php artisan route:list
 *
 * ------------------------------------------
 *
 * Para poder utilizar la recuperación de contraseña acordate que tenés
 * que configurar las credenciales de tu cuenta de gmail (u otro servicio) 
 * en el .env!
 */
Auth::routes();

Route::get('/home', 'HomeController@index');
