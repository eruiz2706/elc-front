<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      /*
      TRIGGUER PARA ACTUALIZAR LAS ENTREGAS HECHAS A UNA TAREA POR LOS USUARIOS
      */
      DB::unprepared('
      CREATE OR REPLACE FUNCTION tareas_user() RETURNS TRIGGER AS $tareas_user$
          DECLARE
          BEGIN
          update tareas set entregas=(select count(id) from tareas_user where tarea_id=NEW.tarea_id)
        	where id=NEW.tarea_id;

           RETURN NULL;
          END;
        $tareas_user$ LANGUAGE plpgsql;

        CREATE TRIGGER tareas_user AFTER INSERT OR UPDATE
            ON tareas_user FOR EACH ROW
            EXECUTE PROCEDURE tareas_user();
      ');

      /*
      TRIGGUER PARA ACTUALIZAR EL NUMERO DE PREGUNTAS DE UN EJERCICIO
      */
      DB::unprepared('
      CREATE OR REPLACE FUNCTION preguntas() RETURNS TRIGGER AS $preguntas$
        DECLARE
        BEGIN
        update ejercicios set calificacion=(select sum(calificacion) from preguntas where ejercicio_id=NEW.ejercicio_id),preguntas=(select count(id) from preguntas where ejercicio_id=NEW.ejercicio_id)
        where id=NEW.ejercicio_id;

         RETURN NULL;
        END;
      $preguntas$ LANGUAGE plpgsql;

      CREATE TRIGGER preguntas AFTER INSERT OR UPDATE
          ON preguntas FOR EACH ROW
          EXECUTE PROCEDURE preguntas();
      ');

      /*
      TRIGGUER PARA ACTUALIZAR LA CALIFICACION SOBRE LA QUE SE EVALUA UNA PREGUNTA
      */
      DB::unprepared('
      CREATE OR REPLACE FUNCTION respuestas() RETURNS TRIGGER AS $respuestas$
          DECLARE
          BEGIN
          update preguntas set calificacion=(select sum(puntaje) from respuestas where pregunta_id=NEW.pregunta_id)
          where id=NEW.pregunta_id;

           RETURN NULL;
          END;
        $respuestas$ LANGUAGE plpgsql;

        CREATE TRIGGER respuestas AFTER INSERT OR UPDATE
            ON respuestas FOR EACH ROW
            EXECUTE PROCEDURE respuestas();
      ');

      /*
      */
      DB::unprepared('
      CREATE OR REPLACE FUNCTION ejercicios_user() RETURNS TRIGGER AS $ejercicios_user$
        DECLARE
        BEGIN
        update ejercicios set entregas=(select count(id) from ejercicios_user where ejercicio_id=NEW.ejercicio_id)
        where id=NEW.ejercicio_id;

         RETURN NULL;
        END;
      $ejercicios_user$ LANGUAGE plpgsql;

      CREATE TRIGGER ejercicios_user AFTER INSERT OR UPDATE
          ON ejercicios_user FOR EACH ROW
          EXECUTE PROCEDURE ejercicios_user();
      ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `tareas_user`');
        DB::unprepared('DROP TRIGGER `preguntas`');
        DB::unprepared('DROP TRIGGER `respuestas`');
        DB::unprepared('DROP TRIGGER `ejercicios_user`');
    }
}
