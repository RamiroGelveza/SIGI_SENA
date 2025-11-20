<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resumen General del Invernadero</title>

    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; margin: 20px; }
        h2, h3 { text-align: center; margin: 10px 0; }
        body { font-family: DejaVu Sans, sans-serif; font-size: 13px; }
        .title { font-size: 20px; font-weight: bold; text-align: center; margin-bottom: 10px; }
        .subtitle { font-size: 15px; margin-bottom: 20px; text-align: center; }


        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        table th, table td {
            border: 1px solid #444;
            padding: 6px;
            text-align: center;
        }
        table th { background: #f0f0f0; font-weight: bold; }

        .section {
            margin-top: 25px;
            margin-bottom: 5px;
            font-size: 16px;
            font-weight: bold;
            text-align: left;
        }

        .footer {
            margin-top: 25px;
            text-align: right;
            font-size: 11px;
        }
    </style>
</head>
<body>
<div class="title">RESUMEN GENERAL DEL INVERNADERO</div>

    <div class="subtitle">
        Invernadero: <strong>{{ $invernadero->nombre }}</strong><br>
        Finca: <strong>{{ $invernadero->finca->nombre }}</strong>
    </div>
    

    {{-- ===========================
        RESUMEN DE COSECHAS
    ============================ --}}
    <div class="section">1. Cosechas</div>

    <table>
        <thead>
            <tr>
                <th>Fecha Siembra</th>
                <th>Fecha Cosecha</th>
                <th>Cultivo</th>
                <th>Total Ingresos</th>
                <th>Total Gastos</th>
                <th>Utilidad</th>
            </tr>
        </thead>

        <tbody>
            @php $totalIngresos = 0; $totalGastos = 0; $totalUtilidad = 0; @endphp

            @forelse ($cosechas as $c)

                @php
                    $ing = $c->ingresos->sum(function($i){
                        return $i->cantidadVendida * $i->precioUnitario;
                    });

                    $gas = $c->gastos->sum('valor');

                    $uti = $ing - $gas;

                    $totalIngresos += $ing;
                    $totalGastos += $gas;
                    $totalUtilidad += $uti;
                @endphp

                <tr>
                    <td>{{ optional($c->fechaSiembra)->format('d/m/Y') ?? '---' }}</td>
                    <td>{{ optional($c->fechaCosechaReal)->format('d/m/Y') ?? '---' }}</td>
                    <td>{{ $c->tipoCultivo->nombre ?? 'Sin dato' }}</td>
                    <td>${{ number_format($ing, 0, ',', '.') }}</td>
                    <td>${{ number_format($gas, 0, ',', '.') }}</td>
                    <td>${{ number_format($uti, 0, ',', '.') }}</td>
                </tr>

            @empty
                <tr>
                    <td colspan="6">No hay cosechas registradas</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <h3>
        Total Ingresos: ${{ number_format($totalIngresos, 0, ',', '.') }} —
        Total Gastos: ${{ number_format($totalGastos, 0, ',', '.') }} —
        Utilidad Total: <strong>${{ number_format($totalUtilidad, 0, ',', '.') }}</strong>
    </h3>

    {{-- ===========================
        RESUMEN DE GASTOS
    ============================ --}}
    <div class="section">2. Gastos</div>

    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Cultivo</th>
                <th>Descripción</th>
                <th>Valor</th>
            </tr>
        </thead>

        <tbody>
            @php $totalGastosGlobal = 0; @endphp

            @forelse ($gastos as $g)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($g->fecha)->format('d/m/Y') }}</td>
                    <td>{{ $g->cosecha->tipoCultivo->nombre ?? 'Sin dato' }}</td>
                    <td>{{ $g->descripcion }}</td>
                    <td>${{ number_format($g->valor, 0, ',', '.') }}</td>
                </tr>

                @php $totalGastosGlobal += $g->valor; @endphp
            @empty
                <tr>
                    <td colspan="4">No hay gastos registrados</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <h3>Total Gastos Registrados: <strong>${{ number_format($totalGastosGlobal, 0, ',', '.') }}</strong></h3>

    {{-- ===========================
        RESUMEN DE MANTENIMIENTOS
    ============================ --}}
    <div class="section">3. Mantenimientos</div>

    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Descripción</th>
                <th>Valor</th>
            </tr>
        </thead>

        <tbody>
            @php $totalMantenimientos = 0; @endphp

            @forelse ($mantenimientos as $m)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($m->fecha)->format('d/m/Y') }}</td>
                    <td>{{ $m->descripcion }}</td>
                    <td>${{ number_format($m->costo, 0, ',', '.') }}</td>
                </tr>

                @php $totalMantenimientos += $m->costo; @endphp
            @empty
                <tr>
                    <td colspan="3">No hay mantenimientos registrados</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <h3>Total Mantenimientos: <strong>${{ number_format($totalMantenimientos, 0, ',', '.') }}</strong></h3>

    <br><br>

    {{-- FOOTER --}}
    <div class="footer">
        Reporte generado el {{ now()->format('d/m/Y - H:i') }}
    </div>

</body>
</html>
