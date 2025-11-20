<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Gastos del Invernadero</title>

    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 13px; }
        .title { font-size: 20px; font-weight: bold; text-align: center; margin-bottom: 10px; }
        .subtitle { font-size: 15px; margin-bottom: 20px; text-align: center; }

        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        table th, table td {
            border: 1px solid #444;
            padding: 6px;
            text-align: center;
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

    <div class="title">Reporte de Gastos</div>

    <div class="subtitle">
        Invernadero: <strong>{{ $invernadero->nombre }}</strong><br>
        Finca: <strong>{{ $invernadero->finca->nombre }}</strong>
    </div>

    <table>
        <thead>
            <tr>
                <th>Fecha Gasto</th>
                <th>Cosecha</th>
                <th>Descripción</th>
                <th>Tipo</th>
                <th>Valor Gasto</th>
            </tr>
        </thead>

        <tbody>
            @php $total = 0; @endphp

            @foreach ($gastos as $gasto)
                <tr>
                    <td>{{ $gasto->fecha }}</td>
                    <td>{{ $gasto->cosecha->tiposCultivo->nombre ?? 'Sin cultivo' }}</td>

                    <td>{{ $gasto->descripcion }}</td>
                    <td>{{ $gasto->categoriaGasto->nombre ?? 'Sin categoría' }}</td>
                
                    <td>${{ number_format($gasto->monto, 0, ',', '.') }}</td>
                </tr>

                @php $total += $gasto->monto; @endphp
            @endforeach

            @if ($gastos->count() === 0)
                <tr>
                    <td colspan="5">No hay gastos registrados</td>
                </tr>
            @endif
        </tbody>
    </table>

    <br>

    <!-- =========================== -->
    <!--        TOTAL GENERAL        -->
    <!-- =========================== -->
    <h3 style="text-align:right;">
        Total de Gastos: <strong>${{ number_format($total, 0, ',', '.') }}</strong>
    </h3>

</body>
</html>
