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
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('nombre', 150);
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_finalizacion')->nullable();
            $table->string('duracion',150)->nullable();
            $table->string('urlvideo',300)->nullable();
            $table->boolean('visibilidad')->default(false);
            $table->text('plan_estudio')->nullable();
            $table->dateTime('fecha_creacion')->nullable();
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
