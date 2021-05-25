<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Puntajes extends Model
{
    protected $fillable = [
        'fecha', 'puntaje', 'equipo_id', 'juego_id' //Agrego los campos photo y lastname!
    ];
    public function juegos()
    {
        return $this->belongsTo('App\juegos','juego_id','id');
    }
}
