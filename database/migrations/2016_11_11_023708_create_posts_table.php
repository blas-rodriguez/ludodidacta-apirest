<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {

            /**
             * El método increments('id') nos crea la clave primaria ID, unsigned, integer y 
             * autoincremental, sin tener que decirle ninguna de estas cosas!
             */
            $table->increments('id');

            /**
             * Creo un campo para guardar el titulo del post, y un campo para guardar el contenido del post
             */
            $table->string('title');
            $table->text('content');

            /**
             * Cada post va a poder pertenecer a un solo usuario, para poder luego crear la clave foranea
             * es completamente necesario que mi campo sea del mismo tipo que la clave a la que va a apuntar, es decir si el ID de la tabla users, es unsigned integer, mi clave foranea user_id tambien debe serlo!
             */
            $table->integer('user_id')->unsigned();

            /**
             * Creo la clave foranea para asegurarme de que siempre la informaciòn que haya
             * en mi base de datos sea consistente, impidiendo que un post pueda pertenecer
             * a un usuario inexistente (lo cual sería realmente un problema!)
             */
            $table->foreign('user_id')->references('id')->on('users');

            /*
             * A menos que tengamos una buena razón para no usar timestamps, aprovechemos que Eloquent los maneja por nosotros! 
             * 
             * (Al crear cualquier registro automaticamente se setea el created_at, y al actualizar
             * cualquier registro automaticamente se actualiza el updated_at)
             */
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
        Schema::dropIfExists('posts');
    }
}
