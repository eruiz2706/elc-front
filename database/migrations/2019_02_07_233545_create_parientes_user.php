<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParientesUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parientes_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user')->unsigned()->index();
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->integer('id_pariente')->unsigned()->index();
            $table->foreign('id_pariente')->references('id')->on('users')->onDelete('cascade');
            $table->dateTime('fecha_creacion');
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
        Schema::dropIfExists('parientes_user');
    }
}
