<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;

class PrincipalController extends Controller
{

    function index(){
      Session::put('rol','');
      Session::put('navcursos','');
      Session::put('o_curso','');

      $id   =Auth::user()->id;
      $user =Auth::user();

      $rol  =DB::select("select
                          r.slug
                          from roles r
                          left join role_user ru on(r.id=ru.role_id)
                          where user_id = :user_id"
                       ,['user_id'=>$user->id]);

      if(!empty($rol)){
        $rol  =$rol[0];
        if($rol->slug !=''){
          $cursos  =DB::select("select
                                c.id,c.nombre
                                from cursos_user cu
                                left join cursos c on(cu.curso_id=c.id)
                                where cu.user_id = :user_id
                                order by cu.fecha_creacion desc"
                           ,['user_id'=>$id]);
          Session::put('navcursos',$cursos);
          Session::put('rol',$rol->slug);
          return redirect('foro');
        }
      }

      return redirect()->to('/');
    }
}
