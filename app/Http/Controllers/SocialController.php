<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Validator;
use Socialite;
use Auth;
use App\User;
use DB;

class SocialController extends Controller
{
    public function redirect($provider,$type='',$modo=''){

      session(['f_type' =>$type]);
      session(['f_modo' =>$modo]);
      return Socialite::driver($provider)->redirect();
    }

    public function callback($provider){
      $social_user =Socialite::driver($provider)->user();
      //echo $user->getId()."\r\n";
      //echo $user->getAvatar()."\r\n";

      $type=session('f_type');

      if($type=='registro'){
          if ($user = User::where('email', $social_user->email)->first()) {
              return $this->authAndRedirect($user); // Login y redirección
          } else {
              $modo=session('f_modo');

              $role  =DB::select("select id,slug from roles
                                  where slug = :slug"
                                 ,['slug'=>$modo]);

              if(!empty($role)){
                $user = User::create([
                    'nombre' => $social_user->name,
                    'email' => $social_user->email,
                    'password'=>Hash::make(substr( md5(microtime()), 1, 8)),
                    'uniqid'=>uniqid('',true),
                    'slugrol'=>$role[0]->slug,
                ]);

                DB::table('role_user')->insert([
                  'user_id' =>$user->id,
                  'role_id' =>$role[0]->id
                ]);

                return $this->authAndRedirect($user);
              }

              return redirect()->to('principal#');
          }
      }else{
        if ($user = User::where('email', $social_user->email)->first()) {
          return $this->authAndRedirect($user); // Login y redirección
        }
        return redirect()->to('noregister#');
      }

    }

    // Login y redirección
    public function authAndRedirect($user){
        Auth::login($user);
        return redirect()->to('principal#');
    }
}
