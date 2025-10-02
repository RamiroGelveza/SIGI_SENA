<?php

namespace App\Http\Controllers;

use App\Http\Requests\MantenimientoInvernaderoRequest;
use App\Models\Invernadero;
use App\Models\MantenimientoInvernadero;
use Illuminate\Http\Request;

class MantenimientoInvernaderoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mantenimientoInvernadero=MantenimientoInvernadero::all();
        return view('MantenimientoInvernadero.index',compact('mantenimientoInvernadero'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $invernaderos=Invernadero::all();
        return view('MantenimientoInvernadero.create',compact('invernaderos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MantenimientoInvernaderoRequest $request)
    {
        MantenimientoInvernadero::create($request->all());
        return redirect()->route('MantenimientoInverndero.index')->with('success','Mantenimiento Inverndero Creado Correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(MantenimientoInvernadero $mantenimientoInvernadero)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $mantenimiento=MantenimientoInvernadero::findorfail($id);
        $invernaderos=Invernadero::all();
        return view('MantenimientoInvernadero.edit',compact('mantenimiento','invernaderos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MantenimientoInvernaderoRequest $request, $id)
    {
        $mantenimientoInvernadero=MantenimientoInvernadero::findorfail($id);
        $mantenimientoInvernadero->update($request->all());
        return redirect()->route('MantenimientoInverndero.index')->with('success','Mantenimiento Inverndero Actualizado Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $mantenimientoInvernadero=MantenimientoInvernadero::findorfail($id);
        $mantenimientoInvernadero->delete();
        return redirect()->route('MantenimientoInverndero.index')->with('success','Mantenimiento Inverndero Eliminado Correctamente');

    }
}
