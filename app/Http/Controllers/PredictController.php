<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Http;

class PredictController extends Controller
{
    public function index(){
        $elements = ["Radius Mean", "Texture Mean", "Perimeter Mean", "Area Mean", "Smoothness Mean",
            "Compactness Mean", "Concavity Mean", "Concave Points Mean", "Symmetry Mean",
            "Fractal Dimension Mean", "Radius SE", "Texture SE", "Perimeter SE", "Area SE", "Smoothness SE",
            "Compactness SE", "Concavity SE", "Concave Points SE", "Symmetry SE", "Fractal Dimension SE",
            "Radius Worst", "Texture Worst", "Perimeter Worst", "Area Worst", "Smoothness Worst",
            "Compactness Worst", "Concavity Worst", "Concave Points Worst", "Symmetry Worst",
            "Fractal Dimension Worst"];
        return view('predictmodule/predictmodule', ['elements' => $elements]);
    }

    public function request(Request $request){
        $respuesta = $request->input('values');
        
        return($respuesta);
    }

}
