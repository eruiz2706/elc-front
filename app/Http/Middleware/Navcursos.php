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
        $user =Auth::user();
        $rol  =Session::get('rol');
        Session::put('navcursos','');

        DB::table('users')->where('id',$user->id)->update([
          'fecha_ultimo_uso'=>date('Y-m-d H:i:s')
        ]);

        $user_uso=DB::select("select
                                round(extract(epoch from age(fecha_ultimo_uso,fecha_ultimo_ingreso))/60) as tiempo
                              from users
                              where id = :user_id"
                           ,['user_id'=>$user->id])[0];
        Session::put('user_tiempo',$user_uso->tiempo);


        if(in_array($rol,['pr','es'])){
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
