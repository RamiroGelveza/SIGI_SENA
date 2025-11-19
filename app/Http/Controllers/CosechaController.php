<?php

namespace App\Http\Controllers;

use App\Http\Requests\CosechaRequest;
use App\Models\Cosecha;
use App\Models\EstadosCosecha;
use App\Models\Gastos;
use App\Models\Ingreso;
use App\Models\Invernadero;
use App\Models\TiposCultivo;
use Barryvdh\DomPDF\Facade\Pdf;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Carbon\Carbon; 

class CosechaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(Request $request, $idinvernadero)
{
    // 🔍 Filtros recibidos del formulario
    $search       = $request->get('search');
    $cultivoId    = $request->get('cultivo_id');
    $estado       = $request->get('estado');
    $fechaInicio  = $request->get('fecha_inicio');
    $fechaFin     = $request->get('fecha_fin');

    // 🧩 Consulta base
    $query = Cosecha::with(['tiposCultivo', 'invernadero'])
        ->where('idInvernadero', $idinvernadero);

    // 🔎 Filtro de búsqueda general
    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('nombre', 'LIKE', "%{$search}%")
              ->orWhere('descripcion', 'LIKE', "%{$search}%");
        });
    }

    // 🌱 Filtro por tipo de cultivo
    if ($cultivoId) {
        $query->where('idTipoCultivo', $cultivoId);
    }

    // 📅 Filtro por rango de fechas
    if ($fechaInicio && $fechaFin) {
        $query->whereBetween('fechaSiembra', [$fechaInicio, $fechaFin]);
    } elseif ($fechaInicio) {
        $query->whereDate('fechaSiembra', '>=', $fechaInicio);
    } elseif ($fechaFin) {
        $query->whereDate('fechaSiembra', '<=', $fechaFin);
    }

    // ⚙️ Estado (opcional)
    if ($estado !== null && $estado !== '') {
        $query->where('estado', $estado);
    }

    // 📋 Ordenar cosechas más recientes primero
    $query->orderByDesc('id');

    // 🧾 Resultado final
    $cosechas = $query->paginate(20);

    // 🔢 Datos auxiliares para los filtros
    $cultivos = TiposCultivo::all();
    $nombreInvernadero = Invernadero::find($idinvernadero)?->nombre ?? 'Invernadero no definido';

    return view('Cosechas.index', compact(
        'cosechas', 'cultivos', 'idinvernadero', 'nombreInvernadero',
        'search', 'cultivoId', 'estado', 'fechaInicio', 'fechaFin'
    ));
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
    $data['fechaCreacion'] = now()->toDateString();

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
    // Buscar la cosecha
    $cosecha = Cosecha::findOrFail($id);

    // Recuperamos el invernadero antes de eliminar (por si tiene relación)
    $idinvernadero = $cosecha->idInvernadero;

    try {
        // Intentamos eliminar la cosecha
        $cosecha->delete();

        // Redirigimos a la vista de cosechas del invernadero
        return redirect()->route('Cosechas.index', ['idinvernadero' => $idinvernadero])
            ->with('success', 'Cosecha eliminada correctamente.');
    } catch (\Illuminate\Database\QueryException $e) {
        // Si tiene relaciones y no se puede eliminar
        return redirect()->route('Cosechas.index', ['idinvernadero' => $idinvernadero])
            ->with('error', 'No se puede eliminar esta cosecha porque tiene registros asociados (ingresos, gastos u otros).');
    }
}


    
public function administrarCosecha($id)
{
    $cosecha = Cosecha::with(['invernadero', 'tiposCultivo', 'estadosCosecha'])->findOrFail($id);
    $ingresos = Ingreso::where('idCosecha', $id)->get();
    $gastos = Gastos::where('idCosecha', $id)->get(); 

    // ✅ Calcular totales
    $totalIngresos = $ingresos->sum(function ($ingreso) {
        return (float) $ingreso->cantidadVendida * (float) $ingreso->precioUnitario;
    });

    $totalGastos = $gastos->sum('monto');
    $utilidad = $totalIngresos - $totalGastos;

    // ✅ Calcular rentabilidad (opcional)
    $rentabilidad = $totalIngresos > 0 ? ($utilidad / $totalIngresos) * 100 : 0;

    // ✅ Actualizar los valores en la base de datos
    $cosecha->update([
        'totalIngresos' => $totalIngresos,
        'totalGastos'   => $totalGastos,
        'utilidad'      => $utilidad,
        'rentabilidad'  => $rentabilidad,
    ]);

    return view('Cosechas.administrar', compact('cosecha', 'ingresos', 'gastos', 'totalIngresos', 'totalGastos', 'utilidad'));
}
private function graficarCosechasPorCultivo($idinvernadero)
{
    return Cosecha::selectRaw('tipos_cultivos.nombre as cultivo, COUNT(cosechas.id) as total')
        ->join('tipos_cultivos', 'cosechas.idTipoCultivo', '=', 'tipos_cultivos.id')
        ->where('cosechas.idInvernadero', $idinvernadero)
        ->groupBy('tipos_cultivos.nombre')
        ->get();
}
public function vistaReporte(Request $request)
{
    $cosechas = $this->filtrarCosechas($request);

    $fechaInicio = $request->input('fecha_inicio');
    $fechaFin = $request->input('fecha_fin');

    foreach ($cosechas as $cosecha) {

        // 🔹 Consulta base de ingresos
        $ingresosQuery = \Illuminate\Support\Facades\DB::table('ingresos')
            ->where('idCosecha', $cosecha->id);

        // 🔹 Aplicar filtro de fechas si el usuario los seleccionó
        if ($fechaInicio && $fechaFin) {
            $ingresosQuery->whereBetween('fecha', [$fechaInicio, $fechaFin]);
        }

        $ingresos = $ingresosQuery
            ->selectRaw('SUM(cantidadVendida * precioUnitario) as total')
            ->value('total') ?? 0;

        // 🔹 Consulta base de gastos
        $gastosQuery = \Illuminate\Support\Facades\DB::table('gastos')
            ->where('idCosecha', $cosecha->id);

        if ($fechaInicio && $fechaFin) {
            $gastosQuery->whereBetween('fecha', [$fechaInicio, $fechaFin]);
        }

        $gastos = $gastosQuery->sum('monto') ?? 0;

        // 🔹 Cálculo final
        $cosecha->total_ingresos = $ingresos;
        $cosecha->total_gastos = $gastos;
        $cosecha->utilidad = $ingresos - $gastos;
    }

    return view('Reportes.CosechaReportes.pdf.reportePDF', compact('cosechas', 'fechaInicio', 'fechaFin'));
}



    // -------------------------------------------------------------
    
  public function generarPDF(Request $request)
{
    $cosechas = $this->filtrarCosechas($request);

    // Tomamos las fechas desde el formulario (si existen)
    $fechaInicio = $request->input('fecha_inicio');
    $fechaFin = $request->input('fecha_fin');

    foreach ($cosechas as $cosecha) {

        // 🔹 Calcular ingresos filtrados por fecha
        $ingresosQuery = \Illuminate\Support\Facades\DB::table('ingresos')
            ->where('idCosecha', $cosecha->id);

        if ($fechaInicio && $fechaFin) {
            $ingresosQuery->whereBetween('fecha', [$fechaInicio, $fechaFin]);
        }

        $ingresos = $ingresosQuery
            ->selectRaw('SUM(cantidadVendida * precioUnitario) as total')
            ->value('total') ?? 0;

        // 🔹 Calcular gastos filtrados por fecha
        $gastosQuery = \Illuminate\Support\Facades\DB::table('gastos')
            ->where('idCosecha', $cosecha->id);

        if ($fechaInicio && $fechaFin) {
            $gastosQuery->whereBetween('fecha', [$fechaInicio, $fechaFin]);
        }

        $gastos = $gastosQuery->sum('monto') ?? 0;

        // 🔹 Asignar resultados
        $cosecha->total_ingresos = $ingresos;
        $cosecha->total_gastos = $gastos;
        $cosecha->utilidad = $ingresos - $gastos;
    }

    // 🔹 Generar PDF con los datos
    $pdf = PDF::loadView('Reportes.CosechaReportes.pdf.reportePDF', compact('cosechas', 'fechaInicio', 'fechaFin'))
        ->setPaper('a4', 'portrait');

    return $pdf->download('reporte_cosechas.pdf');
}



    // -------------------------------------------------------------

    // 🔹 Función auxiliar para aplicar filtros (CORREGIDA)
   // 🔹 Función auxiliar para aplicar filtros (Solución a Fechas)
// 🔹 Función auxiliar para aplicar filtros
private function filtrarCosechas(Request $request)
{
    // 1. Obtener la cosecha(s) principal(es)
    $query = Cosecha::with(['tiposCultivo', 'invernadero']);

    // Filtrar por ID de Cosecha (OBLIGATORIO para tu caso)
    if ($request->has('cosecha_id') && $request->cosecha_id) {
        $query->where('id', $request->cosecha_id);
    }
    
    // Obtener las cosechas que cumplan con el filtro principal (solo el ID)
    $cosechas = $query->get();
    
    // 2. Definir el rango de fechas para los cálculos (usando Carbon)
    $fechaInicio = null;
    $fechaFin = null;

    if ($request->filled(['fecha_inicio', 'fecha_fin'])) {
        // Usamos Carbon para asegurar que el rango incluya todo el día
        $fechaInicio = Carbon::parse($request->fecha_inicio)->startOfDay();
        $fechaFin = Carbon::parse($request->fecha_fin)->endOfDay();
    }
    
    // 3. Recorrer las cosechas y calcular Ingresos/Gastos con o sin filtro de fechas
    foreach ($cosechas as $cosecha) {
        
        // 3.1. Consulta base de Ingresos
        $ingresoQuery = Ingreso::where('idCosecha', $cosecha->id);
        
        // 3.2. Consulta base de Gastos
        $gastoQuery = Gastos::where('idCosecha', $cosecha->id);
        
        // 3.3. Aplicar filtro de fechas si existe
        if ($fechaInicio && $fechaFin) {
            // Asumo que la columna de fechas en Ingreso y Gastos se llama 'fecha'
            $ingresoQuery->whereBetween('fecha', [$fechaInicio, $fechaFin]);
            $gastoQuery->whereBetween('fecha', [$fechaInicio, $fechaFin]);
        }
        
        // 3.4. Ejecutar sumas
        $cosecha->total_ingresos = $ingresoQuery->sum('monto');
        $cosecha->total_gastos = $gastoQuery->sum('monto');
        $cosecha->utilidad = $cosecha->total_ingresos - $cosecha->total_gastos;
    }
    
    return $cosechas;
}}

