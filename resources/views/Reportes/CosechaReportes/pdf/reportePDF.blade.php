<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Reporte de Cosechas</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      font-size: 13px;
    }
    h2, h3 {
      text-align: center;
      color: #2e7d32;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 15px;
    }
    th, td {
      border: 1px solid #ccc;
      padding: 8px;
      text-align: center;
    }
    th {
      background-color: #e8f5e9;
      color: #1b5e20;
    }
    .resumen {
      margin-top: 20px;
      border: 1px solid #ccc;
      padding: 10px;
      background: #f9fbe7;
    }
  </style>
</head>
<body>

  <h2>Reporte General de Cosechas</h2>
  <h3>Fecha de generación:{{ now()->format('d/m/Y h:i A') }}</h3>

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Cultivo</th>
        <th>Invernadero</th>
        <th>Fecha Siembra</th>
        <th>Fecha Cosecha Estimada</th>
        <th>Total Ingresos</th>
        <th>Total Gastos</th>
        <th>Utilidad</th>
      </tr>
    </thead>
    <tbody>
      @forelse($cosechas as $cosecha)
        <tr>
          <td>{{ $cosecha->id }}</td>
          <td>{{ $cosecha->tiposCultivo->nombre ?? 'N/A' }}</td>
          <td>{{ $cosecha->invernadero->nombre ?? 'N/A' }}</td>
          <td>{{ $cosecha->fechaSiembra ?? '-' }}</td>
          <td>{{ $cosecha->fechaCosechaEstimada ?? '-' }}</td>
          <td>${{ number_format($cosecha->total_ingresos, 0, ',', '.') }}</td>
          <td>${{ number_format($cosecha->total_gastos, 0, ',', '.') }}</td>
         <td class="{{ $cosecha->utilidad >= 0 ? 'text-green' : 'text-red' }}">
    ${{ number_format($cosecha->utilidad, 0, ',', '.') }}
</td>


        </tr>
      @empty
        <tr>
          <td colspan="8">No se encontraron cosechas según los filtros aplicados.</td>
        </tr>
      @endforelse
    </tbody>
  </table>

  @if(count($cosechas) > 0)
  <div class="resumen">
    <h3>Resumen General</h3>
    @php
      $totalIngresos = $cosechas->sum('total_ingresos');
      $totalGastos = $cosechas->sum('total_gastos');
      $totalUtilidad = $cosechas->sum('utilidad');
    @endphp
    <p><strong>Total Ingresos:</strong> ${{ number_format($totalIngresos, 0, ',', '.') }}</p>
    <p><strong>Total Gastos:</strong> ${{ number_format($totalGastos, 0, ',', '.') }}</p>
    <p><strong>Utilidad Total:</strong> 
   <span class="{{ $totalUtilidad >= 0 ? 'text-green-500' : 'text-red-500' }}">
    ${{ number_format($totalUtilidad, 0, ',', '.') }}
</span>



    </p>
  </div>
  @endif

</body>
</html>
