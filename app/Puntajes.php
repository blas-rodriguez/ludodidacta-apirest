<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Puntajes extends Model
{
    public function juegos()
    {
        return $this->belongsTo('App\juegos','juego_id','id');
    }
}
