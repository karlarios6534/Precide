<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Patient;
use App\Models\Record;

class DashController extends Controller
{
    public function index()
    {
        $usersData = [
            'labels' => [],
            'values' => []
        ];

        $patientsData = [
            'labels' => [],
            'values' => []
        ];
        $recordsData = [
            'labels' => [],
            'values' => []
        ];

        $users = User::all();
        $records = Record::all();
        foreach ($users as $user) {
            $usersData['labels'][] = $user->name;
            $usersData['values'][] = $user->name;
        }

        $patients = Patient::all();
        foreach ($patients as $patient) {
            $patientsData['labels'][] = $patient->name;
            $patientsData['values'][] = $patient->name;
        }

        return view('dashboard', compact('usersData', 'patientsData'));
    }
}

