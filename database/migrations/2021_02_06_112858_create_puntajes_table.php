<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePuntajesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('puntajes', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('fecha');
            $table->integer('puntaje');
            $table->integer('equipo_id')->unsigned()->nullable();
            $table->foreign('equipo_id')->references('id')->on('equipos');
            // $table->integer('equipo_id')->unsigned()->nullable();
            // $table->foreign('equipo_id')->references('id')->on('equipos');
            // $table->string('name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('puntajes');
    }
}
