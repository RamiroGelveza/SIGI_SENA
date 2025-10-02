<?php

namespace App\Http\Controllers;

use App\Http\Requests\EstadosCosechaRequest;
use App\Models\EstadosCosecha;
use Illuminate\Http\Request;

class EstadosCosechaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $estadosCosecha=EstadosCosecha::all();
        return view('EstadosCosecha.index',compact('estadosCosecha'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('EstadosCosecha.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EstadosCosechaRequest $request)
    {
        EstadosCosecha::create($request->all());
        return redirect()->route('EstadosCosecha.index')->with('success','Estado de Cosecha Creado Correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(EstadosCosecha $estadosCosecha)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $estadosCosecha=EstadosCosecha::findorfail($id);
        return view('EstadosCosecha.edit',compact('estadosCosecha'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EstadosCosechaRequest $request, $id)
    {
        $estadosCosecha=EstadosCosecha::findorfail($id);
        $estadosCosecha->update($request->all());
        return redirect()->route('EstadosCosecha.index')->with('success','Estado de Cosecha Actualizado Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $estadosCosecha=EstadosCosecha::findorfail($id);
        $estadosCosecha->delete();
        return redirect()->route('EstadosCosecha.index')->with('success','Estado de Cosecha Eliminado Correctamente');
        
    }
}
