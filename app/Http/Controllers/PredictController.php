<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
use Http;

class PredictController extends Controller
{
    public function index(){
        $patients= Patient::all();

        $elements = $arrayTraducido = array(
            "Radio Promedio" => "media de las distancias desde el centro a los puntos en el perímetro",
            "Textura Promedio" => "desviación estándar de los valores de escala de grises",
            "Perímetro Promedio" => "",
            "Área Promedio" => "",
            "Suavidad Promedio" => "variación local en las longitudes de los radios",
            "Compacidad Promedio" => "perímetro^2 / área - 1.0",
            "Concavidad Promedio" => "gravedad de las porciones cóncavas del contorno",
            "Puntos Cóncavos Promedio" => "número de porciones cóncavas del contorno",
            "Simetría Promedio" => "",
            "Dimensión Fractal Promedio" => "aproximación de la línea costera - 1",
            "Radio SE" => "",
            "Textura SE" => "",
            "Perímetro SE" => "",
            "Área SE" => "",
            "Suavidad SE" => "",
            "Compacidad SE" => "",
            "Concavidad SE" => "",
            "Puntos Cóncavos SE" => "",
            "Simetría SE" => "",
            "Dimensión Fractal SE" => "",
            "Radio Peor" => "",
            "Textura Peor" => "",
            "Perímetro Peor" => "",
            "Área Peor" => "",
            "Suavidad Peor" => "",
            "Compacidad Peor" => "",
            "Concavidad Peor" => "",
            "Puntos Cóncavos Peor" => "",
            "Simetría Peor" => "",
            "Dimensión Fractal Peor" => ""
        );        
        return view('predictmodule/predictmodule', ['elements' => $elements, 'patients'=> $patients]);
    }

    public function request(Request $request)
    {
        // Obtener todos los datos enviados desde el formulario
        $jsonData = $request->all(); // Obtener el JSON completo como un array

        $values = array_values($jsonData); // Obtener solo los valores del array
        array_shift($values); // Eliminar el primer valor del array

        $valuesString = implode(',', $values); // Concatenar los valores con comas
        
        $response = Http::get("http://localhost:8001/{{$valuesString}}");
        // Hacer algo con la cadena de valores concatenados
        // ...
        
        // Devolver una respuesta
        return view('predictmodule/predictmodule_res')->with('result', $response);
    }

}
