<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\BaseController as ApiController;
use Carbon\Carbon;
use App\User, App\Post, App\Puntajes;
use Illuminate\Support\Facades\Hash;
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
	/**
	 * Lista los posts de un usuario específico
	 *
	 * Ejercicio: paginarlos!
	 */
	public function allUsers() {
		try 
		{
			$user = User::all();	
			
			$data = $user->map(function($item) {
				return [
					'id' 		=> $item->id,
					'name'		=> $item->name,
					'nacimiento'=> $item->nacimiento,
					'lastname'	=> $item->lastname,
					'equipo_id'	=> $item->equipo_id,
					'puntaje'	=> $item->puntaje 
				];
			}); 

			return $this->getSuccessResponse($data);
		} 
		catch (ModelNotFoundException $e) 
		{
			return $this->getErrorResponse("Resource not found", "The user can't be found", 404);
		}
	}
	public function allPoints() {
		try 
		{
			$user = Puntajes::all();	
			
			$data = $user->map(function($item) {
				return [
					'id' 		=> $item->id,
					'fecha'		=> $item->fecha,
					'puntaje'   => $item->puntaje,
					'equipo_id'	=> $item->equipo_id,
					'juego_id'	=> $item->juego_id 
				];
			}); 

			return $this->getSuccessResponse($data);
		} 
		catch (ModelNotFoundException $e) 
		{
			return $this->getErrorResponse("Resource not found", "The user can't be found", 404);
		}
	}

	public function addPoints($id, Request $request) {
		try 
		{
			$puntos=(int)$request->puntos;
			$equipo=(int)$request->equipo;
			$name=(string)$request->name;
			$nuevo=(string)$request->nuevo;
			// dd($puntos);
			if(!empty($nuevo))
			{
				User::create([
					'name'        => $name,
					'puntaje'     => $puntos,
					'lastname'    => $name,
					'nacimiento'  => Carbon::now(),
					'fecha_visita'=> Carbon::now(),
					'email'       => $name."@gmail.com",
					'equipo_id'   => $equipo,
					'password'    => Hash::make('12345678'), //Vital guardar la contraseña encriptada o no nos vamos a poder autenticar!
				  ]);
			}
			else
			  {
				$user =  User::findOrFail($id);	

				if(!empty($puntos))
				$user->puntaje = $user->puntaje +$puntos;
	
				if(!empty($name))
				$user->name=$name;
	
				if(!empty($equipo))
				$user->equipo_id=$equipo;
	
				$user->save();
			  }
			



			return $this->getSuccessResponse(["status",200]);
		} 
		catch (ModelNotFoundException $e) 
		{
			return $this->getErrorResponse("Resource not found", "The user can't be found", 404);
		}
	}
}
