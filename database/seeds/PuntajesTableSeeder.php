<?php

use Illuminate\Database\Seeder;

use App\Post;
use App\User;
use App\Juegos;
use App\Puntajes;

class PuntajesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$faker = Faker\Factory::create();


		for($i=0; $i < 4; $i++) {
			$Puntajes = Puntajes::create(
		    	[
		          'fecha'         => $faker->dateTime, //Genera una oración de 6 palabras
		          'puntaje'      => rand(1,50),
		          'juego_id'     => rand(1,10),
		          'equipo_id'    => rand(1,4),
		        ]); 	
		}
    	

    }
}
