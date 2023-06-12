<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
use Http;

class PredictController extends Controller
{
    public function index(){

        $elements = [
            [
              "Radio Promedio" => "Promedio de los radios de las células en el núcleo de la masa mamaria.",
              "Radio SE" => "Error estándar.",
              "Radio Worst" => "Valor más grande encontrado."
            ],
            [
              "Textura Promedio" => "Desviación estándar de los valores de la escala de grises en la imagen de la masa mamaria.",
              "Textura SE" => "Error estándar.",
              "Textura Worst" => "Valor más grande encontrado."
            ],
            [
              "Perímetro Promedio" => " Perímetro promedio de las células en el núcleo de la masa mamaria.",
              "Perímetro SE" => "Error estándar.",
              "Perímetro Worst" => "Valor más grande encontrado."
            ],
            [
              "Área Promedio" => "Área promedio de las células en el núcleo de la masa mamaria.",
              "Área SE" => "Error estándar.",
              "Área Worst" => "Valor más grande encontrado."
            ],
            [
              "Suavidad Promedio" => "Variación local en las longitudes de los radios de las células en el núcleo de la masa mamaria.",
              "Suavidad SE" => "Error estándar.",
              "Suavidad Worst" => "Valor más grande encontrado."
            ],
            [
              "Compacidad Promedio" => "Perímetro al cuadrado dividido por el área menos 1.0.",
              "Compacidad SE" => "Error estándar.",
              "Compacidad Worst" => "Valor más grande encontrado."
            ],
            [
              "Concavidad Promedio" => "Severidad de las porciones cóncavas del contorno del núcleo de la masa mamaria.",
              "Concavidad SE" => "Error estándar.",
              "Concavidad Worst" => "Valor más grande encontrado."
            ],
            [
              "Puntos Cóncavos Promedio" => "Número de porciones cóncavas del contorno del núcleo de la masa mamaria.",
              "Puntos Cóncavos SE" => "Error estándar.",
              "Puntos Cóncavos Worst" => "Valor más grande encontrado."
            ],
            [
              "Simetría Promedio" => "Simetría del contorno del núcleo de la masa mamaria.",
              "Simetría SE" => "Error estándar.",
              "Simetría Worst" => "Valor más grande encontrado."
            ],
            [
              "Dimensión Fractal Promedio" => "Dimensión fractal 'coastline approximation' del contorno del núcleo de la masa mamaria.",
              "Dimensión Fractal SE" => "Error estándar.",
              "Dimensión Fractal Worst" => "Valor más grande encontrado."
            ]
          ];
                 
        return view('predictmodule/predictmodule', ['elements' => $elements]);
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

    public function register(Request $request1)
    {
        // Obtener todos los datos enviados desde el formulario
        $jsonData = $request1->all();
        $jsonString = json_encode($jsonData );// Obtener el JSON completo como un array
        $jsonString = json_decode($jsonString);

        // Acceder a los valores del objeto JSON
        $resultado = $jsonString->resultado;
        $porcentaje = $jsonString->porcentaje;

        $patients= Patient::all();

        return view('predictmodule/predictmodule_register',['resultado' => $resultado, 'porcentaje' => $porcentaje, 'patients' => $patients]);
    }

}
