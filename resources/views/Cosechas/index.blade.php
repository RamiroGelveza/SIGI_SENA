@extends('layouts.app')

@section('title', 'Panel de Cosechas')

@section('titleContent')
<div class="text-center my-4">
    <h1 class="fw-bold text-success">🌿 Panel General de Cosechas</h1>
    <p class="text-muted">Visualiza el rendimiento, la rentabilidad y la evolución de tus cosechas de invernadero.</p>
</div>
@endsection

@section('content')
<div class="container-fluid">

    {{-- 🔹 ACCIONES SUPERIORES --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('Cosechas.create', $idinvernadero) }}" class="btn btn-success shadow-sm">
            <i class="bi bi-plus-circle"></i> Registrar Nueva Cosecha
        </a>
        <a href="{{ route('Invernaderos.index', $cosechas->first()->invernadero->idfinca ?? 1) }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left-circle"></i> Volver a Invernaderos
        </a>
    </div>

    {{-- 🔹 MÉTRICAS PRINCIPALES --}}
    @php
        $totalIngresos = $cosechas->sum('totalIngresos');
        $totalGastos = $cosechas->sum('totalGastos');
        $utilidadTotal = $cosechas->sum('utilidad');
        $rentabilidad = $totalGastos > 0 ? round(($utilidadTotal / $totalGastos) * 100, 1) : 0;
    @endphp

    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card bg-light border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-cash-stack text-success fs-3"></i>
                    <h6 class="mt-2">Ingresos Totales</h6>
                    <h3 class="text-success">${{ number_format($totalIngresos, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-light border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-credit-card-2-front text-danger fs-3"></i>
                    <h6 class="mt-2">Gastos Totales</h6>
                    <h3 class="text-danger">${{ number_format($totalGastos, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-light border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-graph-up-arrow text-info fs-3"></i>
                    <h6 class="mt-2">Utilidad Neta</h6>
                    <h3 class="text-info">${{ number_format($utilidadTotal, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-light border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-percent text-primary fs-3"></i>
                    <h6 class="mt-2">Rentabilidad Promedio</h6>
                    <h3 class="text-primary">{{ $rentabilidad }}%</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- 🔹 GRÁFICOS DE DESEMPEÑO --}}
    <div class="row mb-5">
        <div class="col-md-8 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-success text-white fw-bold">
                    Desempeño Económico por Cosecha
                </div>
                <div class="card-body">
                    <canvas id="barChart" style="height: 350px;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white fw-bold">
                    Distribución de Rentabilidad
                </div>
                <div class="card-body">
                    <canvas id="donutChart" style="height: 250px;"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- 🔹 LISTADO DETALLADO DE COSECHAS --}}
    <h4 class="fw-bold text-success mb-3">🌾 Historial de Cosechas</h4>
    <div class="table-responsive">
        <table class="table table-striped align-middle shadow-sm">
            <thead class="table-success text-center">
                <tr>
                    <th>#</th>
                    <th>Cultivo</th>
                    <th>Invernadero</th>
                    <th>Fecha Siembra</th>
                    <th>Fecha Cosecha</th>
                    <th>Ingresos</th>
                    <th>Gastos</th>
                    <th>Utilidad</th>
                    <th>Rentabilidad</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @forelse($cosechas as $cosecha)
                    <tr class="text-center">
                        <td>{{ $cosecha->id }}</td>
                        <td>{{ $cosecha->tiposCultivo->nombre ?? 'Sin definir' }}</td>
                        <td>{{ $cosecha->invernadero->nombre ?? 'N/D' }}</td>
                        <td>{{ $cosecha->fechaSiembra }}</td>
                        <td>{{ $cosecha->fechaCosechaReal ?? 'Pendiente' }}</td>
                        <td>${{ number_format($cosecha->totalIngresos, 0, ',', '.') }}</td>
                        <td>${{ number_format($cosecha->totalGastos, 0, ',', '.') }}</td>
                        <td>${{ number_format($cosecha->utilidad, 0, ',', '.') }}</td>
                        <td>
                            <span class="badge bg-{{ $cosecha->utilidad >= 0 ? 'success' : 'danger' }}">
                                {{ round(($cosecha->utilidad / max($cosecha->totalGastos, 1)) * 100, 1) }}%
                            </span>
                        </td>
                        <td>{{ $cosecha->estadosCosecha->nombre ?? 'Sin estado' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center text-muted">No hay cosechas registradas</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

