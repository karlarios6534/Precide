<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Record;

class RecordController extends Controller
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
        $startOfWeek = now()->startOfWeek(); // Obtener el inicio de la semana actual
        $endOfWeek = now()->endOfWeek(); // Obtener el final de la semana actual
        
        $records = Record::with('patient', 'user')
            ->whereIn('id', function ($query) {
                $query->select(\DB::raw('MAX(id)'))
                    ->from('records')
                    ->groupBy('patient_id');
            })
            ->get();
        
        return view('records.index')->with('records', $records);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $record= Record::find($id);
        return view('records.edit')->with("record",$record);
    }

    public function details($id)
    {
        $records = Record::with('patient', 'user')
        ->where('patient_id', $id)->get();
    
        return view('records.details')->with('records', $records);
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
        $record = Record::find($id);
        $record->comentario = $request->get('comentario');
        $record->date = $request->get('fecha');

        $record->save();
        return redirect("/record");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $records = Record::where('patient_id', $id)->delete();
        return redirect("/record");
    }
    public function destroy_id($id)
    {
        $record = Record::find($id);
        $record->delete();
        return redirect("/record");
    }
}
