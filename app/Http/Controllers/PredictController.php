<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Http;

class PredictController extends Controller
{
    public function index(){

        $elements = array("Radius Mean"=>"mean of distances from center to points on the perimete",
        "Texture Mean"=>"standard deviation of gray-scale values",
        "Perimeter Mean"=>"",
        "Area Mean"=>"",
        "Smoothness Mean"=>"local variation in radius lengths",
        "Compactness Mean"=>"erimeter^2 / area - 1.0",
        "Concavity Mean"=>"severity of concave portions of the contour",
        "Concave Points Mean"=>"number of concave portions of the contour",
        "Symmetry Mean"=>"",
        "Fractal Dimension Mean" =>"coastline approximation - 1",
        "Radius SE"=>"",
        "Texture SE"=>"",
        "Perimeter SE"=>"",
        "Area SE"=>"",
        "Smoothness SE"=>"",
        "Compactness SE"=>"", 
        "Concavity SE"=>"",
        "Concave Points SE"=>"",
        "Symmetry SE"=>"",
        "Fractal Dimension SE"=>"",
        "Radius Worst"=>"",
        "Texture Worst"=>"",
        "Perimeter Worst"=>"",
        "Area Worst"=>"",
        "Smoothness Worst"=>"",
        "Compactness Worst"=>"",
        "Concavity Worst"=>"",
        "Concave Points Worst"=>"",
        "Symmetry Worst"=>"",
        "Fractal Dimension Worst"=>"");
        return view('predictmodule/predictmodule', ['elements' => $elements]);
    }

    public function request(Request $request)
    {
        // Obtener todos los datos enviados desde el formulario
        $jsonData = $request->all(); // Obtener el JSON completo como un array

        $values = array_values($jsonData); // Obtener solo los valores del array
        array_shift($values); // Eliminar el primer valor del array

        //evaluar que no haya datos null
        $containsNull = false;
        foreach ($values as $value) {
            if ($value === null) {
                $containsNull = true;
                break;
            }
        }

        if ($containsNull) {
            echo 'El JSON contiene valores nulos.';
        } else {
            echo 'El JSON no contiene valores nulos.';
        }



        $valuesString = implode(',', $values); // Concatenar los valores con comas
        
        $response = Http::get("http://localhost:8001/{{$valuesString}}");
        // Hacer algo con la cadena de valores concatenados
        // ...
        
        // Devolver una respuesta
        return view('predictmodule/predictmodule_res')->with('result', $response);
    }

}
