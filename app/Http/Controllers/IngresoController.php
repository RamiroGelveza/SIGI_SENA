<?php

namespace App\Http\Controllers;

use App\Http\Requests\IngresoRequest;
use App\Models\Cosecha;
use App\Models\Ingreso;
use Illuminate\Http\Request;

class IngresoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 public function index($idcosecha)
{
    $ingresos = Ingreso::where('idCosecha', $idcosecha)->get();
    $cosecha = \App\Models\Cosecha::find($idcosecha); // ✅ se obtiene la cosecha
    return view('Ingresos.index', compact('ingresos', 'idcosecha', 'cosecha'));
}



    /**
     * Show the form for creating a new resource.
     */
   public function create($idcosecha)
    {
        $cosechas = Cosecha::where('id', $idcosecha)->get();
        return view('Ingresos.create', compact('cosechas'));
    }

    /**
     * Guarda un nuevo ingreso en la base de datos.
     */
    public function store(IngresoRequest $request)
    {
        Ingreso::create($request->all());
        $idcosecha = $request->input('idCosecha');

        return redirect()->route('administrar', ['id' => $idcosecha])
            ->with('success', 'Ingreso creado correctamente');
    }

    /**
     * Muestra un ingreso específico (opcional).
     */
    public function show(Ingreso $ingreso)
    {
        //
    }

    /**
     * Muestra el formulario para editar un ingreso existente.
     */
public function edit($id)
{
    $ingresos = Ingreso::findOrFail($id);

    // 👇 solo traemos la cosecha asociada a este ingreso
    $cosechas = Cosecha::where('id', $ingresos->idCosecha)
        ->with('tiposCultivo') // si quieres mostrar el nombre del cultivo
        ->get();

    $idcosecha = $ingresos->idCosecha;

    return view('Ingresos.edit', compact('ingresos', 'cosechas', 'idcosecha'));
}
    /**
     * Actualiza un ingreso en la base de datos.
     */
   public function update(IngresoRequest $request, $id)
{
    $ingreso = Ingreso::findOrFail($id);
    $ingreso->update($request->all());

    $idcosecha = $ingreso->idCosecha; // 👈 tomamos el idCosecha del ingreso actualizado
        return redirect()->route('administrar', ['id' => $idcosecha])
        ->with('success', 'Ingreso actualizado correctamente');
}


    /**
     * Elimina un ingreso de la base de datos.
     */
    public function destroy($id)
    {
        $ingreso = Ingreso::findOrFail($id);
        $idcosecha = $ingreso->idCosecha;
        $ingreso->delete();

        return redirect()->route('administrar', ['id' => $idcosecha])
            ->with('success', 'Ingreso eliminado correctamente');
    }
}

