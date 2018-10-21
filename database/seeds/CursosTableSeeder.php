<?php

use Illuminate\Database\Seeder;
use App\Models\Curso;

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
            'imagen'=>'img/cursos/curso_1.jpg'
        ]);
        Curso::create([
            'user_id'=>3,
            'nombre' =>'Ingles nivel 1',
            'visibilidad'=>true,
            'fecha_inicio'=>'2018-10-16',
            'fecha_finalizacion'=>'2018-11-01',
            'urlvideo'=>'https://www.youtube.com/embed/r-Kb8SrR5LQ',
            'imagen'=>'img/cursos/curso_2.jpg'
        ]);
        Curso::create([
            'user_id'=>3,
            'nombre' =>'Ingles nivel 2',
            'visibilidad'=>true,
            'fecha_inicio'=>'2018-11-02',
            'fecha_finalizacion'=>'2018-11-20',
            'urlvideo'=>'https://www.youtube.com/embed/iFHWC3S2vXY',
            'imagen'=>'img/cursos/curso_3.jpg'
        ]);
        Curso::create([
            'user_id'=>3,
            'nombre' =>'Ingles nivel 3',
            'visibilidad'=>true,
            'fecha_inicio'=>'2018-11-21',
            'fecha_finalizacion'=>'2018-12-10',
            'urlvideo'=>'https://www.youtube.com/embed/YqvBGgMW-3U',
            'imagen'=>'img/cursos/curso_4.jpg'
        ]);
    }
}
