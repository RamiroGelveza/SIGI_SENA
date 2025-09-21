@extends('layouts.app')

@section('title','DASHBOARD')

@section('titleContent')
    <h1 class="text-primary fw-bold text-center mb-4">
        <i class="fas fa-cogs"></i> Gestión del Sistema
    </h1>
@endsection

@section('content')
    <div class="container ">
        <div class="row g-4 justify-content-center">

            <!-- Tarjeta Fincas -->
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-lg border-0 rounded-4 h-100">
                    <div class="card-body text-center p-4">
                        <h5 class="card-title text-dark fw-semibold mb-3">Fincas</h5>
                        <p class="card-text text-muted mb-4">
                            Administra fácilmente la información de tus Fincas.
                        </p>
                        <a href="{{ route('Fincas.index') }}" class="btn btn-primary btn-lg rounded-pill">
                            <i class="fas fa-seedling"></i> Gestionar Fincas
                        </a>
                    </div>
                </div>
            </div>

            <!-- Tarjeta Invernadero -->
            <div class="col-md-6 col-lg-4 ">
                <div class="card shadow-lg border-0 rounded-4 h-100">
                    <div class="card-body text-center p-4">
                        <h5 class="card-title text-dark fw-semibold mb-3">Invernaderos</h5>
                        <p class="card-text text-muted mb-4">
                            Lleva un control completo de tus Invernaderos.
                        </p>
                        <a href="{{ route('Invernaderos.index') }}" class="btn btn-success btn-lg rounded-pill">
                            <i class="fas fa-warehouse"></i> Gestionar Invernaderos
                        </a>
                    </div>
                </div>
            </div>

            <!-- Tarjeta Categoría Gastos -->
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-lg border-0 rounded-4 h-100">
                    <div class="card-body text-center p-4">
                        <h5 class="card-title text-dark fw-semibold mb-3">Categoría Gastos</h5>
                        <p class="card-text text-muted mb-4">
                            Lleva un control detallado de la Categoría de Gastos.
                        </p>
                        <a href="{{ route('CategoriaGastos.index') }}" class="btn btn-primary btn-lg rounded-pill">
                            <i class="fas fa-wallet"></i> Gestionar Gastos
                        </a>
                    </div>
                </div>
            </div>

            <!-- Tarjeta Tipos Cultivos -->
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-lg border-0 rounded-4 h-100">
                    <div class="card-body text-center p-4">
                        <h5 class="card-title text-dark fw-semibold mb-3">Tipos de Cultivos</h5>
                        <p class="card-text text-muted mb-4">
                            Control de las diferentes categorías de Cultivos.
                        </p>
                        <a href="{{ route('TiposCultivos.index') }}" class="btn btn-success btn-lg rounded-pill">
                            <i class="fas fa-leaf"></i> Gestionar Cultivos
                        </a>
                    </div>
                </div>
            </div>

            <!-- Tarjeta Mantenimiento Invernadero -->
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-lg border-0 rounded-4 h-100">
                    <div class="card-body text-center p-4">
                        <h5 class="card-title text-dark fw-semibold mb-3">Mantenimiento Invernadero</h5>
                        <p class="card-text text-muted mb-4">
                            Control de los mantenimientos realizados a los Invernaderos.
                        </p>
                        <a href="{{ route('MantenimientoInverndero.index') }}" class="btn btn-primary btn-lg rounded-pill">
                            <i class="fas fa-tools"></i> Gestionar Mantenimientos
                        </a>
                    </div>
                </div>
            </div>

            <!-- Tarjeta Estados de Cosecha -->
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-lg border-0 rounded-4 h-100">
                    <div class="card-body text-center p-4">
                        <h5 class="card-title text-dark fw-semibold mb-3">Estados de Cosecha</h5>
                        <p class="card-text text-muted mb-4">
                            Registra y controla los diferentes estados de las cosechas.
                        </p>
                        <a href="{{ route('EstadosCosecha.index') }}" class="btn btn-success btn-lg rounded-pill">
                            <i class="fas fa-tractor"></i> Gestionar Estados
                        </a>
                    </div>
                </div>
            </div>
            <!-- Tarjeta Cosecha -->
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-lg border-0 rounded-4 h-100">
                    <div class="card-body text-center p-4">
                        <h5 class="card-title text-dark fw-semibold mb-3">Cosecha</h5>
                        <p class="card-text text-muted mb-4">
                            Registra y controla la gestion de la cosecha.
                        </p>
                        <a href="{{ route('Cosechas.index') }}" class="btn btn-success btn-lg rounded-pill">
                            <i class="fas fa-tractor"></i> Gestionar Cosecha
                        </a>
                    </div>
                </div>
            </div>
            <!-- Tarjeta ingresos -->
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-lg border-0 rounded-4 h-100">
                    <div class="card-body text-center p-4">
                        <h5 class="card-title text-dark fw-semibold mb-3">Ingresos</h5>
                        <p class="card-text text-muted mb-4">
                            Registra y controla la gestion de los Ingresos.
                        </p>
                        <a href="{{ route('Ingresos.index') }}" class="btn btn-success btn-lg rounded-pill">
                            <i class="fas fa-tractor"></i> Gestionar Ingresos
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
