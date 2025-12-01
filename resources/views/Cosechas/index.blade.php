@extends('layouts.app')

@section('title', 'Panel de Cosechas')

@section('titleContent')
<div class="text-center py-4 bg-light shadow-sm mb-4">
    <h1 class="fw-bolder display-5 text-success">
        <i class="bi bi-seedling me-2"></i> Panel General de Invernadero
    </h1>
    <p class="text-secondary fs-6">Visualiza el rendimiento, la rentabilidad y la evolución financiera de tus invernaderos.</p>
</div>
@endsection

@section('content')
<style>
.card-icon {
    font-size: 2.5rem;     /* antes era enorme, ahora perfecto */
    opacity: 0.85;
}

.card-title {
    font-size: 0.95rem;
    margin-bottom: 5px;
    font-weight: 400;
}

.card-value {
    font-weight: 700;
    font-size: clamp(1.2rem, 3vw, 2.3rem);
    white-space: nowrap;
    overflow: hidden;
    line-height: 1.1;
}



</style>

<div class="container-fluid py-4">

    {{-- ⚠️ INICIO DE CÁLCULO DE FALLBACK Y DEFINICIÓN DE VARIABLES ⚠️ --}}
    @php
    // Aseguramos que la colección exista para evitar errores
    $cosechasCollection = $cosechas ?? collect([]);

    // El id del invernadero para el enlace, usando un fallback seguro
    $invernaderoId = $cosechasCollection->first()->invernadero->idfinca ?? 1;

    // Cálculos Totales (usando 0 como fallback si la colección está vacía)
    $totalIngresos = $cosechasCollection->sum('totalIngresos');
    $totalGastos = $cosechasCollection->sum('totalGastos');
    $utilidadTotal = $cosechasCollection->sum('utilidad');
    // Cálculo mantenimientos
    $mantenimientos = $totalMantenimientos;

    // Datos de ejemplo para los gráficos si la colección está vacía o si 'totalIngresos' no existe
    $graficoLabels = $cosechasCollection->isNotEmpty() ?
    $cosechasCollection->map(fn($c) => $c->tiposCultivo->nombre ?? 'Cosecha #'.$c->id)->toArray() :
    ['Cebolla', 'Tomate', 'Pimiento', 'Frijol'];

    $graficoIngresos = $cosechasCollection->isNotEmpty() ?
    $cosechasCollection->map(fn($c) => $c->totalIngresos)->toArray() :
    [5000000, 3500000, 6200000, 1800000];

    $graficoGastos = $cosechasCollection->isNotEmpty() ?
    $cosechasCollection->map(fn($c) => $c->totalGastos)->toArray() :
    [2500000, 4100000, 3100000, 1500000];

    // Datos para el gráfico Donut (solo si hay datos reales, sino usaremos los totales)
    $donutLabels = ['Ingresos', 'Gastos'];
    $donutData = [$totalIngresos, $totalGastos];

    @endphp
    {{-- ⚠️ FIN DE CÁLCULO DE FALLBACK ⚠️ --}}


    {{-- 🔹 ACCIONES SUPERIORES --}}
    <div class="d-flex justify-content-between align-items-center mb-5">
        <a href="{{ route('Cosechas.create', $idinvernadero) }}" class="btn btn-success btn-lg fw-bold shadow-lg lift-up">
            <i class="bi bi-plus-circle-fill me-2"></i> Registrar Nueva Cosecha
        </a>
        <a href="{{ route('Invernaderos.index', $idfinca) }}" class="btn btn-outline-secondary btn-lg fw-bold">
            <i class="bi bi-house-door-fill"></i> Volver a Invernaderos
        </a>
    </div>

    {{-- 💰 MÉTRICAS PRINCIPALES (Diseño Limpio y Espaciado) --}}
    <div class="row g-4 mb-5">

        {{-- Tarjeta de Ingresos --}}
        <div class="col-lg-3 col-md-6">
            <div class="card bg-success text-white border-0 shadow-lg h-100 animated-card lift-up">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-cash-stack display-4 me-3 opacity-75 card-icon"></i>
                        <div class="flex-grow-1">
                            <h6 class="text-uppercase mb-1 fw-light">Ingresos Totales</h6>
                            <h3 class="fw-bolder mb-0 responsive-number ">
                                ${{ number_format($totalIngresos, 0, ',', '.') }}
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tarjeta de Gastos --}}
        <div class="col-lg-3 col-md-6">
            <div class="card bg-danger text-white border-0 shadow-lg h-100 animated-card lift-up">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-credit-card-2-front display-4 me-3 opacity-75"></i>
                        <div class="flex-grow-1">
                            <h6 class="text-uppercase mb-1 fw-light">Gastos Totales</h6>
                            <h3 class="fw-bolder mb-0 responsive-number">
                                ${{ number_format($totalGastos, 0, ',', '.') }}
                            </h3>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tarjeta de Utilidad Neta --}}
        <div class="col-lg-3 col-md-6">
            <div class="card text-white border-0 shadow-lg h-100 animated-card lift-up" style="background-color: #0d6efd;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-graph-up-arrow display-4 me-3 opacity-75"></i>
                        <div class="flex-grow-1">
                            <h6 class="text-uppercase mb-1 fw-light">Utilidad Neta</h6>
                            <h3 class="fw-bolder mb-0 responsive-number">
                                ${{ number_format($utilidadTotal, 0, ',', '.') }}
                            </h3>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tarjeta de mantenimientos --}}
         <div class="col-lg-3 col-md-6">
            <div class="card text-white border-0 shadow-lg h-100 animated-card lift-up" style="background-color: #6f42c1;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-tools display-4 me-3 opacity-75"></i>
                        <div class="flex-grow-1">
                            <h6 class="text-uppercase mb-1 fw-light">Mantenimientos Invernadero</h6>
                            <h3 class="fw-bolder mb-0 responsive-number">
                                ${{ number_format($mantenimientos, 0, ',', '.') }}
                            </h3>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr>

    {{-- 🔹 GRÁFICOS DE DESEMPEÑO --}}
    <div class="row mb-5">
        <div class="col-md-8 mb-4">
            <div class="card shadow-lg border-0 h-100">
                <div class="card-header bg-light border-bottom fw-bold text-success py-3">
                    <i class="bi bi-bar-chart-line-fill me-2"></i> Desempeño Económico por Cosecha (Ingresos vs. Gastos)
                </div>
                <div class="card-body">
                    <div class="chart-container" style="height: 400px;">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card shadow-lg border-0 h-100">
                <div class="card-header bg-light border-bottom fw-bold text-primary py-3">
                    <i class="bi bi-pie-chart-fill me-2"></i> Relación Ingresos/Gastos Total
                </div>
                <div class="card-body d-flex align-items-center justify-content-center">
                    <div class="chart-container" style="height: 300px;">
                        <canvas id="donutChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr>
    <!-- Encabezado del invernadero -->
    <div class="text-center mb-4">
        <h3 class="fw-bold text-success mb-2">
            🌿 Invernadero: <span class="text-dark">{{ $nombreInvernadero }}</span>
        </h3>
        <h4 class="fw-bolder text-dark">
            <i class="bi bi-table me-2"></i>
            Historial Detallado de Cosechas ({{ $cosechasCollection->count() }} Registros)
        </h4>
    </div>

    {{-- 🔹 LISTADO DETALLADO DE COSECHAS --}}
    <div class="card shadow-lg border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table id="myTable" class="table table-striped align-middle mb-0 table-hover">
                    <thead class="table-success text-center text-uppercase small">
                        <tr>
                            <th>ID</th>
                            <th>Cultivo</th>
                            <th>Siembra</th>
                            <th>Cosecha</th>
                            <th>Ingresos</th>
                            <th>Gastos</th>
                            <th>Utilidad</th>
                            <th>Rentabilidad</th>
                            <th>Estado</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cosechas as $cosecha)
                        <tr class="text-center">
                            <td>{{ $cosecha->id }}</td>
                            <td>{{ $cosecha->tiposCultivo->nombre ?? 'Sin definir' }}</td>
                            <td>{{ date('d/m/Y', strtotime($cosecha->fechaSiembra)) }}</td>
                            <td>
                                {{ $cosecha->fechaCosechaReal != ''
        ? date('d/m/Y', strtotime($cosecha->fechaCosechaReal))
        : 'Pendiente'
    }}
                            </td>
                            <td>${{ number_format($cosecha->totalIngresos, 0, ',', '.') }}</td>
                            <td>${{ number_format($cosecha->totalGastos, 0, ',', '.') }}</td>
                            <td>${{ number_format($cosecha->utilidad, 0, ',', '.') }}</td>
                            <td>
                                @php
                                $rentabilidadCosecha = $cosecha->totalGastos > 0 ? round(($cosecha->utilidad / $cosecha->totalGastos) * 100, 1) : 0;
                                @endphp
                                <span class="badge bg-{{ $rentabilidadCosecha >= 0 ? 'success' : 'danger' }} fw-bold">
                                    {{ $rentabilidadCosecha }}%
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-secondary">{{ $cosecha->estadosCosecha->nombre ?? 'Sin estado' }}</span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <button type="button" class="btn btn-success"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalReportesUnico"
                                        data-cosecha-id="{{ $cosecha->id }}"
                                        data-cultivo-id="{{ $cosecha->tiposCultivo->id ?? '' }}"
                                        data-cultivo-nombre="{{ $cosecha->tiposCultivo->nombre ?? 'Sin Cultivo' }}"
                                        data-cosecha-nombre-titulo="Cosecha #{{ $cosecha->id }} de {{ $cosecha->tiposCultivo->nombre ?? '' }}">
                                        <i class="fas fa-file-alt"></i>
                                    </button> <a href="{{route('administrar', $cosecha->id)}}" class="btn btn-info btn-sm shadow-sm" title="Administrar"><i class="bi bi-gear-fill"></i></a>
                                    <a href="{{route('Cosechas.edit',$cosecha->id)}}" class="btn btn-warning btn-sm shadow-sm" title="Editar"><i class="bi bi-pencil-square"></i></a>
                                    <form action="{{route('Cosechas.destroy',$cosecha->id)}}" method="POST" onsubmit="return confirmarEliminacion(event)">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm shadow-sm" title="Eliminar"><i class="bi bi-trash3"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center text-muted py-4">No hay cosechas registradas en este invernadero.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
@include('Reportes.CosechaReportes.CosechasReportes',['cosecha' => $cosechas])

<style>
    /* Estilo para el efecto de elevación de las tarjetas (lift-up) */
    .lift-up {
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }

    .lift-up:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.8rem 1.5rem rgba(0, 0, 0, 0.15) !important;
    }

    /* Contenedor del Gráfico: Asegura que Chart.js respete el espacio */
    .chart-container {
        position: relative;
    }
</style>

@push('scripts')
{{-- Asegúrate de que Chart.js esté cargado --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>

<script>
    // Función de confirmación de eliminación (referenciada en la tabla)
    function confirmarEliminacion(event) {
        event.preventDefault();
        return confirm('¿Está seguro de eliminar esta cosecha? Esta acción es irreversible.');
    }

    document.addEventListener('DOMContentLoaded', function() {
        // ----------------------------------------------------
        // PREPARACIÓN DE DATOS (Usando variables PHP definidas arriba)
        // ----------------------------------------------------
        const labels = @json($graficoLabels);
        const ingresos = @json($graficoIngresos);
        const gastos = @json($graficoGastos);

        // Datos para el gráfico Donut (Relación Total I/G)
        const donutLabels = @json($donutLabels);
        const donutData = @json($donutData);

        // ----------------------------------------------------
        // GRÁFICO 1: Barras (Ingresos vs. Gastos)
        // ----------------------------------------------------
        const barCtx = document.getElementById('barChart');
        if (barCtx) {
            new Chart(barCtx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                            label: 'Ingresos ($)',
                            data: ingresos,
                            backgroundColor: 'rgba(40, 167, 69, 0.8)', // Verde
                            borderColor: 'rgba(40, 167, 69, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Gastos ($)',
                            data: gastos,
                            backgroundColor: 'rgba(220, 53, 69, 0.8)', // Rojo
                            borderColor: 'rgba(220, 53, 69, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return '$' + value.toLocaleString('es-CO');
                                }
                            }
                        }
                    }
                }
            });
        }

        // ----------------------------------------------------
        // GRÁFICO 2: Dona (Relación Total Ingresos/Gastos)
        // ----------------------------------------------------
        const donutCtx = document.getElementById('donutChart');
        if (donutCtx && donutData[0] + donutData[1] > 0) { // Solo si hay alguna transacción
            new Chart(donutCtx, {
                type: 'doughnut',
                data: {
                    labels: donutLabels,
                    datasets: [{
                        data: donutData,
                        backgroundColor: [
                            'rgba(40, 167, 69, 0.8)', // Verde
                            'rgba(220, 53, 69, 0.8)', // Rojo
                        ],
                        hoverOffset: 8,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    label += '$' + context.raw.toLocaleString('es-CO');
                                    return label;
                                }
                            }
                        }
                    }
                }
            });
        }
    });
</script>
@endpush
@endsection