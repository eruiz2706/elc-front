<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class StorageController extends Controller
{
    public function index($archivo){

      $public_path = public_path();
      $url =storage_path('app/public/' . $archivo);

      if (Storage::disk('public')->exists($archivo))
      {
        return response()->download($url);
      }
      //si no se encuentra lanzamos un error 404.
      abort(404);

    }
}
