<?php

namespace App\Http\Controllers;

use App\Http\Requests\CosechaRequest;
use App\Models\Cosecha;
use App\Models\EstadosCosecha;
use App\Models\Gastos;
use App\Models\Ingreso;
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
        $cosechas = Cosecha::where('idInvernadero',$idinvernadero)->get();
        $idinvernadero=$idinvernadero;
        return view('Cosechas.index', compact('cosechas','idinvernadero'));
    }

    public function create($idinvernadero)
    {
        $invernaderos = Invernadero::where('id',$idinvernadero)->get();
        $cultivos=TiposCultivo::all();
        $estados=EstadosCosecha::all();
        return view('Cosechas.create', compact('invernaderos','cultivos','estados'));
    }

public function store(CosechaRequest $request)
{
    $cosecha = Cosecha::create($request->all());
    $idinvernadero = $request->input('idInvernadero');

    return redirect()
        ->route('Cosechas.index', ['idinvernadero' => $idinvernadero])
        ->with('success', 'Cosecha Creada Correctamente');
}



    public function edit($id)
    {
        $cosecha = Cosecha::findOrFail($id);
        $cultivos=TiposCultivo::all();
        $estados=EstadosCosecha::all();
        $invernaderos=Invernadero::all();
        return view('Cosechas.edit', compact('cosecha','invernaderos','cultivos','estados'));
    }

    public function update(CosechaRequest $request, $id)
    {
        $cosecha = Cosecha::findOrFail($id);
        $cosecha->update($request->all());
      $idinvernadero = $request->input('idInvernadero');

        return redirect()->route('Cosechas.index',['idinvernadero' => $idinvernadero])
            ->with('success','Cosecha Actualizada Correctamente');
    }

    public function destroy($id)
    {
        $cosecha = Cosecha::findOrFail($id);
        $cosecha->delete();
        return redirect()->route('Cosechas.index')->with('success','Cosecha Eliminada Correctamente');
    }
    // public function administrar(){
    //     return view('Cosechas.administrar');
        
    // }
public function administrarCosecha($id)
{
    $cosecha = Cosecha::with(['invernadero', 'tiposCultivo', 'estadosCosecha'])->findOrFail($id);
    $ingresos = Ingreso::where('idCosecha', $id)->get();
    $gastos = Gastos::where('idCosecha', $id)->get(); 

    // ✅ Calcular totales (CORREGIDO PARA INGRESOS)
    $totalIngresos = $ingresos->sum(function ($ingreso) {
        return (float) $ingreso->cantidadVendida * (float) $ingreso->precioUnitario;
    });

    $totalGastos = $gastos->sum('monto');
    
    // 3. Calcular la Utilidad
    $utilidad = $totalIngresos - $totalGastos;

    return view('Cosechas.administrar', compact('cosecha', 'ingresos', 'gastos', 'totalIngresos', 'totalGastos', 'utilidad'));
}

}

