<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRespuestasUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respuestas_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ejerciciouser_id')->unsigned()->index();
            $table->foreign('ejerciciouser_id')->references('id')->on('ejercicios_user')->onDelete('cascade');
            $table->integer('preguntas_id')->unsigned()->index();
            $table->foreign('preguntas_id')->references('id')->on('preguntas')->onDelete('cascade');
            $table->integer('respuesta_id')->unsigned()->index();
            $table->foreign('respuesta_id')->references('id')->on('respuestas')->onDelete('cascade');
            $table->double('puntaje')->default(0);
            $table->boolean('seleccion')->default(false);
            $table->text('respuesta')->nullable();
            $table->text('relacionar')->nullable();
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
        Schema::dropIfExists('respuestas_user');
    }
}
