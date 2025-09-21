<?php

namespace App\Http\Controllers;

use App\Models\Cosecha;
use App\Models\Ingreso;
use Illuminate\Http\Request;

class IngresoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ingresos=Ingreso::all();
        return view('Ingresos.index',compact('ingresos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cosechas=Cosecha::all();
        return view('Ingresos.create',compact('cosechas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Ingreso::create($request->all());
        return redirect()->route('Ingresos.index')->with('success','Ingreso Creado correctamente');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Ingreso $ingreso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $ingresos=Ingreso::findorfail($id);
        $cosechas = Cosecha::all();
        return view('Ingresos.edit', compact('ingresos','cosechas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $ingresos=Ingreso::findorfail($id);
        $ingresos->update($request->all());
        return redirect()->route('Ingresos.index')->with('success','Ingreso Actualizado correctamente');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ingresos=Ingreso::findorfail($id);
        $ingresos->delete();
        return redirect()->route('Ingresos.index')->with('success','Ingreso Eliminado correctamente');
    }
}
