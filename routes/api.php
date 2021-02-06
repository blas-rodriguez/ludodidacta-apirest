<?php
/**
 * Mini ejemplo de como crear un API en Laravel 5.3 en nuestro sistema para 
 * el turno tarde del curso Full Stack de Digital House (Noviembre 2016)
 * 
 * @author Sebastián A. Rinaldi <sebastian.agustin.rinaldi@gmail.com>
 */

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * Ruta que viene de ejemplo en laravel y muestra toda la información de un usuario. 
 * Se utiliza de la siguiente forma
 * GET http://localhost:8000/api/user?api_token={ingrese aqui api_token de cualquier usuario}
 */
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

/**
 * Agrupo las rutas con una versión (Uso: http://localhost:8000/api/v1/...) 
 * ya que en general tiende a haber diferentes versiones de un api en un mismo sistema,
 * las cuales, en muchos casos no se pueden deprecar (o son
 * dificiles y lleva tiempo hacerlo) ya que hay otros sistemas consumiendolas
 */
Route::group(['prefix'=>'v1'], function() {
	//Obtención de los posts de todos los usuarios
	Route::get('posts', 'Api\PostsController@index');
	Route::get('users', 'Api\UserPostsController@allUsers');
	Route::get('users/{id}/points', 'Api\UserPostsController@addPoints');
	Route::get('teams', 'Api\TeamsController@index');
	Route::get('teams/{id}/points', 'Api\TeamsController@addPoints');

	//Muestra la información de un post específico
	Route::get('posts/{id}', 'Api\PostsController@show');

	//Obtención de posts de un usuario especifico
	Route::get('users/{id}/posts', 'Api\UserPostsController@index');

	//Login de usuarios, a esta ruta debemos suministrarle el email y la password de un usuario
	Route::post('login', 'Api\Auth\LoginController@login');

	/**
	 * Creación de posts de un usuario específico, debe suministrarsele el api_token
	 * de un usuario para poder utilizar esta ruta
	 *
	 * EJERCICIO: Solo permitir que el usuario autenticado pueda crearse un POST!
	 * Si lo dejamos asi cualquier usuario logueaod puede crearle un post a cualquier otro
	 */
	Route::post('users/{id}/posts', 'Api\UserPostsController@store')->middleware('auth:api');
});