<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function index(Request $peticion) {
        $arreglo = ['nombre' => $peticion->query('nombre','NN')];
        return view('welcome')->with($arreglo);
        //return view('welcome');
    }
}
