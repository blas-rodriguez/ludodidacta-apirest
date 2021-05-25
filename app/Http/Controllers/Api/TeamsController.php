<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\BaseController as ApiController;
use Carbon\Carbon;
use App\User, App\Post, App\Equipos, App\Puntajes;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Extiendo de un controlador base para el api de forma tal
 * de tener centralizado el formato de la misma en un solo lugar,
 * ya sea para devolver respuestas de exito, de error...
 */
class TeamsController extends ApiController
{
	/**
	 * Lista los posts de un usuario específico
	 *
	 * Ejercicio: paginarlos!
	 */
	public function index() {
		try 
		{
			// $teams = Equipos::findOrFail($id);	
			$teams = Equipos::all();	

			/**
			 * De cada post solo devuelvo la información necesaria, y con el
			 * formato necesario
			 * 
			 * Para evitar repetir una y otra vez este formateo y poder extraer
			 * dicha responsabilidad:
			 *
			 * http://fractal.thephpleague.com/transformers/
			 */
			
			$data = $teams->map(function($item) {
				return [
					'id' 		=> $item->id,
					'name'		=> $item->name,
					
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
					'lastname'	=> $item->lastname,
					'equipo_id'	=> $item->equipo_id 
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
			$game=(int)$request->juego;
			$name=(string)$request->name;
			$nuevo=(string)$request->nuevo;
			
			if(!empty($nuevo))
			{
				$idEquipo =Equipos::create([
					'name'  => $name,
					  ]);
				Puntajes::create([
						'puntaje'  =>$puntos,
						'fecha'  => Carbon::now(),
						'equipo_id'  => $idEquipo->id,
						  ]);
			}
			else{
				if(!empty($puntos))
				{
				$teams =  Puntajes::where('equipo_id',$id)->first();	
				// $teams =  Puntajes::where('equipo_id',$id)->where('juego_id',$game)->first();	
				$teams->puntaje = $teams->puntaje +$puntos;
				$teams->save();
				}
					
				if(!empty($name))
				{
					$teamsModify =  Equipos::findOrFail($id);
					$teamsModify->name=$name;
					$teamsModify->save();
				}
			}
			
				

				
			  

			return $this->getSuccessResponse([200]);
		} 
		catch (ModelNotFoundException $e) 
		{
			return $this->getErrorResponse("Resource not found", "The user can't be found", 404);
		}
	}
}
