@extends('layouts.app')

@section('title', 'Panel de Invernadero')

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
        font-size: 2.5rem;
        /* antes era enorme, ahora perfecto */
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

    .grafica-container {
        width: 100%;
        max-width: 950px;
        margin: 20px auto;
        padding: 20px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        position: relative;
    }

    /* Scroll horizontal solo si es necesario */
    .grafica-scroll {
        width: 100%;
        overflow-x: auto;
        overflow-y: hidden;
    }

    /* Mantiene tamaño exacto de la gráfica sin que se deforme */
    .grafica-inner {
        width: 800px;
        /* el mismo ancho que tu gráfico */
        margin: 0 auto;
    }

    .grafica-container canvas {
        max-height: 420px !important;
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
                <div class="grafica-container">
          <!-- En tu vista Blade -->
<div class="grafica-scroll" style="overflow-x: auto;">
    <div class="grafica-inner" style="min-width: 800px; height: 420px;">
        <x-chartjs-component :chart="$grafico" />
    </div>
</div>       </div>

            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card shadow-lg border-0 h-100">
                <div class="card-header bg-light border-bottom fw-bold text-primary py-3">
                    <i class="bi bi-pie-chart-fill me-2"></i> Relación Ingresos/Gastos Total
                </div>
                <div class="card-body d-flex align-items-center justify-content-center">
                    <div style="width:300px;height:300px;margin:auto;">
                        <x-chartjs-component :chart="$donut" />
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
document.addEventListener("DOMContentLoaded", function () {

    const chart = Chart.getChart('graficaNormalCosechas');
    if (!chart) return;

    chart.options.plugins.tooltip.callbacks = {

        label: function (context) {
            let datasetLabel = context.dataset.label;
            let value = context.raw || 0;
            return datasetLabel + ': $' + Number(value).toLocaleString('es-CO');
        },

        afterBody: function (context) {

            let index = context[0].dataIndex;
            let chartInst = context[0].chart;

            let ingresosDataset = chartInst.data.datasets[0];

            let ingresos = ingresosDataset.data[index];
            let gastos   = chartInst.data.datasets[1].data[index];
            let ganancia = ingresos - gastos;

            // 🌱 CORRECTO → el nombre del cultivo viene en customData
            let tipoCultivo = ingresosDataset.customData[index];

            let fecha = chartInst.data.labels[index];

            return [
                'Cultivo: ' + tipoCultivo,
                'Fecha: ' + fecha,
                'Ganancia: $' + ganancia.toLocaleString('es-CO'),
            ];
        }
    };

    chart.update();
});
</script>


@endpush
@endsection