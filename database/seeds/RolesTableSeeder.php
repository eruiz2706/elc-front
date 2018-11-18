<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Models\RoleUser;
use App\Models\Precio;

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
            'name' =>'Administrador',
            'slug'=>'ad',
            'special'=>'all-access'
          ]);

          /*USUARIO */
          $user1=User::create([
            'nombre' =>'Estudiante',
            'fecha_vencimiento'=>date('Y-m-d',strtotime('-1 days', strtotime(date('Y-m-d')))),
            'email'=>'estudiante@gmail.com',
            'password'=>Hash::make('123456'),
            'uniqid'=>uniqid('',true)
          ]);
          RoleUser::create([
            'user_id' =>$user1->id,
            'role_id' =>$rol1->id
          ]);

          $user1=User::create([
            'nombre' =>'Estudiante',
            'fecha_vencimiento'=>date('Y-m-d',strtotime('-1 days', strtotime(date('Y-m-d')))),
            'email'=>'estudiante2@gmail.com',
            'password'=>Hash::make('123456'),
            'uniqid'=>uniqid('',true)
          ]);
          RoleUser::create([
            'user_id' =>$user1->id,
            'role_id' =>$rol1->id
          ]);

          $user2=User::create([
            'nombre' =>'Profesor',
            'fecha_vencimiento'=>date('Y-m-d',strtotime('-1 days', strtotime(date('Y-m-d')))),
            'email'=>'profesor@gmail.com',
            'password'=>Hash::make('123456'),
            'uniqid'=>uniqid('',true)
          ]);
          RoleUser::create([
            'user_id' =>$user2->id,
            'role_id' =>$rol2->id
          ]);

          $user3=User::create([
            'nombre' =>'Institucion',
            'fecha_vencimiento'=>date('Y-m-d',strtotime('-1 days', strtotime(date('Y-m-d')))),
            'email'=>'institucion@gmail.com',
            'password'=>Hash::make('123456'),
            'uniqid'=>uniqid('',true)
          ]);
          RoleUser::create([
            'user_id' =>$user3->id,
            'role_id' =>$rol3->id
          ]);

          $user4=User::create([
            'nombre' =>'Padres',
            'fecha_vencimiento'=>date('Y-m-d',strtotime('-1 days', strtotime(date('Y-m-d')))),
            'email'=>'padres@gmail.com',
            'password'=>Hash::make('123456'),
            'uniqid'=>uniqid('',true)
          ]);
          RoleUser::create([
            'user_id' =>$user4->id,
            'role_id' =>$rol4->id
          ]);
          $user5=User::create([
            'nombre' =>'Administrador',
            'fecha_vencimiento'=>date('Y-m-d',strtotime('-1 days', strtotime(date('Y-m-d')))),
            'email'=>'administrador@gmail.com',
            'password'=>Hash::make('123456'),
            'uniqid'=>uniqid('',true)
          ]);
          RoleUser::create([
            'user_id' =>$user5->id,
            'role_id' =>$rol5->id
          ]);

          $user6=User::create([
            'nombre' =>'Profesor2',
            'fecha_vencimiento'=>date('Y-m-d',strtotime('-1 days', strtotime(date('Y-m-d')))),
            'email'=>'profesor2@gmail.com',
            'password'=>Hash::make('123456'),
            'uniqid'=>uniqid('',true)
          ]);
          RoleUser::create([
            'user_id' =>$user6->id,
            'role_id' =>$rol2->id
          ]);

          Precio::create([
            'valor'=>50000,
            'fecha_creacion'=>date('Y-m-d'),
            'user_id'=>$user1->id
          ]);
    }
}
