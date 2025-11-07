<?php

namespace App\Http\Controllers;

use App\Http\Requests\FincaRequest;
use App\Models\finca;
use Illuminate\Http\Request;

class FincaController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $fincas=finca::all();
        return view('Fincas.index',compact('fincas'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Fincas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FincaRequest $request)
    {
        finca::create($request->all());
        return redirect()->route('Fincas.index')->with('success','')->with('success','Finca Creada Correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(finca $finca)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $fincas=finca::findorfail($id);
        return view('Fincas.edit',compact('fincas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $fincas=finca::findorfail($id);
        $fincas->update($request->all());
        return redirect()->route('Fincas.index')->with('success','Finca Actualizada Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $fincas=finca::findorfail($id);
        try {
            $fincas->delete();
            return redirect()->route('Fincas.index')
                ->with('success', 'Contenido eliminado correctamente');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('Fincas.index')
                ->with('error', 'No se puede eliminar esta finca porque tiene Invernaderos asociadas.');
        }
        
    }
}
