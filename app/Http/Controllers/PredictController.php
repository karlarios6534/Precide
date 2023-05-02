<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Http;

class PredictController extends Controller
{
    public function index(){
        $respuesta = Http::get('http://localhost:8001/hola/karla');
        $result = $respuesta->json();
        return view('predictmodule/predictmodule', compact('result'));
    }

}
