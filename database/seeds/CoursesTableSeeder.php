<?php

use Illuminate\Database\Seeder;
use App\Models\Course;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Course::create([
            'name' =>'Programacion orientada a objetos'
        ]);
        Course::create([
            'name' =>'Angular 5'
        ]);
        Course::create([
            'name' =>'Javascript avanzado'
        ]);
        Course::create([
            'name' =>'Laravel 5.7 novedades'
        ]);
    }
}
