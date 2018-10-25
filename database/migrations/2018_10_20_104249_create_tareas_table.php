<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTareasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tareas', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('curso_id')->unsigned()->index();
          $table->foreign('curso_id')->references('id')->on('cursos')->onDelete('cascade');
          $table->string('nombre',300);
          $table->text('descripcion')->nullable();
          $table->date('fecha_vencimiento');
          $table->integer('calificacion')->unsigned()->default(0);
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
        Schema::dropIfExists('tareas');
    }
}
