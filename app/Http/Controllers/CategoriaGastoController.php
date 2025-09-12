<?php

namespace App\Http\Controllers;

use App\Models\CategoriaGasto;
use Illuminate\Http\Request;

class CategoriaGastoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $categoriaGastos=CategoriaGasto::all();
        return view('categoriaGastos.index',compact('categoriaGastos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categoriaGastos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        CategoriaGasto::create($request->all());
        return redirect()->route('CategoriaGastos.index')->with('success','Categoria de Gastos Creada Correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(CategoriaGasto $categoriaGasto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $categoriaGasto=CategoriaGasto::findorfail($id);
        return view('categoriaGastos.edit',compact('categoriaGasto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $categoriaGasto=CategoriaGasto::findorfail($id);
        $categoriaGasto->update($request->all());
        return redirect()->route('CategoriaGastos.index')->with('success','Categoria de Gastos Actualizada Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $categoriaGasto=CategoriaGasto::findorfail($id);
        $categoriaGasto->delete();
        return redirect()->route('CategoriaGastos.create')->with('success','Categoria de Gastos Eliminada Correctamente');
    }
}
