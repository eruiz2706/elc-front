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
            'nombre' =>'Programacion orientada a objetos'
        ]);
        Curso::create([
            'nombre' =>'Angular 5'
        ]);
        Curso::create([
            'nombre' =>'Javascript avanzado'
        ]);
        Curso::create([
            'nombre' =>'Laravel 5.7 novedades'
        ]);
    }
}
