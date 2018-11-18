
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('nombre');
            $table->integer('estado')->default(1);
            $table->string('uniqid')->nullable();
            $table->string('imagen')->default('img/app/avatar.jpg');
            $table->date('fecha_vencimiento')->nullable();
            $table->dateTime('fecha_ultimo_ingreso')->nullable();
            $table->dateTime('fecha_ultimo_uso')->nullable();
            $table->string('telefono')->nullable();
            $table->string('ciudad')->nullable();
            $table->string('direccion')->nullable();
            $table->string('facebook')->nullable();
            $table->string('linkedin')->nullable();
            $table->text('biografia')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
