<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Equipos;
use App\Juegos;
use App\Puntajes;

class PublicController extends Controller
{
	/**
	 * Este controlador está pensando para poner rutas que no requiren
	 * de autenticación (rutas públicas)
	 */
	
	/**
	 * Muestra la pagina inicial
	 */
    public function index() {
    	//En la vista principal muestro los 10 mejores posts a todos los usuarios!
    	
    	//Obtiene los Top posts, mirate el método scopeTop en el modelo Post
	  	$posts   = Post::top()->get(); 
	  	$users   = User::take(5)->orderBy('created_at', 'DESC')->get();
	  	// $juegos  = Juegos::take(5)->orderBy('created_at', 'DESC')->get();
	  	$juegos  = Puntajes::take(5)->selectRaw('juegos.id,juegos.name , SUM(puntajes.puntaje) as puntaje')
					->leftJoin('juegos', 'puntajes.juego_id', '=', 'juegos.id')				 
					->groupBy('juegos.id')
					->get();
	  	$puntajes  = Puntajes::take(5)->selectRaw('equipos.id,equipos.name , SUM(puntajes.puntaje) as puntaje')
					->leftJoin('equipos', 'puntajes.equipo_id', '=', 'equipos.id')				 
		            ->groupBy('equipos.id')
					->with('juegos')
					->get();
	  	$Equipos = Equipos::take(5)->orderBy('created_at', 'DESC')->get();
		// dd($puntajes);

	  	return view('public.index')
		  			->with('posts', $posts)
		  			->with('Equipos', $Equipos)
		  			->with('juegos', $juegos)
		  			->with('puntajes', $puntajes)
		  			->with('users', $users);
    }

    /**
     * Muestra una vista con información del proyecto
     */
    public function showHelp() {
    	return view('public.help');
    }
}
