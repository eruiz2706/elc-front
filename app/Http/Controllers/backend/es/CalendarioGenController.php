<?php

namespace App\Http\Controllers\backend\es;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CalendarioGenController extends Controller
{
  public function index(Request $request){
    return view('backend.es.calendarioG.index');
  }
}
