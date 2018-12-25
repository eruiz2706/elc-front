<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',300); //nombre del curso
            $table->date('fecha_inicio')->nullable(); //fecha de inicio del curso
            $table->date('fecha_finalizacion')->nullable(); //fecha de finalizacion
            $table->date('fecha_limite')->nullable(); //fecha limite para ver notas
            $table->string('urlvideo',300)->default('')->nullable(); //url youtube del curso
            $table->boolean('visibilidad')->default(false); //si va a estar visible en la oferta de cursos
            $table->boolean('inscripcion')->default(false); // si va a permitir inscripcion por los estudiantes
            $table->text('plan_estudio')->nullable(); // plan de estudio del curso
            $table->string('imagen')->default('img/app/curso.jpg'); // url de la imagen del curso
            $table->string('estado',15)->default('');//estado del curso
            $table->double('valor')->default(0);//valor del curso
            $table->dateTime('fecha_creacion'); // fecha en que se crea el curso
            $table->integer('user_id')->unsigned()->index(); //usuario que crea el curso
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->dateTime('fecha_modific')->nullable(); //ultima fecha de modificacion del curso
            $table->integer('userm_id')->unsigned()->nullable()->index(); //ultimo usuario que modifico el curso
            $table->foreign('userm_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('courses');
    }
}
