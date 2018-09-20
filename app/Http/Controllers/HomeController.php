<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $user = Auth::user();
      $rol  =DB::select("select
                          r.slug
                          from roles r
                          left join role_user ru on(r.id=ru.role_id)
                          where user_id = :user_id"
                       ,['user_id'=>$user->id])[0];

       if($rol->slug=='study'){
         return redirect('st/inicio');
       }else if($rol->slug=='teacher'){
         return redirect('te/inicio');
       }else if($rol->slug=='institution'){
         return redirect('in/inicio');
       }else if($rol->slug=='family'){
         return redirect('fa/inicio');
       }else{

       }
    }
}
