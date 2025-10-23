@extends('layouts.app')

@section('title', 'Dashboard de Cosechas')

@section('titleContent')
<h1 class="text-center my-3">🍅 Dashboard de Cosechas</h1>
<p class="text-center text-muted">Monitoreo detallado de la producción, costos e ingresos de cada cosecha.</p>
@endsection

@section('content')
<div class="container-fluid">

    {{-- 🔸 BOTONES DE ACCIÓN --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('Cosechas.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Nueva Cosecha
        </a>
        <a href="{{ route('welcome') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left-circle"></i> Volver al Inicio
        </a>
    </div>

    {{-- 🔸 TARJETAS RESUMEN --}}
    <div class="row text-center mb-4">
        <div class="col-md-3 mb-3">
            <div class="card shadow-sm border-primary">
                <div class="card-body">
                    <h6>Producción Total</h6>
                    <h3>{{ $cosechas->sum('produccion_real') }} canastillas</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card shadow-sm border-success">
                <div class="card-body">
                    <h6>Ingresos Totales</h6>
                    <h3>${{ number_format($cosechas->sum('totalIngresos'), 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card shadow-sm border-danger">
                <div class="card-body">
                    <h6>Gastos Totales</h6>
                    <h3>${{ number_format($cosechas->sum('totalGastos'), 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card shadow-sm border-info">
                <div class="card-body">
                    <h6>Ganancia Neta</h6>
                    <h3>${{ number_format($cosechas->sum('utilidad'), 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- 🔸 GRÁFICOS --}}
    <div class="row">
        <div class="col-md-8 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">Producción por Cosecha</div>
                <div class="card-body">
                    <canvas id="produccionChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">Rentabilidad Promedio (%)</div>
                <div class="card-body text-center">
                    <canvas id="rentabilidadChart" width="200" height="200"></canvas>
                    <h4 class="mt-3 text-primary">
                        {{ $cosechas->sum('totalGastos') > 0 
                            ? round(($cosechas->sum('utilidad') / $cosechas->sum('totalGastos')) * 100, 1) . '%' 
                            : '0%' }}
                    </h4>
                </div>
            </div>
        </div>
    </div>

    <div class="">
    @foreach ($cosechas as $cosecha)
    <div class="col-md-4 mb-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                <span>{{ $cosecha->tiposCultivo->nombre }}</span>
                <span class="badge bg-light text-dark">#{{ $cosecha->id }}</span>
            </div>
            <div class="card-body">
                <p><strong>Invernadero:</strong> {{ $cosecha->invernadero->nombre }}</p>
                <p><strong>Producción:</strong> {{ $cosecha->produccion_real }} kg / {{ $cosecha->produccion_estimada }} kg</p>
                <p><strong>Utilidad:</strong> ${{ number_format($cosecha->utilidad, 0, ',', '.') }}</p>
                <p>
                    <strong>Rentabilidad:</strong>
                    <span class="badge bg-{{ $cosecha->utilidad > 0 ? 'success' : 'danger' }}">
                        {{ round(($cosecha->utilidad / max($cosecha->totalGastos,1)) * 100, 1) }}%
                    </span>
                </p>
                <small class="text-muted">
                    Duración: 
                    {{ $cosecha->fechaCosechaReal 
                        ? \Carbon\Carbon::parse($cosecha->fechaSiembra)->diffInDays($cosecha->fechaCosechaReal) . ' días'
                        : 'Pendiente' }}
                </small>
            </div>
        </div>
    </div>
    @endforeach
</div>


</div>

{{-- 🔸 Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const labels = @json($cosechas->pluck('id'));
    const produccion = @json($cosechas->pluck('produccion_real'));

    // Gráfico de barras - Producción
    new Chart(document.getElementById('produccionChart'), {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Producción (canastillas)',
                data: produccion,
                backgroundColor: '#28a745'
            }]
        },
        options: { responsive: true, scales: { y: { beginAtZero: true } } }
    });

    // Gráfico de dona - Rentabilidad promedio
    new Chart(document.getElementById('rentabilidadChart'), {
        type: 'doughnut',
        data: {
            labels: ['Rentabilidad', ''],
            datasets: [{
                data: [
                    {{ $cosechas->sum('totalGastos') > 0 ? round(($cosechas->sum('utilidad') / $cosechas->sum('totalGastos')) * 100, 1) : 0 }},
                    {{ 100 - ($cosechas->sum('totalGastos') > 0 ? round(($cosechas->sum('utilidad') / $cosechas->sum('totalGastos')) * 100, 1) : 0) }}
                ],
                backgroundColor: ['#007bff', '#e9ecef']
            }]
        },
        options: { cutout: '70%' }
    });
</script>
@endsection
