<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreguntasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preguntas', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('ejercicio_id')->unsigned()->index();
          $table->foreign('ejercicio_id')->references('id')->on('ejercicios')->onDelete('cascade');
          $table->string('nombre',300);
          $table->text('descripcion')->nullable();
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
        Schema::dropIfExists('preguntas');
    }
}
