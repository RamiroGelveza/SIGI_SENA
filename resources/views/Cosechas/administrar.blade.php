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
   


    <div class="row g-3 mb-4">
    <div class="col-md-3">
        <a href="{{ route('Ingresos.index','idcosecha')}}" class="text-decoration-none d-block card-link">
            <div class="card bg-success text-white border-0 shadow-lg h-100 animated-card">
                <div class="card-body text-center d-flex flex-column justify-content-center align-items-center p-3">
                    <i class="bi bi-cash-stack fs-1 mb-2"></i>
                    <h6 class="text-uppercase mb-1">Ingresos Totales</h6>
                    <h3 class="display-4 font-weight-bold"></h3>
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
                    <h3 class="display-4 font-weight-bold"></h3>
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
                <h3 class="display-4 font-weight-bold"></h3>
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
                <h3 class="display-4 font-weight-bold"></h3>
                <div class="mt-3 pt-2 w-100 border-top border-white border-opacity-50">
                    <span class="d-block small text-white-50">
                        Promedio Histórico
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

