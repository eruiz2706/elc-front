<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatDetalleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chatprivado_det', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('chat_id')->unsigned()->index();
            $table->foreign('chat_id')->references('id')->on('chatprivado')->onDelete('cascade');
            $table->integer('remitente')->unsigned()->index();
            $table->text('mensaje');
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
        Schema::dropIfExists('chat_detalle');
    }
}
