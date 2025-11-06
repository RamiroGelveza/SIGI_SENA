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
    <!-- 
    {{-- 🔹 MÉTRICAS PRINCIPALES --}}
    @php
        $totalIngresos = $cosechas->sum('totalIngresos');
        $totalGastos = $cosechas->sum('totalGastos');
        $utilidadTotal = $cosechas->sum('utilidad');
        $rentabilidad = $totalGastos > 0 ? round(($utilidadTotal / $totalGastos) * 100, 1) : 0;
    @endphp -->

    <div class="row g-3 mb-4">
    <div class="col-md-3">
        <a href="{{ route('Ingresos.index','idcosecha')}}" class="text-decoration-none d-block card-link">
            <div class="card bg-success text-white border-0 shadow-lg h-100 animated-card">
                <div class="card-body text-center d-flex flex-column justify-content-center align-items-center p-3">
                    <i class="bi bi-cash-stack fs-1 mb-2"></i>
                    <h6 class="text-uppercase mb-1">Ingresos Totales</h6>
                    <h3 class="display-4 font-weight-bold">${{ number_format($totalIngresos, 0, ',', '.') }}</h3>
                    <div class="mt-3 pt-2 w-100 border-top border-white border-opacity-50">
                        <span class="d-block small text-white-50">
                            Ver detalles <i class="fas fa-arrow-circle-right ms-1"></i>
                        </span>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-3">
        <a href="{{ route('Gastos.index','idcosecha')}}" class="text-decoration-none d-block card-link">
            <div class="card bg-danger text-white border-0 shadow-lg h-100 animated-card">
                <div class="card-body text-center d-flex flex-column justify-content-center align-items-center p-3">
                    <i class="bi bi-credit-card-2-front fs-1 mb-2"></i>
                    <h6 class="text-uppercase mb-1">Gastos Totales</h6>
                    <h3 class="display-4 font-weight-bold">${{ number_format($totalGastos, 0, ',', '.') }}</h3>
                    <div class="mt-3 pt-2 w-100 border-top border-white border-opacity-50">
                        <span class="d-block small text-white-50">
                            Ver detalles <i class="fas fa-arrow-circle-right ms-1"></i>
                        </span>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-3">
        <div class="card bg-info text-white border-0 shadow-lg h-100">
            <div class="card-body text-center d-flex flex-column justify-content-center align-items-center p-3">
                <i class="bi bi-graph-up-arrow fs-1 mb-2"></i>
                <h6 class="text-uppercase mb-1">Utilidad Neta</h6>
                <h3 class="display-4 font-weight-bold">${{ number_format($utilidadTotal, 0, ',', '.') }}</h3>
                <div class="mt-3 pt-2 w-100 border-top border-white border-opacity-50">
                    <span class="d-block small text-white-50">
                        Valor Actual
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-primary text-white border-0 shadow-lg h-100">
            <div class="card-body text-center d-flex flex-column justify-content-center align-items-center p-3">
                <i class="bi bi-percent fs-1 mb-2"></i>
                <h6 class="text-uppercase mb-1">Rentabilidad Promedio</h6>
                <h3 class="display-4 font-weight-bold">{{ $rentabilidad }}%</h3>
                <div class="mt-3 pt-2 w-100 border-top border-white border-opacity-50">
                    <span class="d-block small text-white-50">
                        Promedio Histórico
                    </span>
                </div>
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
                    <th>Accion</th>
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
                     
                    <td class="text-center">

                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{route('administrar')}}" class=" btn btn-info shadow-sm ">Administrar</a>
                            <a href="{{route('Cosechas.edit',$cosecha->id)}}"
                                class="btn btn-warning shadow-sm ">
                                <i class="bi bi-pencil-square"></i> 
                            </a>
                            <form action="{{route('Cosechas.destroy',$cosecha->id)}}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger shadow-sm "
                                    onclick="confirmarEliminacion(event)">
                                    <i class="bi bi-trash3"></i> 
                                </button>
                            </form>
                        </div>
                    </td>


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