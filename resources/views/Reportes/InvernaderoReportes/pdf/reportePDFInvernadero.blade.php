<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte - Ingresos y Utilidad de Cosechas</title>

    <style>
     body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 20px;
        }

        h2,
        h3 {
            text-align: center;
            margin: 10px 0;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 13px;
        }

        .title {
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 10px;
        }

        .subtitle {
            font-size: 15px;
            margin-bottom: 20px;
            text-align: center;
        }


        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table th,
        table td {
            border: 1px solid #444;
            padding: 6px;
            text-align: center;
        }

        table th {
            background: #f0f0f0;
            font-weight: bold;
        }

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
<div class="title">REPORTE DE INGRESOS Y UTILIDAD DE COSECHAS</div>

    <div class="subtitle">
        Invernadero: <strong>{{ $invernadero->nombre }}</strong><br>
        Finca: <strong>{{ $invernadero->finca->nombre }}</strong>
    </div>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Cultivo</th>
        <th>Fecha Siembra</th>
        <th>Fecha Cosecha</th>
        <th>Total Ingresos</th>
        <th>Total Gastos</th>
        <th>Utilidad</th>
        <th>Estado</th>
    </tr>
    </thead>

    <tbody>

    @foreach($cosechas as $cosecha)
        @php
            $totalIngresos = $cosecha->ingresos->sum(fn($i) => $i->cantidadVendida * $i->precioUnitario);
            $totalGastos   = $cosecha->gastos->sum('monto');
            $utilidad      = $totalIngresos - $totalGastos;
        @endphp

        <tr>
            <td>{{ $cosecha->id }}</td>
            <td class="left">{{ $cosecha->tiposCultivo->nombre ?? '—' }}</td>
            <td>{{ $cosecha->fechaSiembra }}</td>
            <td>{{ $cosecha->fechaCosechaReal }}</td>

            <td class="right">$ {{ number_format($totalIngresos, 0, ',', '.') }}</td>
            <td class="right">$ {{ number_format($totalGastos, 0, ',', '.') }}</td>

          <td class="{{ $utilidad >= 0 ? 'text-green' : 'text-red' }}">
    $ {{ number_format($utilidad, 0, ',', '.') }}
</td>




            <td>{{ $cosecha->estadosCosecha->nombre ?? 'Sin estado' }}</td>
        </tr>
    @endforeach

    </tbody>
</table>

        <table class="">
            <thead>
                <tr>
                    <th>totalIngresosGeneral</th>
                    <th>totalGastosGeneral</th>
                    <th>totalUtilidadGeneral</th>
                </tr>
            </thead>
            <tbody>
    <tr class="totales">
        <td >
            <strong>$ {{ number_format($totalIngresosGeneral, 0, ',', '.') }}</strong>
        </td>

        <td >
            <strong>$ {{ number_format($totalGastosGeneral, 0, ',', '.') }}</strong>
        </td>

        <td >
            <strong>$ {{ number_format($totalUtilidadGeneral, 0, ',', '.') }}</strong>
        </td>
    </tr>
    </tbody>
</table>



{{-- FOOTER --}}
    <div class="footer">
        Reporte generado el {{ now()->format('d/m/Y - H:i') }}
    </div>
</body>
</html>
