<?php

namespace App\Http\Middleware;

use Closure;

class LangMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //A partir del subdominio utilizado, cambio el idioma de la página
        
        $urlSegments = explode('.', parse_url($request->url(), PHP_URL_HOST));
        $subdomain = $urlSegments[0]; //obtengo el dominio

        $languages = ['en', 'es']; //defino los idiomas que acepto, podria tenerlos en un archivo de config

        if (in_array($subdomain, $languages)) {
            \App::setLocale($subdomain);
        }

        return $next($request);
    }
}
