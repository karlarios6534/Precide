<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Patient;
use App\Models\Record;
use Carbon\Carbon;

class DashController extends Controller
{
    public function index()
    {
        $pacientes = Patient::all();
        $medicos = User::all();
        $records = Record::all();
        
        $totalPacientes = Patient::count();

// Número de pacientes registrados esta semana
        $inicioSemana = Carbon::now()->startOfWeek();
        $finSemana = Carbon::now()->endOfWeek();
        $recordsRegistradosSemana = Record::whereBetween('created_at', [$inicioSemana, $finSemana])->count();

        // Obtener datos para los gráficos
        $pacientesData = [
            'labels' => $pacientes->pluck('name')->toArray(),
            'values' => []
        ];
        
        $medicosData = [
            'labels' => $medicos->pluck('name')->toArray(),
            'values' => []
        ];

        $recordsData = [
            'labels' => $records->pluck('date')->toArray(),
            'values' => []
        ];
        
        foreach ($pacientesData['labels'] as $label) {
            $paciente = $pacientes->where('name', $label)->first();
            $pacientesData['values'][] = $records->where('patient_id', $paciente->id)->count();
        }
        
        foreach ($medicosData['labels'] as $label) {
            $medico = $medicos->where('name', $label)->first();
            $medicosData['values'][] = $records->where('user_id', $medico->id)->count();
        }

        foreach ($recordsData['labels'] as $label) {
            $recordsData['values'][] = $records->where('date', $label)->count();
        }      

        $prediccionesData = [
            'labels' => ['Benigno', 'Maligno'],
            'values' => [
                $records->where('prediccion', 'Benigno')->count(),
                $records->where('prediccion', 'Maligno')->count()
            ]
        ];
        
    
        return view('dashboard', compact('pacientesData', 'medicosData', 'prediccionesData', 'recordsData', 'totalPacientes', 'recordsRegistradosSemana'));
    }
    
}

