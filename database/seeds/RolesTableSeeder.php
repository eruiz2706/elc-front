<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
              'name' =>'Estudiante',
              'slug'=>'study',
              'special'=>'all-access'
            ]);
        Role::create([
            'name' =>'Profesor',
            'slug'=>'teacher',
            'special'=>'all-access'
          ]);

          Role::create([
            'name' =>'Institucion',
            'slug'=>'institution',
            'special'=>'all-access'
          ]);
          Role::create([
            'name' =>'Padre de familia',
            'slug'=>'family',
            'special'=>'all-access'
          ]);
    }
}
