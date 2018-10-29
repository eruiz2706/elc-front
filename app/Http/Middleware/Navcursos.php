<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use DB;
use Session;

class Navcursos
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $rol  =Session::get('rol');
        Session::put('navcursos','');
        if(in_array($rol,['pr','es'])){
          $user    =Auth::user();
          $cursos  =DB::select("select
                                  c.id,c.nombre
                                  from cursos_user cu
                                  left join cursos c on(cu.curso_id=c.id)
                                  where cu.user_id = :user_id
                                  order by cu.fecha_creacion desc"
                             ,['user_id'=>$user->id]);
          Session::put('navcursos',$cursos);
        }

        return $next($request);
    }
}
