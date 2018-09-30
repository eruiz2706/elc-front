<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use DB;

class PrincipalController extends Controller
{

    function index(){
      $user =Auth::user();
      $rol  =DB::select("select
                          r.slug
                          from roles r
                          left join role_user ru on(r.id=ru.role_id)
                          where user_id = :user_id"
                       ,['user_id'=>$user->id])[0];
      if($rol->slug=='ad'){
        return redirect('foro');
      }else if($rol->slug=='es'){
        return redirect('es/inicio');
      }else if($rol->slug=='pr'){
         return redirect('foro');
       }else if($rol->slug=='in'){
         return redirect('foro');
       }else if($rol->slug=='pa'){
         return redirect('foro');
       }else{
         return redirect('login');
       }
    }
}
