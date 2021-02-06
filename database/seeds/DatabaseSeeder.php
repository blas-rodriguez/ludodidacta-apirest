<?php

use Illuminate\Database\Seeder;

use App\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      /*
      
        Si ejecutas php artisan db:seed se va a ejecutar siempre el método run de este seeder,el cual viene por defecto en todo proyecto nuevo
      
        Podria poner todo el código para la generacion de usuarios y posts en este método, pero quedaria demasiado cargado, ese es el motivo por el que los separo, pero no es obligatorio!

        Teniendo este seeder, si quiero reiniciar la data de mi base de datos puedo ejecutar:
        php artisan migrate:refresh --seed

        Para mas información: https://laravel.com/docs/5.3/seeding

      */
     
      $this->call('EquiposTableSeeder');
      $this->call('JuegosTableSeeder');
      $this->call('UsersTableSeeder');
      $this->call('PostsTableSeeder');
      $this->call('PuntajesTableSeeder');

      /* 

        CUESTIONES:

        - ¿Como hice para crear estos 2 seeders?
        - ¿Por que tengo que llamarlos con el método call? Y por que desde este seeder?
        - ¿El nombre que le pongo a mis seeders, influye en algo en la información que cargan, o es solo una convención?

       */
    }
}
