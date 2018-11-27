<?php

use Illuminate\Database\Seeder;
use App\Models\Curso;
use App\Models\Estados;

class CursosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Curso::create([
            'user_id'=>3,
            'nombre' =>'Pre-icfes 2018',
            'visibilidad'=>true,
            'fecha_inicio'=>'2018-10-01',
            'fecha_finalizacion'=>'2018-10-15',
            'urlvideo'=>'https://www.youtube.com/embed/6f1sjIhI2Ww',
            'imagen'=>'img/app/curso.jpg',
            'fecha_creacion'=>date('Y-m-d')
        ]);
        Curso::create([
            'user_id'=>3,
            'nombre' =>'Ingles nivel 1',
            'visibilidad'=>true,
            'fecha_inicio'=>'2018-10-16',
            'fecha_finalizacion'=>'2018-11-01',
            'urlvideo'=>'https://www.youtube.com/embed/r-Kb8SrR5LQ',
            'imagen'=>'img/app/curso.jpg',
            'fecha_creacion'=>date('Y-m-d')
        ]);
        Curso::create([
            'user_id'=>3,
            'nombre' =>'Ingles nivel 2',
            'visibilidad'=>true,
            'fecha_inicio'=>'2018-11-02',
            'fecha_finalizacion'=>'2018-11-20',
            'urlvideo'=>'https://www.youtube.com/embed/iFHWC3S2vXY',
            'imagen'=>'img/app/curso.jpg',
            'fecha_creacion'=>date('Y-m-d')
        ]);
        Curso::create([
            'user_id'=>3,
            'nombre' =>'Ingles nivel 3',
            'visibilidad'=>true,
            'fecha_inicio'=>'2018-11-21',
            'fecha_finalizacion'=>'2018-12-10',
            'urlvideo'=>'https://www.youtube.com/embed/YqvBGgMW-3U',
            'imagen'=>'img/app/curso.jpg',
            'fecha_creacion'=>date('Y-m-d')
        ]);

        /*estados de un curso*/
        Estados::create([
            'tipo'=>'cursos',
            'slug' =>'abierto',
            'nombre'=>'Abierto',
        ]);
        Estados::create([
            'tipo'=>'cursos',
            'slug' =>'encurso',
            'nombre'=>'En curso'
        ]);
        Estados::create([
            'tipo'=>'cursos',
            'slug' =>'finalizado',
            'nombre'=>'Finalizado'
        ]);
        Estados::create([
            'tipo'=>'tareas',
            'slug' =>'pendiente',
            'nombre'=>'Pendiente',
            'status'=>'danger'
        ]);
        Estados::create([
            'tipo'=>'tareas',
            'slug' =>'entregado',
            'nombre'=>'Pendiente por calificar',
            'status'=>'info'
        ]);
        Estados::create([
            'tipo'=>'tareas',
            'slug' =>'calificado',
            'nombre'=>'Calificado',
            'status'=>'success'
        ]);

        Estados::create([
            'tipo'=>'ejercicios',
            'slug' =>'pendiente',
            'nombre'=>'Pendiente',
            'status'=>'danger'
        ]);
        Estados::create([
            'tipo'=>'ejercicios',
            'slug' =>'entregado',
            'nombre'=>'Pendiente por calificar',
            'status'=>'info'
        ]);
        Estados::create([
            'tipo'=>'ejercicios',
            'slug' =>'calificado',
            'nombre'=>'Calificado',
            'status'=>'success'
        ]);
    }
}
