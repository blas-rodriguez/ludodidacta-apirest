<?php

use Illuminate\Database\Seeder;

use App\Post;
use App\User;
use App\Juegos;

class JuegosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$faker = Faker\Factory::create();


		for($i=0; $i < 10; $i++) {
			$juegos = Juegos::create(
		    	[
		          'name'   => $faker->sentence(2), //Genera una oración de 6 palabras
		        ]); 	
		}
    	

    }
}
