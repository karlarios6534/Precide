<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Value;
use App\Models\Record;
use Illuminate\Support\Facades\Redirect;
use GuzzleHttp\Exception\RequestException;
use Http;

class PredictController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Verificar la sesión antes de acceder a los métodos del controlador
    }
    
    public function index(){

      $elements = [
        [
            "Radio Promedio" => "Promedio de los radios de las células en el núcleo de la masa mamaria.",
            "Radio SE" => "Error estándar.",
            "Peor Radio" => "Valor más grande encontrado."
        ],
        [
            "Textura Promedio" => "Desviación estándar de los valores de la escala de grises en la imagen de la masa mamaria.",
            "Textura SE" => "Error estándar.",
            "Peor Textura" => "Valor más grande encontrado."
        ],
        [
            "Perímetro Promedio" => "Perímetro promedio de las células en el núcleo de la masa mamaria.",
            "Perímetro SE" => "Error estándar.",
            "Peor Perímetro" => "Valor más grande encontrado."
        ],
        [
            "Área Promedio" => "Área promedio de las células en el núcleo de la masa mamaria.",
            "Área SE" => "Error estándar.",
            "Peor Área" => "Valor más grande encontrado."
        ],
        [
            "Suavidad Promedio" => "Variación local en las longitudes de los radios de las células en el núcleo de la masa mamaria.",
            "Suavidad SE" => "Error estándar.",
            "Peor Suavidad" => "Valor más grande encontrado."
        ],
        [
            "Compacidad Promedio" => "Perímetro al cuadrado dividido por el área menos 1.0.",
            "Compacidad SE" => "Error estándar.",
            "Peor Compacidad" => "Valor más grande encontrado."
        ],
        [
            "Concavidad Promedio" => "Severidad de las porciones cóncavas del contorno del núcleo de la masa mamaria.",
            "Concavidad SE" => "Error estándar.",
            "Peor Concavidad" => "Valor más grande encontrado."
        ],
        [
            "Puntos Cóncavos Promedio" => "Número de porciones cóncavas del contorno del núcleo de la masa mamaria.",
            "Puntos Cóncavos SE" => "Error estándar.",
            "Peor Puntos Cóncavos" => "Valor más grande encontrado."
        ],
        [
            "Simetría Promedio" => "Simetría del contorno del núcleo de la masa mamaria.",
            "Simetría SE" => "Error estándar.",
            "Peor Simetría" => "Valor más grande encontrado."
        ],
        [
            "Dimensión Fractal Promedio" => "Dimensión fractal 'coastline approximation' del contorno del núcleo de la masa mamaria.",
            "Dimensión Fractal SE" => "Error estándar.",
            "Peor Dimensión Fractal" => "Valor más grande encontrado."
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
        
        try {
          $response = Http::timeout(120)->withoutVerifying()->get("https://precide.onrender.com/" . $valuesString);
          
        } catch (RequestException $e) {
            if ($e->getCode() === 0) {
                $error= 'Se ha producido un error de timeout. Por favor, inténtalo nuevamente.';
                return Redirect::back()->with('error', $error);
            } else {
                $error='Se ha producido un error. Por favor, inténtalo nuevamente.';
                return Redirect::back()->with('error', $error);
            }
        } catch (\Exception $e) {
          $error='Se ha producido un error. Por favor, inténtalo nuevamente.';
          return Redirect::back()->with('error', $error );
        }

        $values = $valuesString;
        return view('predictmodule/predictmodule_res')->with('result', $response)->with('values', $valuesString);
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
        $values = $jsonString->values;

        $patients= Patient::all();

        return view('predictmodule/predictmodule_register',['resultado' => $resultado, 'porcentaje' => $porcentaje, 'patients' => $patients, 'values' => $values]);
    }

    public function save(Request $request)
    {
      $record = new Record();
      $record->user_id = $request->get('user');
      $record->patient_id = $request->get('patient');
      $record->prediccion = $request->get('resultado');
      $record->veracidad = $request->get('porcentaje');
      $record->comentario = $request->get('comentario');
      $values = $request->get('values');
      $record->date = date('Y-m-d'); 

      $record->save();

      $dataArray = explode(",", trim($values));
      $id = $record->id;

      $variables = [
          'radius_mean',
          'radius_se',
          'radius_worst',
          'texture_mean',
          'texture_se',
          'texture_worst',
          'perimeter_mean',
          'perimeter_se',
          'perimeter_worst',
          'area_mean',
          'area_se',
          'area_worst',
          'smoothness_mean',
          'smoothness_se',
          'smoothness_worst',
          'compactness_mean',
          'compactness_se',
          'compactness_worst',
          'concavity_mean',
          'concavity_se',
          'concavity_worst',
          'concave points_mean',
          'concave points_se',
          'concave points_worst',
          'symmetry_mean',
          'symmetry_se',
          'symmetry_worst',
          'fractal_dimension_mean',
          'fractal_dimension_se',
          'fractal_dimension_worst'
      ];

      $value = new Value();
      $value->record_id = $id;
      $value->diagnosis = $request->get('resultado');

      foreach ($variables as $index => $variable) {
        if (isset($dataArray[$index])) {
            $value->{$variable} = $dataArray[$index];
        } else {
             $value->{$variable} = null;
        }
    }

      $value->save();
      $values= Value::all();
      $startOfWeek = now()->startOfWeek(); // Obtener el inicio de la semana actual
      $endOfWeek = now()->endOfWeek(); // Obtener el final de la semana actual
      
      $records = Record::with('patient', 'user')
          ->whereIn('id', function ($query) {
              $query->select(\DB::raw('MAX(id)'))
                  ->from('records')
                  ->groupBy('patient_id');
          })
          ->get();
        return view('records.index')->with([
          'records' => $records,
          'values' => $values
      ]);
    }

}
