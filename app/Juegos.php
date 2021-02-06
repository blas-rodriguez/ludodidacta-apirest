<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Juegos extends Model
{
    public function puntajes()
    {
        return $this->hasMany('App\Puntajes','id','juego_id');        
    }
}
