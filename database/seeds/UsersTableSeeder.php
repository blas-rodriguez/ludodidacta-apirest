<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
//Si uso una clase, no me puedo olvidar de importarla con el nombre completo!!!
use App\User;
use App\Equipos;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(User::count() > 0 )
	      	throw new Exception("Ya hay usuarios en la tabla! Ejecutá php artisan migrate:refresh --seed si queres borrar todas tus tablas, volverlas a crear y seedearla nuevamente");

        $this->createDefaultUser();
        $this->createRandomUsers();
    }

    /**
     * Genero un usuario fijo que nos sirva para pruebas sin necesidad de andar
     * revisando que usuarios aleatorios se crearon
     */
    protected function createDefaultUser() {
        User::create([
              'name'     => 'Admin',
              'puntaje'     => 1,
              'lastname' => 'Admin',
              'nacimiento' => Carbon::now(),
              'fecha_visita' => Carbon::now(),
              'email'    => 'admin@admin.com',
              'equipo_id'   => 1,
              'password' => Hash::make('123456789')
        ]); 
    }

    /**
     * Genero usuarios falsos con data aleatoria!
     */
    protected function createRandomUsers() {

        $faker = Faker\Factory::create();

        $Equipos = Equipos::all(); 

        for($i=0; $i < 4; $i++) {
            User::create([
              'name'        => $faker->firstName,
              'puntaje'     => rand(1,30),
              'lastname'    => $faker->lastName,
              'nacimiento'  => Carbon::now(),
              'fecha_visita'=> Carbon::now(),
              'email'       => $faker->email,
              'equipo_id'   => $Equipos->random(1)->id,
              'password'    => Hash::make('12345678'), //Vital guardar la contraseña encriptada o no nos vamos a poder autenticar!
            ]); 
        }
    }
}
