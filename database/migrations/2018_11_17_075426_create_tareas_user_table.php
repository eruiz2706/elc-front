<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTareasUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tareas_user', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('tarea_id')->unsigned()->index();
          $table->foreign('tarea_id')->references('id')->on('tareas')->onDelete('cascade');
          $table->text('respuesta')->nullable();
          $table->text('comentario')->nullable();
          $table->double('calificacion')->unsigned()->default(0);
          $table->dateTime('fecha_creacion');
          $table->integer('user_id')->unsigned()->index();
          $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('tareas_user');
    }
}
