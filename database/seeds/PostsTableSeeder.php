<?php

use Illuminate\Database\Seeder;

use App\Post;
use App\User;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	/** 
    	 * 
    	 * Para evitarme tener que hacer un tremendo laburo para generar data que tenga 
         * algún sentido, utilizo una libreria de PHP (o sea que la podemos utilizar en
         * cualquier proyecto con o sin larvel) que viene importada en cualquier proyecto
         * de laravel (composer.json -> require-dev). 
    	 * 
    	 * Dicha libreria se llama Faker y nos permite generar data falsa y coherente
         * de una manera muy sencilla! 
    	 * 
    	 * Para saber todos los métodos que tiene si o si tenemos que revisarlo en la
         * documentación
    	 * https://github.com/fzaninotto/Faker
    	 * 
    	 * Para poder utilizarla en los seeders, como también dice en la documentación 
         * debemos primero crear e inicializar el generador, lo cual hacemos simplemente con: 
    	 * 
    	 * $faker = Faker\Factory::create();
    	 * 
    	 * Si estamos re cancheros con Seeders, Faker, y las relationships de Eloquent, 
         * podemos intentar utilizar las Model Factories de Laravel, las cuales, aunque ahora
         * parezcan muy complicadas, con práctica y siguiendo los ejemplos de la documentación
         * nos pueden realmente agilizar y potenciar la creacion de data falsa en nuestro 
         * proyecto. También nos van a ser muy útiles si en algún momento empezamos a hacer
         * tests automatizados de nuestro sistema! (Te la dejo picando...)
    	 *
    	 */

    	$faker = Faker\Factory::create();

		$users = User::all(); 

		/**
		 * Voy a buscar UNA sola vez los usuarios a la base de datos, y en la variable $users 
		 * ya queda guardada una Collection con los mismos. Que sea una collection es lo que
		 * me va a permitir obtener uno aleatorio! 
		 * 
		 * Ojo si tengo muchos muchos usuarios probablemente voy a tener que pensar algo mas performante que esto!
		 */

		for($i=0; $i < 70; $i++) {
			$post = Post::create(
		    	[
		          'title'   => $faker->sentence(6), //Genera una oración de 6 palabras
		          'content' => $faker->paragraph(10), //Genera un párrafo de 10 oraciones
		          'user_id'	=> $users->random(1)->id //Le guarda el post a un usuario al azar, leer abajo!
		        ]); 	
		}
    	
    	/**
    	 * Unicamente en los seeders no es mala práctica guardar directamente la clave foranea
    	 * user_id ya que generalmente uno crea las migraciones y los seeders antes de tener
         * completamente definidas las relaciones en los modelos, justamente porque uno crea 
         * los seeders para poder ir probando la aplicación.
    	 *
    	 * En cualquier otro sitio, tanto para acceder, modificar o guardar objetos relacionados
    	 * a mi modelo, tengo que si o si definir las relaciones en mi modelo y utilizar los
         * métodos que correspondan a cada tipo de relación. En este caso seria
    	 *
    	 * $post = new Post(['title'=>'...', 'content'=>'...']);
    	 * $post->user()->associate($users->random(1));
    	 * $post->save()
    	 *
    	 * !!!Recordá que no puedo utilizar Post::create(...) porque dicho método ejecuta
    	 * instantaneamente la consulta SQL, es decir: INSERT INTO users (title, content...)
    	 * y como todavía no especifiqué el usuario, y el campo user_id es una clave foranea, 
    	 * MySQL no me lo va a permitir!
    	 */
    }
}
