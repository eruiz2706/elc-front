<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRespuestasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respuestas', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('pregunta_id')->unsigned()->index();
          $table->foreign('pregunta_id')->references('id')->on('preguntas')->onDelete('cascade');
          $table->integer('user_id')->unsigned()->index();
          $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
          $table->dateTime('fecha_creacion');
          $table->integer('userm_id')->unsigned()->nullable()->index();
          $table->foreign('userm_id')->references('id')->on('users')->onDelete('cascade');
          $table->dateTime('fecha_modific')->nullable();
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
        Schema::dropIfExists('respuestas');
    }
}
