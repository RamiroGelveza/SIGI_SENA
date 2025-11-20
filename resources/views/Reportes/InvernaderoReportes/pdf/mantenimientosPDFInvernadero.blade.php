<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Mantenimientos</title>

    <style>
    body {
        font-family: DejaVu Sans, sans-serif;
        font-size: 13px;
        margin: 20px;
    }

    .title {
        font-size: 20px;
        font-weight: bold;
        text-align: center;
        margin-bottom: 10px;
    }

    .subtitle {
        font-size: 15px;
        text-align: center;
        margin-bottom: 20px;
    }

    h2 {
        text-align: center;
        margin-bottom: 15px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }

    table th, table td {
        border: 1px solid #444;
        padding: 6px;
        text-align: center;
    }

    table th {
        background: #f0f0f0;
        font-weight: bold;
    }

    .footer {
        margin-top: 25px;
        text-align: right;
        font-size: 11px;
        color: #555;
    }

    .filters { margin-bottom: 15px; }
    .filter-label { font-weight: bold; }

    .btn {
        padding: 6px 10px;
        border-radius: 4px;
        color: white;
        text-decoration: none;
    }

    .btn-danger { background: #dc3545; }
    .btn-success { background: #198754; }
</style>

</head>
<body>
<div class="title">REPORTE DE MANTENIMIENTOS DEL INVERNADERO</div>

    <div class="subtitle">
        Invernadero: <strong>{{ $invernadero->nombre }}</strong><br>
        Finca: <strong>{{ $invernadero->finca->nombre }}</strong>
    </div>

    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Descripción</th>
                <th>Costo</th>
                <th>Invernadero</th>
            </tr>
        </thead>

        <tbody>
            @php $total = 0; @endphp

            @foreach ($mantenimientos as $item)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($item->fecha)->format('d/m/Y') }}</td>
                    <td>{{ $item->descripcion }}</td>
                    <td>${{ number_format($item->costoMantenimiento, 0, ',', '.') }}</td>
                    <td>{{ $item->invernadero->nombre ?? 'Sin dato' }}</td>

                </tr>
                @php $total += $item->costoMantenimiento; @endphp

            @endforeach

             @if ($item->count() === 0)
                <tr>
                    <td colspan="5">No hay gastos registrados</td>
                </tr>
            @endif
        </tbody>
    </table>
   <h3 style="text-align:right;">
    Total de Gasto Mantenimientos: <strong>${{ number_format($total, 0, ',', '.') }}</strong>
</h3>


    <div class="footer">
        Reporte generado el {{ now()->format('d/m/Y - H:i') }}
    </div>

</body>
</html>
