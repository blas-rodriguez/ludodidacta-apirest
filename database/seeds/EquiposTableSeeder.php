<?php

use Illuminate\Database\Seeder;

use App\Post;
use App\User;
use App\Equipos;

class EquiposTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$faker = Faker\Factory::create();


		for($i=0; $i < 3; $i++) {
			$equipos = Equipos::create(
		    	[
		          // 'name'   => $faker->sentence(2), //Genera una oración de 6 palabras
		          'name'   => $faker->colorName, //Genera una oración de 6 palabras
		          // 'name'   => $faker->randomElement(['Rojo', 'Azul', 'Verde']), //Genera una oración de 6 palabras
		        ]); 	
		}
    	

    }
}
