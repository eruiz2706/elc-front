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
              'slug'=>'estudiante',
              'special'=>'all-access'
            ]);
          $rol2=Role::create([
            'name' =>'Profesor',
            'slug'=>'profesor',
            'special'=>'all-access'
          ]);

          $rol3=Role::create([
            'name' =>'Institucion',
            'slug'=>'instituto',
            'special'=>'all-access'
          ]);
          $rol4=Role::create([
            'name' =>'Padres de familia',
            'slug'=>'pariente',
            'special'=>'all-access'
          ]);

          /*USUARIO */
          $user1=User::create([
            'nombre' =>'Estudiante',
            'fecha_vencimiento'=>date('Y-m-d',strtotime('-1 days', strtotime(date('Y-m-d')))),
            'email'=>'estudiante@gmail.com',
            'password'=>Hash::make('123456')
          ]);
          RoleUser::create([
            'user_id' =>$user1->id,
            'role_id' =>$rol1->id
          ]);

          $user2=User::create([
            'nombre' =>'Profesor',
            'fecha_vencimiento'=>date('Y-m-d',strtotime('-1 days', strtotime(date('Y-m-d')))),
            'email'=>'profesor@gmail.com',
            'password'=>Hash::make('123456')
          ]);
          RoleUser::create([
            'user_id' =>$user2->id,
            'role_id' =>$rol2->id
          ]);

          $user3=User::create([
            'nombre' =>'Institucion',
            'fecha_vencimiento'=>date('Y-m-d',strtotime('-1 days', strtotime(date('Y-m-d')))),
            'email'=>'institucion@gmail.com',
            'password'=>Hash::make('123456')
          ]);
          RoleUser::create([
            'user_id' =>$user3->id,
            'role_id' =>$rol3->id
          ]);

          $user4=User::create([
            'nombre' =>'Padres',
            'fecha_vencimiento'=>date('Y-m-d',strtotime('-1 days', strtotime(date('Y-m-d')))),
            'email'=>'padres@gmail.com',
            'password'=>Hash::make('123456')
          ]);
          RoleUser::create([
            'user_id' =>$user4->id,
            'role_id' =>$rol4->id
          ]);

          Precio::create([
            'valor'=>50000
          ]);
    }
}
