<?php

namespace App\Http\Controllers\backend\modulos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use DB;
use Validator;
use Log;

class AdministracionController extends Controller
{
  public function view_index(){
    $user =Auth::user();
    $rol  =$user->slugrol;
    if($rol !='ad'){
      return view('layouts.errors.access_denied');
    }
    return view('backend.modulos.administracion.view_index');
  }
}
