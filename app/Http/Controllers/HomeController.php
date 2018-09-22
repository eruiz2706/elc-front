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

       if($rol->slug=='estudiante'){
        return redirect('es/inicio');
       }else if($rol->slug=='profesor'){
         return redirect('pr/inicio');
       }else if($rol->slug=='instituto'){
         return redirect('in/inicio');
       }else if($rol->slug=='pariente'){
         return redirect('pa/inicio');
       }else{

       }
    }
}
