<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvernaderoRequest;
use App\Models\finca;
use App\Models\Invernadero;
use Illuminate\Http\Request;

class InvernaderoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invernaderos=Invernadero::all();
        return view('Invernaderos.index', compact('invernaderos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $fincas=finca::all();
        return view('Invernaderos.create', compact('fincas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InvernaderoRequest $request)
    {
        Invernadero::create($request->all());
        return redirect()->route('Invernaderos.index')->with('success','Invernadero Creado Correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Invernadero $invernadero)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $invernadero=Invernadero::findorfail($id);
        $fincas=finca::all();
        return view('Invernaderos.edit',compact('invernadero','fincas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $invernadero=Invernadero::findorfail($id);
        $invernadero->update($request->all());
        return redirect()->route('Invernaderos.index')->with('success','Invernadero Actualizado Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $invernadero=Invernadero::findorfail($id);
        $invernadero->delete();
        return redirect()->route('Invernaderos.index')->with('success','Invernadero Eliminado correctamente');
    }
}
