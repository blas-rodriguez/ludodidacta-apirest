<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\BaseController as ApiController;

use App\User, App\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Extiendo de un controlador base para el api de forma tal
 * de tener centralizado el formato de la misma en un solo lugar,
 * ya sea para devolver respuestas de exito, de error...
 */
class UserPostsController extends ApiController
{
	/**
	 * Lista los posts de un usuario específico
	 *
	 * Ejercicio: paginarlos!
	 */
	public function index($id) {
		try 
		{
			$user = User::findOrFail($id);	

			/**
			 * De cada post solo devuelvo la información necesaria, y con el
			 * formato necesario
			 * 
			 * Para evitar repetir una y otra vez este formateo y poder extraer
			 * dicha responsabilidad:
			 *
			 * http://fractal.thephpleague.com/transformers/
			 */
			
			$data = $user->posts->map(function($item) {
				return [
					'id' 		=> $item->id,
					'title'		=> $item->title,
					'content'	=> $item->content
				];
			}); 

			return $this->getSuccessResponse($data);
		} 
		catch (ModelNotFoundException $e) 
		{
			return $this->getErrorResponse("Resource not found", "The user can't be found", 404);
		}
	}

	/**
	 * Le crea un nuevo post a un usua
	 * rio
	 */
	public function store($id, Request $request) {

		try 
		{
			//Ejercicio: Agregar validación de los campos title y content
			$user = User::findOrFail($id);

			$post = new Post($request->only('title', 'content'));
			$user->posts()->save($post);

			return $this->getCreatedResponse(['id'=>$post->id, 'title'=>$post->title, 'content'=>$post->content]);
		} 
		catch (ModelNotFoundException $e) 
		{
			return $this->getErrorResponse("Resource not found", "The user can't be found", 404);	
		}
		
	}
}
