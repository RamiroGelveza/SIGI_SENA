<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvernaderoRequest;
use App\Models\Cosecha;
use App\Models\finca;
use App\Models\Gastos;
use App\Models\Invernadero;
use App\Models\MantenimientoInvernadero;
use Barryvdh\DomPDF\Facade\Pdf;

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

public function generar(Request $request)
{
    $idInvernadero = $request->invernadero_id; // viene desde el modal
    $tipo = $request->tipo;

    switch ($tipo) {

        /* -----------------------------------------------
         * 1️⃣ INGRESOS Y UTILIDAD DE COSECHAS
         * -----------------------------------------------*/
        case 'cosechas_ingresos':

            $cosechas = Cosecha::with(['ingresos', 'gastos'])
                ->where('idInvernadero', $idInvernadero)
                ->orderBy('fechaCosechaReal', 'desc')
                ->get();

            return view('Reportes.CosechaReportes.pdf.reportePDF', compact('cosechas'));


        /* -----------------------------------------------
         * 2️⃣ DETALLE DE GASTOS
         * -----------------------------------------------*/
        case 'gastos_detalle':

            $gastos = Gastos::with('cosecha')
                ->whereHas('cosecha', function($q) use ($idInvernadero) {
                    $q->where('idInvernadero', $idInvernadero);
                })
                ->orderBy('fecha', 'desc')
                ->get();

            return view('reportes.pdf.gastos_detalle', compact('gastos'));


        /* -----------------------------------------------
         * 3️⃣ MANTENIMIENTOS
         * -----------------------------------------------*/
        case 'mantenimientos':

            $mantenimientos = MantenimientoInvernadero::where('idInvernadero', $idInvernadero)
                ->orderBy('fecha', 'desc')
                ->get();

            return view('reportes.pdf.mantenimientos', compact('mantenimientos'));


        /* -----------------------------------------------
         * 4️⃣ RESUMEN GENERAL
         * -----------------------------------------------*/
        case 'resumen_general':

            $cosechas = Cosecha::with(['ingreso', 'gastos'])
                ->where('idInvernadero', $idInvernadero)
                ->get();

            $gastos = Gastos::whereHas('cosecha', function($q) use ($idInvernadero) {
                $q->where('idInvernadero', $idInvernadero);
            })->get();

            $mantenimientos = MantenimientoInvernadero::where('idInvernadero', $idInvernadero)->get();

            return view('reportes.pdf.resumen_general', compact(
                'cosechas',
                'gastos',
                'mantenimientos'
            ));
    }
}

}