<?php

namespace App\Http\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Record;
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
        
        $response = Http::timeout(300)->withoutVerifying()->get("https://precide.onrender.com/" . $valuesString);

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

      $startOfWeek = now()->startOfWeek(); // Obtener el inicio de la semana actual
      $endOfWeek = now()->endOfWeek(); // Obtener el final de la semana actual
      
      $records = Record::with('patient','user')->get();
      
      
        // Dividir el string en un array utilizando la coma como delimitador
        $arrayValores = explode(',', $values);

        // Crear una instancia del objeto Spreadsheet
        $spreadsheet = new Spreadsheet();

        // Obtener la hoja activa
        $sheet = $spreadsheet->getActiveSheet();

        // Guardar cada valor en una celda separada
        for ($i = 0; $i < count($arrayValores); $i++) {
            // Acceder a cada valor individualmente
            $valor = $arrayValores[$i];
            
            // Establecer el valor en la celda correspondiente
            $sheet->setCellValueByColumnAndRow($i + 1, 1, $valor);
        }

        $rutaExcel = public_path('excel');

        // Crear el directorio "public/excel" si no existe
        if (!file_exists($rutaExcel)) {
            mkdir($rutaExcel, 0755, true);
        }
        
        // Guardar el archivo Excel en la ruta especificada
        $archivoExcel = $rutaExcel . '/valores.xlsx';
        $writer = new Xlsx($spreadsheet);
        $writer->save($archivoExcel);

      // Filtrar los registros por fecha dentro del rango de la semana actual
      
      return view('records.index')->with('records', $records);
    }

}
