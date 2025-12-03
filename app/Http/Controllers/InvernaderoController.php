<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvernaderoRequest;
use App\Models\Cosecha;
use App\Models\finca;
use App\Models\Gastos;
use App\Models\Invernadero;
use App\Models\MantenimientoInvernadero;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Dompdf\Adapter\PDFLib;
use Illuminate\Http\Request;


class InvernaderoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($idfinca)
    {
        $invernaderos=Invernadero::where('idFinca', $idfinca)->get();
        $idfinca = $idfinca;
        return view('Invernaderos.index', compact('invernaderos','idfinca'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($idfinca)
    {
        $fincas=finca::where('id', $idfinca)->get();
        return view('Invernaderos.create', compact('fincas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InvernaderoRequest $request)
    {
        Invernadero::create($request->all());

        $idfinca = $request->input('idFinca');

        return redirect()->route('Invernaderos.index', ['idfinca' => $idfinca])
        ->with('success', 'Invernadero Creado Correctamente');
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
        $invernadero = Invernadero::findOrFail($id);
        $fincas = Finca::all();
        return view('Invernaderos.edit', compact('invernadero', 'fincas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $invernadero = Invernadero::findOrFail($id);
        $invernadero->update($request->all());
        $idfinca = $request->input('idFinca');
        return redirect()->route('Invernaderos.index', ['idfinca' => $idfinca])
            ->with('success', 'Invernadero actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
   {
    $invernadero = Invernadero::findOrFail($id);
    $idfinca = $invernadero->idFinca; // recuperamos la finca antes de eliminar

    try {
        $invernadero->delete();
        return redirect()->route('Invernaderos.index', ['idfinca' => $idfinca])
            ->with('success', 'Invernadero eliminado correctamente.');
    } catch (\Illuminate\Database\QueryException $e) {
        return redirect()->route('Invernaderos.index', ['idfinca' => $idfinca])
            ->with('error', 'No se puede eliminar este invernadero porque tiene cosechas asociadas.');
    }

}

public function generar(Request $request,$idInvernadero)
{
    $invernadero = Invernadero::findOrFail($idInvernadero);
    $tipo = $request->tipo;

    switch ($tipo) {

        /* ───────────────────────────────────────────────
         * 1️⃣ INGRESOS Y UTILIDAD POR COSECHAS (SIN FECHAS)
         * ─────────────────────────────────────────────── */
        case 'cosechas_ingresos':

            $cosechas = Cosecha::with(['ingresos', 'gastos'])
                ->where('idInvernadero', $idInvernadero)
                ->orderBy('id', 'desc')
                ->get();

            // Calcular totales generales
            $totalIngresosGeneral = 0;
            $totalGastosGeneral = 0;

            foreach ($cosechas as $cosecha) {
                $totalIngresosGeneral += $cosecha->ingresos->sum(
                    fn($i) => $i->cantidadVendida * $i->precioUnitario
                );
                $totalGastosGeneral += $cosecha->gastos->sum('monto');
            }

            $totalUtilidadGeneral = $totalIngresosGeneral - $totalGastosGeneral;

            return view(
                'Reportes.InvernaderoReportes.pdf.reportePDFInvernadero',
                compact(
                    'cosechas',
                    'invernadero',
                    'totalIngresosGeneral',
                    'totalGastosGeneral',
                    'totalUtilidadGeneral'
                )
            );



        /* -----------------------------------------------
         * 2️⃣ DETALLE DE GASTOS
         * -----------------------------------------------*/
        case 'gastos_detalle':
            $invernadero = Invernadero::findOrFail($idInvernadero);
            $gastos = Gastos::with('cosecha')
                ->whereHas('cosecha', function($q) use ($idInvernadero) {
                    $q->where('idInvernadero', $idInvernadero);
                })
                ->orderBy('fecha', 'desc')
                ->get();

            return view('Reportes.InvernaderoReportes.pdf.gastosPDFInvernadero', compact('gastos','invernadero'));


        /* -----------------------------------------------
         * 3️⃣ MANTENIMIENTOS
         * -----------------------------------------------*/
        case 'mantenimientos':
            $invernadero = Invernadero::findOrFail($idInvernadero);

            $mantenimientos = MantenimientoInvernadero::where('idInvernadero', $idInvernadero)
                ->orderBy('fecha', 'desc')
                ->get();

            return view('Reportes.InvernaderoReportes.pdf.mantenimientosPDFInvernadero', compact('mantenimientos','invernadero'));


        /* -----------------------------------------------
         * 4️⃣ RESUMEN GENERAL
         * -----------------------------------------------*/
        case 'resumen_general':
            $invernadero = Invernadero::findOrFail($idInvernadero);

            $cosechas = Cosecha::with(['ingresos', 'gastos'])
                ->where('idInvernadero', $idInvernadero)
                ->get();

            $gastos = Gastos::whereHas('cosecha', function($q) use ($idInvernadero) {
                $q->where('idInvernadero', $idInvernadero);
            })->get();

            $mantenimientos = MantenimientoInvernadero::where('idInvernadero', $idInvernadero)->get();

            return view('Reportes.InvernaderoReportes.pdf.generalPDFInvernadero', compact(
                'cosechas',
                'gastos',
                'mantenimientos',
                'invernadero'
            ));
    }
}
public function descargar(Request $request, $idInvernadero)
{
    $invernadero = Invernadero::findOrFail($idInvernadero);
    $tipo = $request->tipo;

    switch ($tipo) {

        /* ───────────────────────────────────────────────
         * 1️⃣ INGRESOS Y UTILIDAD POR COSECHAS
         * ─────────────────────────────────────────────── */
        case 'cosechas_ingresos':

            $cosechas = Cosecha::with(['ingresos', 'gastos'])
                ->where('idInvernadero', $idInvernadero)
                ->orderBy('id', 'desc')
                ->get();

            $totalIngresosGeneral = 0;
            $totalGastosGeneral = 0;

            foreach ($cosechas as $cosecha) {
                $totalIngresosGeneral += $cosecha->ingresos->sum(
                    fn($i) => $i->cantidadVendida * $i->precioUnitario
                );
                $totalGastosGeneral += $cosecha->gastos->sum('monto');
            }

            $totalUtilidadGeneral = $totalIngresosGeneral - $totalGastosGeneral;

            $pdf = Pdf::loadView('Reportes.InvernaderoReportes.pdf.reportePDFInvernadero', compact(
                'cosechas',
                'invernadero',
                'totalIngresosGeneral',
                'totalGastosGeneral',
                'totalUtilidadGeneral'
            ))->setPaper('a4', 'landscape');

            return $pdf->download('reporte_cosechas_ingresos_' . date('Y-m-d') . '.pdf');



        /* ───────────────────────────────────────────────
         * 2️⃣ DETALLE DE GASTOS
         * ─────────────────────────────────────────────── */
        case 'gastos_detalle':

            $gastos = Gastos::with('cosecha')
                ->whereHas('cosecha', function ($q) use ($idInvernadero) {
                    $q->where('idInvernadero', $idInvernadero);
                })
                ->orderBy('fecha', 'desc')
                ->get();

            $totalGastos = $gastos->sum('monto');

            $pdf = Pdf::loadView('Reportes.InvernaderoReportes.pdf.gastosPDFInvernadero', compact(
                'gastos',
                'invernadero',
                'totalGastos'
            ))->setPaper('a4', 'portrait');

            return $pdf->download('reporte_gastos_' . date('Y-m-d') . '.pdf');



        /* ───────────────────────────────────────────────
         * 3️⃣ MANTENIMIENTOS
         * ─────────────────────────────────────────────── */
        case 'mantenimientos':

            $mantenimientos = MantenimientoInvernadero::where('idInvernadero', $idInvernadero)
                ->orderBy('fecha', 'desc')
                ->get();

            $totalMantenimientos = $mantenimientos->sum('costo');

            $pdf = Pdf::loadView('Reportes.InvernaderoReportes.pdf.mantenimientosPDFInvernadero', compact(
                'mantenimientos',
                'invernadero',
                'totalMantenimientos'
            ))->setPaper('a4', 'portrait');

            return $pdf->download('reporte_mantenimientos_' . date('Y-m-d') . '.pdf');



        /* ───────────────────────────────────────────────
         * 4️⃣ RESUMEN GENERAL
         * ─────────────────────────────────────────────── */
        case 'resumen_general':

            $cosechas = Cosecha::with(['ingresos', 'gastos'])
                ->where('idInvernadero', $idInvernadero)
                ->get();

            $gastos = Gastos::whereHas('cosecha', function ($q) use ($idInvernadero) {
                $q->where('idInvernadero', $idInvernadero);
            })->get();

            $mantenimientos = MantenimientoInvernadero::where('idInvernadero', $idInvernadero)->get();

            $totalIngresos = $cosechas->sum(
                fn($c) => $c->ingresos->sum(fn($i) => $i->cantidadVendida * $i->precioUnitario)
            );

            $totalGastos = $gastos->sum('monto') + $mantenimientos->sum('costo');

            $utilidad = $totalIngresos - $totalGastos;

            $pdf = Pdf::loadView('Reportes.InvernaderoReportes.pdf.generalPDFInvernadero', compact(
                'cosechas',
                'gastos',
                'mantenimientos',
                'invernadero',
                'totalIngresos',
                'totalGastos',
                'utilidad'
            ))->setPaper('a4', 'landscape');

            return $pdf->download('reporte_resumen_general_' . date('Y-m-d') . '.pdf');
    }
}


}