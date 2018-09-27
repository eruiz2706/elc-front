<?php

namespace App\Http\Controllers\backend\ad;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InicioController extends Controller
{
    public function index(){
      return view('backend.ad.inicio.index');
    }
}
