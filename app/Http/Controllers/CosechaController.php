<?php

namespace App\Http\Controllers;

use App\Http\Requests\CosechaRequest;
use App\Models\Cosecha;
use App\Models\EstadosCosecha;
use App\Models\Invernadero;
use App\Models\TiposCultivo;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;

class CosechaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($idinvernadero)
    {
        $cosechas=Cosecha::where('invernadero_id',$idinvernadero)->get();
        return view('Cosechas.index',compact('cosechas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $invernaderos=Invernadero::all();
        $cultivos=TiposCultivo::all();
        $estados=EstadosCosecha::all();
        return view('Cosechas.create',compact('invernaderos','cultivos','estados'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CosechaRequest $request)
    {
        Cosecha::create($request->all());
        return redirect()->route('Cosechas.index')->with('success','Cosecha Creada Correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cosecha $cosecha)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $cosecha=Cosecha::findorfail($id);
        $invernaderos=Invernadero::all();
        $cultivos=TiposCultivo::all();
        $estados=EstadosCosecha::all();
        return view('Cosechas.edit',compact('cosecha','invernaderos','cultivos','estados'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CosechaRequest $request, $id)
    {
        $cosecha=Cosecha::findorfail($id);
        $cosecha->update($request->all());
        return redirect()->route('Cosechas.index')->with('success','Cosecha Actualizada Correctamente');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cosecha=Cosecha::findorfail($id);
        $cosecha->delete();
        return redirect()->route('Cosechas.index')->with('success','Cosecha Eliminada Correctamente');
    }
}
