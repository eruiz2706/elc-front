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
            'user_id'=>1,
            'nombre' =>'Programacion orientada a objetos'
        ]);
        Curso::create([
            'user_id'=>1,
            'nombre' =>'Angular 5'
        ]);
        Curso::create([
            'user_id'=>1,
            'nombre' =>'Javascript avanzado'
        ]);
        Curso::create([
            'user_id'=>1,
            'nombre' =>'Laravel 5.7 novedades'
        ]);
    }
}
