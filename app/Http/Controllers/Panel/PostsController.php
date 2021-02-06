<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class PostsController extends Controller
{
    
	/**
     * Muestra el panel de alta/baja/modificacion de posts de un usuario especifico
     */
    public function index() {

    	//En la vista no está mal utilizar directamente Auth::user() para mostrar data del usuario, pero para dar información relacionada al usuario (como los posts) debemos irla a buscar en el controlador (o en un repositorio) y pasarsela a la vista

    	//Si quisiera pasarle a la vista los posts paginados seria:
    	// Auth::user()->posts()->paginate(3) <- con los parentesis despues de posts
    	$posts = Auth::user()->posts;

    	return view('panel.posts.index')->with('posts', $posts);
    }

}
