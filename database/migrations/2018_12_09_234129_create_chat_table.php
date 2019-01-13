<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chatprivado', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('emisor')->unsigned()->index();
            $table->foreign('emisor')->references('id')->on('users')->onDelete('cascade');
            $table->integer('receptor')->unsigned()->index();
            $table->foreign('receptor')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('chat');
    }
}
