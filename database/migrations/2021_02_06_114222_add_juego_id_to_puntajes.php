<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddJuegoIdToPuntajes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('puntajes', function (Blueprint $table) {
            // ...
            $table->integer('juego_id')->unsigned()->nullable();
            $table->foreign('juego_id')->references('id')->on('juegos');
            // ...
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('puntajes', function (Blueprint $table) {
            $table->dropForeign(['juego_id']);
        });
    }
}
