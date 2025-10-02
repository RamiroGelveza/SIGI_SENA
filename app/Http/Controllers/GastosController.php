<?php

namespace App\Http\Controllers;

use App\Http\Requests\GastosRequest;
use App\Models\CategoriaGasto;
use App\Models\Cosecha;
use App\Models\Gastos;
use Illuminate\Http\Request;

class GastosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gastos=Gastos::all();
        return view('Gastos.index',compact('gastos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cosechas=Cosecha::all();
        $categoriaGastos=CategoriaGasto::all();
        return view('Gastos.create',compact('cosechas','categoriaGastos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GastosRequest $request)
    {
        Gastos::create($request->all());
        return redirect()->route('Gastos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gastos $gastos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $gastos=Gastos::findorfail($id);
        $cosechas=Cosecha::all();
        $categoriaGastos=CategoriaGasto::all();
        return view('Gastos.edit',compact('gastos','cosechas','categoriaGastos'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GastosRequest $request,$id)
    {
        $gastos=Gastos::findorfail($id);
        $gastos->update($request->all());
        return redirect()->route('Gastos.index');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $gastos=Gastos::findorfail($id);
        $gastos->delete();
        return redirect()->route('Gastos.index');
        
    }
}
