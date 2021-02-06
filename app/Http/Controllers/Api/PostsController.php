<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\BaseController as ApiController;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Post;

/**
 * Extiendo de un controlador base para el api de forma tal
 * de tener centralizado el formato de la misma en un solo lugar,
 * ya sea para devolver respuestas de exito, de error...
 */
class PostsController extends ApiController
{
	/**
	 * Muestra el listado de todos los posts paginados
	 */
    public function index() {

		$posts = Post::paginate(5);
	
		/**
		 * De cada post solo devuelvo la información necesaria, y con el
		 * formato necesario
		 * 
		 * Para evitar repetir una y otra vez este formateo y poder extraer
		 * dicha responsabilidad:
		 *
		 * http://fractal.thephpleague.com/transformers/
		 */
		
		$data = $posts->map(function($item) {
			return [
				'id' 		=> $item->id,
				'title'		=> $item->title,
				'content'	=> $item->content
			];
		}); 

		/**
		 * Obtengo los links necesarios para que se puedan recorrer
		 * los elementos
		 */
		$paginationLink = [
			'prev'	=> $posts->previousPageUrl(),
			'next'	=> $posts->nextPageUrl(),
			'total'	=> $posts->total()
		];

		return $this->getPaginatedSuccessResponse($data, $paginationLink);
	}

	/**
	 * Muestra la información de un post específico
	 */
	public function show($id) {
		try 
		{
			$post = Post::findOrFail($id);

			/**
			 * Solo devuelvo la información necesaria del post y con el formato
			 * necesario
			 * 
			 * Para evitar repetir una y otra vez este formateo y poder extraer
			 * dicha responsabilidad:
			 *
			 * http://fractal.thephpleague.com/transformers/
			 */
			
			$data = [
						'id' 		=> $post->id,
						'title'		=> $post->title,
						'content'	=> $post->content
					];	

			return $this->getSuccessResponse($data, 200);
		} 
		catch(ModelNotFoundException $e) 
		{
			//En lugar de manejar las exceptions en cada lugar, podrian manejarse por ejemplo en el Handler, y más aún utilizar nuestras propias exceptions para un control mucho mayor

			return $this->getErrorResponse("Resource not found", "The requested post can't be found", 404);
		}		
	}
}
