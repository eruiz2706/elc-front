<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeccionesUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lecciones_user', function (Blueprint $table) {
            /*$table->increments('id');
            $table->integer('emisor')->unsigned()->index();
            $table->integer('receptor')->unsigned()->index();
            $table->dateTime('fecha_creacion');
            $table->timestamps();*/
            $table->integer('leccion_id')->unsigned()->index();
            $table->foreign('leccion_id')->references('id')->on('lecciones')->onDelete('cascade');
            $table->dateTime('fecha_creacion');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lecciones_user');
    }
}
