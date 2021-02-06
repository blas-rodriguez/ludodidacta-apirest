<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	//Nunca jamas pongo las claves foraneas en el atributo fillable, esto puede terminar en un severo bug de seguridad, siempre las defino en las relationships que correspondan!
    protected $fillable = ['title', 'content']; 

    /**
     * Defino la relacion entre un post y un usuario
     * 
     * En este caso le digo que un post puede pertenecer a un solo usuario.
     * 
     * Notar que no tengo que especificarle la clave foranea user_id
     * ni el nombre de la tabla users porque al crear las tablas seguí
     * las convenciones, tanto en los nombres de tablas como en
     * los nombres de las claves foraneas!
     *
     * https://laravel.com/docs/5.3/eloquent#eloquent-model-conventions
     */ 
    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * Devuelve los Top posts
     * 
     * De esta forma en el mismo modelo defino lo que es y lo que no es un top post
     * y lo puedo reutilizar en toda la aplicación
     * 
     * Mirate la documentación de scopes! Son muy útiles!
     * 
     * https://laravel.com/docs/5.3/eloquent#local-scopes
     */
    public function scopeTop($query) {
        return $query->take(10)->orderBy('created_at', 'DESC');
    }
}
