<?php

namespace App\Http\Controllers;

use App\Http\Requests\TiposCultivoRequest;
use App\Models\TiposCultivo;
use Illuminate\Http\Request;

class TiposCultivoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tiposCultivos=TiposCultivo::all();
        return view('TiposCultivos.index',compact('tiposCultivos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('TiposCultivos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TiposCultivoRequest $request)
    {
        TiposCultivo::create($request->all());
        return redirect()->route('TiposCultivos.index')->with('success','Tipos Cultivo Creado Correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(TiposCultivo $tiposCultivo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tiposCultivo=TiposCultivo::findorfail($id);
        return view('TiposCultivos.edit',compact('tiposCultivo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TiposCultivoRequest $request,$id)
    {
        $tiposCultivo=TiposCultivo::findorfail($id);
        $tiposCultivo->update($request->all());
        return redirect()->route('TiposCultivos.index')->with('success','Tipos Cultivo Actualizado Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tiposCultivo=TiposCultivo::findorfail($id);
        $tiposCultivo->delete();
        return redirect()->route('TiposCultivos.index')->with('success','Tipos Cultivo Eliminado Correctamente');
    }
}
