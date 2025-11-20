<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte - Ingresos y Utilidad de Cosechas</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            margin: 20px;
        }
        .title { font-size: 20px; font-weight: bold; text-align: center; margin-bottom: 10px; }
        .subtitle { font-size: 15px; margin-bottom: 20px; text-align: center; }

        h2 {
            text-align: center;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }

        th {
            background: #28a745;
            color: white;
            padding: 8px;
            text-align: center;
        }

        td {
            border: 1px solid #777;
            padding: 7px;
            text-align: center;
        }

        .right { text-align: right; }
        .left { text-align: left; }

        .totales {
            font-weight: bold;
            background: #e9ffe7;
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

</body>
</html>
