

@extends('layouts.app') 

@section('title', 'Gestión de Fincas')

@section('content_header')
<h1 class="text-dark"><i class="fas fa-fw fa-tractor me-2"></i> Gestión de Fincas</h1>
@stop

@section('content')

{{-- Contenedor de Acciones (Botones Superiores) --}}
<div class="mb-4 d-flex justify-content-between">
    <a href="{{ route('Fincas.create') }}" class="btn btn-success btn-lg shadow-sm lift-up-effect">
        <i class="fas fa-fw fa-plus-circle me-1"></i> Registrar Nueva Finca
    </a>
    
    <a href="{{ route('welcome') }}" class="btn btn-outline-secondary btn-lg fw-bold">
        <i class="fas fa-fw fa-arrow-left me-1"></i> Volver al Dashboard
    </a>

</div>

{{-- CUADRÍCULA DE FINCAS --}}
<div class="row g-4">
    @forelse($fincas as $finca)

    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
        {{-- La tarjeta de la finca --}}
        <div class="card h-100 shadow-lg border-0 card-finca lift-up-effect">

            {{-- Encabezado con Ícono, Nombre y Menú de Acciones --}}
            <div class="card-header bg-success text-white py-3 d-flex justify-content-between align-items-center">
                <div class="col-9">
                {{-- Nombre de la Finca --}}
                <h5 class="mb-0 fw-bold text-truncate">
                    <i class="fas fa-fw fa-map-marked-alt me-2"></i> {{ $finca->nombre }}
                </h5>
                </div>
                {{-- Dropdown de Acciones --}}
                <div class="dropdown">
                    <button class="btn btn-sm btn-light p-0 px-1 rounded-circle shadow-sm"
                        type="button"
                        data-toggle="dropdown"
                        aria-expanded="false"
                        title="Más opciones">
                        <i class="fas fa-ellipsis-v text-dark"></i>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        <!-- {{-- Administrar Invernaderos (Duplicado para acceso rápido) --}}
                        <li>
                            <a href="{{ route('Invernaderos.index', $finca->id) }}" class="dropdown-item text-info">
                                <i class="fas fa-fw fa-seedling me-2"></i> Ver Invernaderos
                            </a>
                        </li> -->
                        <!-- <div class="dropdown-divider"></div> -->

                        {{-- Editar --}}
                        <li>
                            <a href="{{ route('Fincas.edit', $finca->id) }}" class="dropdown-item text-warning">
                                <i class="fas fa-fw fa-edit me-2" style="color:#FFE70F !important;"></i> Editar Finca
                            </a>
                        </li>
                            <div class="dropdown-divider"></div>
                        {{-- Eliminar --}}
                        <li>
                            <form action="{{ route('Fincas.destroy', $finca->id) }}" method="POST" class="d-inline">
                                @csrf
                                     <button type="submit"
                                    class="dropdown-item text-danger"
                                    onclick="confirmarEliminacion(event)">
                                    <i class="fas fa-fw fa-trash-alt me-2" style="color:#F82B2B !important;"></i>
                                    Eliminar
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>


            {{-- Cuerpo de la Tarjeta (Información) --}}
            <div class="card-body p-3">
                
                {{-- Ubicación --}}
                <div class="d-flex align-items-start mb-3">
                    <i class="fas fa-fw fa-map-marker-alt text-secondary me-2 mt-1"></i>
                    <p class="mb-0 small text-muted text-truncate" title="Ubicación">
                        {{ $finca->ubicacion ?? 'Ubicación no especificada' }}
                    </p>
                </div>
                
                {{-- Contadores de Invernaderos y Cosechas (Datos simulados si no existen en el objeto) --}}
                <div class="row text-center mt-3 border-top pt-3">
                    
                    {{-- Contador de Invernaderos --}}
                    <div class="col-6">
                        <h4 class="fw-bolder text-info mb-0">
                             {{ \App\Models\Finca::contarInvernaderosPorId($finca->id) }}
                        </h4>
                        <small class="text-muted">Invernaderos</small>
                    </div>

                    {{-- Contador de Cosechas (Simulado) --}}
                    <div class="col-6 border-left">
                        <h4 class="fw-bolder text-warning mb-0">
                            {{ $finca->contarCosechas($finca->id) }}
                        </h4>
                        <small class="text-muted">Historial Cosechas</small>
                    </div>
                </div>

            </div>

            {{-- Pie de Página (Acción Principal) --}}
            <div class="card-footer bg-light p-2 border-top-0">
                <a href="{{ route('Invernaderos.index', ['idfinca' => $finca->id]) }}"
                    class="btn btn-info btn-block w-100 shadow-sm fw-bold">
                    <i class="fas fa-fw fa-seedling me-1"></i> Administrar Invernaderos
                </a>
            </div>
        </div>
    </div>


    @empty
    {{-- Mensaje si no hay fincas --}}
    <div class="col-12">
        <div class="alert alert-info shadow-sm py-4 mt-3 text-center">
            <h4 class="alert-heading"><i class="fas fa-info-circle me-2"></i> ¡Comienza a gestionar!</h4>
            <p class="mb-0">No hay fincas registradas aún. Haz clic en **Registrar Nueva Finca** para empezar tu gestión agrícola.</p>
        </div>
    </div>
    @endforelse
</div>

@stop

@push('css')
<style>
    /* Estilos para la tarjeta de Finca */
    .card-finca {
        border-radius: 12px;
        overflow: hidden;
        border-left: 5px solid #6a994e; /* Borde de color verde agrícola */
    }

    .card-finca .card-header {
        background-color: #6a994e !important; /* Verde oliva/success */
        color: white;
        padding-top: 15px;
        padding-bottom: 15px;
    }

    .card-finca .card-header i {
        color: #f2e8cf; /* Color claro para contraste */
    }
    
    /* Efecto Hover (Lift-up) */
    .lift-up-effect {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .lift-up-effect:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15) !important;
    }

    /* Botón de opciones más discreto */
    .dropdown button {
        background: transparent ;
        border: none ;
    }
</style>
@endpush

