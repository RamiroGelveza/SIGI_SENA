@extends('layouts.app')

@section('title','DASHBOARD')

@section('titleContent')
<h1 class="text-primary fw-bold text-center mb-4">
    <i class="fas fa-cogs"></i> Gestión del Sistema
</h1>
@endsection

@section('content')
<div class="container py-4">
    <div class="row g-4 justify-content-center">

        <!-- Fincas -->
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <i class="fas fa-seedling fa-2x text-primary"></i>
                    </div>
                    <h5 class="fw-semibold text-dark">Fincas</h5>
                    <p class="text-muted small mb-4">Administra fácilmente la información de tus Fincas.</p>
                    <a href="{{ route('Fincas.index') }}" class="btn btn-outline-success rounded-pill w-100">
                        Gestionar Fincas
                    </a>
                </div>
            </div>
        </div>

        <!-- Invernaderos -->
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <i class="fas fa-home fa-2x text-primary"></i>
                    </div>
                    <h5 class="fw-semibold text-dark">Invernaderos</h5>
                    <p class="text-muted small mb-4">Lleva un control completo de tus Invernaderos.</p>
                    <a href="{{ route('Invernaderos.index') }}" class="btn btn-outline-primary rounded-pill w-100">
                        Gestionar Invernaderos
                    </a>
                </div>
            </div>
        </div>

        <!-- Categoría Gastos -->
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <i class="fas fa-wallet fa-2x text-primary"></i>
                    </div>
                    <h5 class="fw-semibold text-dark">Categoría Gastos</h5>
                    <p class="text-muted small mb-4">Lleva un control detallado de la Categoría de Gastos.</p>
                    <a href="{{ route('CategoriaGastos.index') }}" class="btn btn-outline-success rounded-pill w-100">
                        Gestionar Categoria Gastos
                    </a>
                </div>
            </div>
        </div>

        <!-- Tipos de Cultivos -->
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <i class="fas fa-leaf fa-2x text-primary"></i>
                    </div>
                    <h5 class="fw-semibold text-dark">Tipos de Cultivos</h5>
                    <p class="text-muted small mb-4">Control de las diferentes categorías de Cultivos.</p>
                    <a href="{{ route('TiposCultivos.index') }}" class="btn btn-outline-primary rounded-pill w-100">
                        Gestionar Cultivos
                    </a>
                </div>
            </div>
        </div>

        <!-- Mantenimiento Invernadero -->
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <i class="fas fa-tools fa-2x text-primary"></i>
                    </div>
                    <h5 class="fw-semibold text-dark">Mantenimiento Invernadero</h5>
                    <p class="text-muted small mb-4">Control de los mantenimientos realizados a los Invernaderos.</p>
                    <a href="{{ route('MantenimientoInverndero.index') }}" class="btn btn-outline-success rounded-pill w-100">
                        Gestionar Mantenimientos
                    </a>
                </div>
            </div>
        </div>

        <!-- Estados de Cosecha -->
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <i class="fas fa-tasks fa-2x text-primary"></i>
                    </div>
                    <h5 class="fw-semibold text-dark">Estados de Cosecha</h5>
                    <p class="text-muted small mb-4">Registra y controla los diferentes estados de las cosechas.</p>
                    <a href="{{ route('EstadosCosecha.index') }}" class="btn btn-outline-primary rounded-pill w-100">
                        Gestionar Estados Cosecha
                    </a>
                </div>
            </div>
        </div>

        <!-- Cosecha -->
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <i class="fas fa-tractor fa-2x text-primary"></i>
                    </div>
                    <h5 class="fw-semibold text-dark">Cosecha</h5>
                    <p class="text-muted small mb-4">Registra y controla la gestión de la cosecha.</p>
                    <a href="{{ route('Cosechas.index') }}" class="btn btn-outline-success rounded-pill w-100">
                        Gestionar Cosecha
                    </a>
                </div>
            </div>
        </div>

        <!-- Ingresos -->
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <i class="fas fa-dollar-sign fa-2x text-primary"></i>
                    </div>
                    <h5 class="fw-semibold text-dark">Ingresos</h5>
                    <p class="text-muted small mb-4">Registra y controla la gestión de los Ingresos.</p>
                    <a href="{{ route('Ingresos.index') }}" class="btn btn-outline-primary rounded-pill w-100">
                        Gestionar Ingresos
                    </a>
                </div>
            </div>
        </div>

        <!-- Gastos -->
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <i class="fas fa-credit-card fa-2x text-primary"></i>
                    </div>
                    <h5 class="fw-semibold text-dark">Gastos</h5>
                    <p class="text-muted small mb-4">Registra y controla la gestión de los Gastos.</p>
                    <a href="{{ route('Gastos.index') }}" class="btn btn-outline-success rounded-pill w-100">
                        Gestionar Gastos
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection

@push('css')
<style>
/* Estilo agropecuario moderno */
.card {
    border: 1px solid #dfe6dd; /* Borde sutil */
    border-radius: 18px;
    background: #ffffff; /* Fondo blanco limpio */
    color: #3a3a3a; 
    box-shadow: 0 3px 8px rgba(0, 0, 0, 0.08);
    transition: transform 0.25s ease, box-shadow 0.25s ease;
    overflow: hidden;
}

/* Hover efecto */
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
    border-color: #a7c957; /* Verde claro */
}

/* Encabezado con franja superior */
.card::before {
    content: "";
    display: block;
    height: 6px;
    background: linear-gradient(90deg, #6a994e, #a9d6e5);
}

/* Iconos */
.card i {
    font-size: 2.2rem;
    color: #6a994e; /* Verde oliva */
    margin-bottom: 12px;
}

/* Título */
.card-title {
    font-weight: 700;
    font-size: 1.15rem;
    color: #283618; /* Verde bosque */
    margin-top: 5px;
}

/* Texto */
.card-text {
    font-size: 0.95rem;
    color: #606c38; /* Verde suave tierra */
    margin-bottom: 15px;
}

/* Botón */
.card .btn {
    background-color: #6a994e;
    border: none;
    color: #fff;
    font-weight: 500;
    border-radius: 30px;
    padding: 8px 18px;
    transition: background 0.3s ease;
}

.card .btn:hover {
    background-color: #386641; /* Verde más profundo */
}


</style>
@endpush