<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Socialite;
use Auth;
use App\User;
use DB;

class SocialController extends Controller
{
    public function redirect(){
      return Socialite::driver('facebook')->redirect();
    }

    public function callback(){
      $social_user =Socialite::driver('facebook')->user();
      //echo $user->getId()."\r\n";
      //echo $user->getAvatar()."\r\n";
      if ($user = User::where('email', $social_user->email)->first()) {
            return $this->authAndRedirect($user); // Login y redirección
        } else {
            // En caso de que no exista creamos un nuevo usuario con sus datos.
            $rol  =DB::select("select id from roles
                                where slug = :slug"
                               ,['slug'=>'es']);

            $user = User::create([
                'nombre' => $social_user->name,
                'email' => $social_user->email,
                'avatar' => $social_user->avatar,
            ]);

            DB::table('role_user')->insert([
              'user_id' =>$user->id,
              'role_id' =>$rol[0]->id
            ]);

            return $this->authAndRedirect($user); // Login y redirección
        }
    }

    // Login y redirección
    public function authAndRedirect($user){
        Auth::login($user);
        return redirect()->to('principal#');
    }
}
