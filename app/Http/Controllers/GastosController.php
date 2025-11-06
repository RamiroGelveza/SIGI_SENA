<?php

namespace App\Http\Controllers;

use App\Http\Requests\GastosRequest;
use App\Http\Requests\IngresoRequest;
use App\Models\CategoriaGasto;
use App\Models\Cosecha;
use App\Models\Gastos;
use Illuminate\Http\Request;

class GastosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($idcosecha)
    {
        $gastos=Gastos::where('idCosecha', $idcosecha)->get();
        $idcosecha=$idcosecha;
        return view('Gastos.index',compact('gastos','idcosecha'));
    }

    
    public function create($idcosecha)
    {
        $cosechas = Cosecha::where('id', $idcosecha)->get();
        $categoriaGastos = CategoriaGasto::all();
        return view('Gastos.create', compact('cosechas', 'categoriaGastos'));
    }

    /**
     * Guarda un nuevo gasto en la base de datos.
     */
    public function store(GastosRequest $request)
    {
        Gastos::create($request->all());
        $idcosecha = $request->input('idCosecha');

        return redirect()->route('Gastos.index', ['idcosecha' => $idcosecha])
            ->with('success', 'Gasto creado correctamente');
    }

    /**
     * Muestra un gasto específico (opcional).
     */
    public function show(Gastos $gasto)
    {
        //
    }

    /**
     * Muestra el formulario para editar un gasto existente.
     */
    public function edit($id)
    {
        $gasto = Gastos::findOrFail($id);
        $cosechas = Cosecha::all();
        $categoriaGastos = CategoriaGasto::all();
        return view('Gastos.edit', compact('gasto', 'cosechas', 'categoriaGastos'));
    }

    /**
     * Actualiza un gasto existente.
     */
    public function update(GastosRequest $request, $id)
    {
        $gasto = Gastos::findOrFail($id);
        $gasto->update($request->all());
        $idcosecha = $request->input('idCosecha');

        return redirect()->route('Gastos.index', ['idcosecha' => $idcosecha])
            ->with('success', 'Gasto actualizado correctamente');
    }

    /**
     * Elimina un gasto.
     */
    public function destroy($id)
    {
        $gasto = Gastos::findOrFail($id);
        $idcosecha = $gasto->idCosecha;
        $gasto->delete();

        return redirect()->route('Gastos.index', ['idcosecha' => $idcosecha])
            ->with('success', 'Gasto eliminado correctamente');
    }
}
