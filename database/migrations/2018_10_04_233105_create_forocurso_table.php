<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForocursoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forocurso', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('curso_id')->unsigned()->index();
            $table->foreign('curso_id')->references('id')->on('cursos')->onDelete('cascade');
            $table->text('descripcion');
            $table->integer('comentarios')->default(0);
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
        Schema::dropIfExists('forocurso');
    }
}
