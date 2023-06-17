<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;


class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
         $this->middleware('auth'); // Verificar la sesión antes de acceder a los métodos del controlador
    }

    public function index()
    {
        $patients= Patient::all();
        return view('patient.index')->with('patients',$patients);
    }

        
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('patient.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $patient = new Patient();
        $patient->code = $request->get('code');
        $patient->name = $request->get('name');
        $patient->birth_date = $request->get('birth_date');
        $patient->adress = $request->get('adress');
        $patient->phone = $request->get('phone');
        $patient->email = $request->get('email');
        $patient->emergency_contact = $request->get('emergency_contact');
        $patient->allergies = $request->get('allergies');

        $patient->save();
        return redirect("/patients");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $patient= Patient::find($id);
        return view('patient.edit')->with("patient",$patient);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $patient = Patient::find($id);
        $patient->code = $request->get('code');
        $patient->name = $request->get('name');
        $patient->birth_date = $request->get('birth_date');
        $patient->adress = $request->get('adress');
        $patient->phone = $request->get('phone');
        $patient->email = $request->get('email');
        $patient->emergency_contact = $request->get('emergency_contact');
        $patient->allergies = $request->get('allergies');

        $patient->save();
        return redirect("/patients");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patient = Patient::find($id);
        $patient->delete();
        return redirect("/patients");

    }
}
