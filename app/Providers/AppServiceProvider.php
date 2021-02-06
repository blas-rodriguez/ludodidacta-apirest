<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Cada vez que se crea un usuario nuevo le asignamos un api_token
         * para que pueda acceder a las rutas protegidas con autenticación
         * del api
         */
         User::creating(function ($user) {
            return $user->api_token = str_random(60);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
