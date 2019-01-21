<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Models\RoleUser;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $rol1=Role::create([
              'name' =>'Estudiante',
              'slug'=>'es',
              'special'=>'all-access'
            ]);
          $rol2=Role::create([
            'name' =>'Profesor',
            'slug'=>'pr',
            'special'=>'all-access'
          ]);

          $rol3=Role::create([
            'name' =>'Institucion',
            'slug'=>'in',
            'special'=>'all-access'
          ]);
          $rol4=Role::create([
            'name' =>'Familiar',
            'slug'=>'pa',
            'special'=>'all-access'
          ]);
          $rol5=Role::create([
            'name' =>'Administrador de contenido',
            'slug'=>'ad',
            'special'=>'all-access'
          ]);

          /*USUARIO */
          $user1=User::create([
            'nombre' =>'Estudiante',
            'email'=>'estudiante@gmail.com',
            'password'=>Hash::make('123456'),
            'uniqid'=>uniqid('',true),
            'slugrol'=>'es'
          ]);
          RoleUser::create([
            'user_id' =>$user1->id,
            'role_id' =>$rol1->id
          ]);

          $user2=User::create([
            'nombre' =>'Profesor',
            'email'=>'profesor@gmail.com',
            'password'=>Hash::make('123456'),
            'uniqid'=>uniqid('',true),
            'slugrol'=>'pr'
          ]);
          RoleUser::create([
            'user_id' =>$user2->id,
            'role_id' =>$rol2->id
          ]);

          $user3=User::create([
            'nombre' =>'Institucion',
            'email'=>'institucion@gmail.com',
            'password'=>Hash::make('123456'),
            'uniqid'=>uniqid('',true),
            'slugrol'=>'in'
          ]);
          RoleUser::create([
            'user_id' =>$user3->id,
            'role_id' =>$rol3->id
          ]);

          $user4=User::create([
            'nombre' =>'Padres',
            'email'=>'padres@gmail.com',
            'password'=>Hash::make('123456'),
            'uniqid'=>uniqid('',true),
            'slugrol'=>'pa'
          ]);
          RoleUser::create([
            'user_id' =>$user4->id,
            'role_id' =>$rol4->id
          ]);
          $user5=User::create([
            'nombre' =>'Administrador de contenido',
            'email'=>'administrador@gmail.com',
            'password'=>Hash::make('123456'),
            'uniqid'=>uniqid('',true),
            'slugrol'=>'ad'
          ]);
          RoleUser::create([
            'user_id' =>$user5->id,
            'role_id' =>$rol5->id
          ]);

          $user6=User::create([
            'nombre' =>'Profesor2',
            'email'=>'profesor2@gmail.com',
            'password'=>Hash::make('123456'),
            'uniqid'=>uniqid('',true),
            'slugrol'=>'pr'
          ]);
          RoleUser::create([
            'user_id' =>$user6->id,
            'role_id' =>$rol2->id
          ]);
    }
}
