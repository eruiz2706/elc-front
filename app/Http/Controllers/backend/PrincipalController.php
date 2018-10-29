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
      $user =Auth::user();

      //se consulta el rol al que esta asociado el usuario
      $rol  =DB::select("select r.slug
                          from roles r
                          left join role_user ru on(r.id=ru.role_id)
                          where user_id = :user_id"
                       ,['user_id'=>$user->id]);
      if(!empty($rol)){
        $rol  =$rol[0];
        if($rol->slug !=''){
          Session::put('rol',$rol->slug);
          return redirect('foro');
        }
      }

      return redirect()->to('/noaccess');
    }

    function manual(){
      return view('backend/modulos/manual/index');
    }
}
