@extends('layouts.app')

@section('title', 'Gestión de Invernaderos')

@section('content_header')
<h1 class="text-dark">
    <i class="fas fa-fw fa-seedling me-2"></i> Gestión de Invernaderos

    {{-- Muestra el nombre de la finca para dar contexto --}}
    @if(isset($fincaNombre))
    <small class="text-muted fw-light">en la Finca: {{ $fincaNombre }}</small>
    @endif
</h1>
@stop

@section('content')

{{-- Contenedor de Acciones (Botones Superiores) --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <a href="{{ route('Invernaderos.create', $idfinca) }}" 
       class="btn btn-primary btn-lg shadow-sm lift-up-effect">
        <i class="fas fa-plus-circle me-2"></i> Registrar Nuevo Invernadero
    </a>

    <a href="{{ route('Fincas.index') }}" 
       class="btn btn-outline-secondary btn-lg fw-bold">
        <i class="fas fa-arrow-left me-2"></i> Volver a Fincas
    </a>
</div>


{{-- CUADRÍCULA DE INVERNADEROS --}}
<div class="row g-4">
    @forelse ($invernaderos as $invernadero )

    <div class="col-12 col-sm-6 col-md-4 col-lg-3">

        <div class="card h-100 shadow-lg border-0 card-invernadero lift-up-effect">

            {{-- Encabezado con Nombre y Menú de Acciones --}}
            <div class="card-header bg-primary text-white py-3 d-flex justify-content-between align-items-center">
                <div class="col-9">
                <h5 class="mb-0 fw-bold text-truncate">
                    <i class="fas fa-fw fa-warehouse me-2"></i> {{ $invernadero->nombre }}
                </h5>
                </div>

                {{-- Dropdown de Opciones --}}
                <div class="dropdown">
                    <button class="btn btn-sm btn-light p-0 px-1 rounded-circle shadow-sm"
                        type="button"
                        data-toggle="dropdown"
                        aria-expanded="false"
                        title="Más opciones">
                        <i class="fas fa-ellipsis-v text-dark"></i>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-right shadow-lg" aria-labelledby="dropdownMenuButton">
                        {{-- Editar --}}
                        <li>
                            <a href="{{ route('Invernaderos.edit', $invernadero->id) }}" class="dropdown-item text-warning">
                                <i class="fas fa-fw fa-edit me-2"></i> Editar Invernadero
                            </a>
                        </li>
                        <div class="dropdown-divider"></div>

                        {{-- Eliminar --}}
                        <li>
                            <form action="{{ route('Invernaderos.destroy', $invernadero->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit"
                                    class="dropdown-item text-danger"
                                    onclick="confirmarEliminacion(event)">
                                    <i class="fas fa-fw fa-trash-alt me-2"></i> Eliminar
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>

            </div>


            {{-- Cuerpo de la Tarjeta (Información Detallada) --}}
            <div class="card-body p-3">

                {{-- Indicador de Cosecha Activa (Ejemplo de lógica condicional) --}}
                <div class="mb-3 text-center">
                    @if($invernadero->tieneCosechas())
                    <span class="badge bg-success py-2 w-100 fw-bold">
                        <i class="fas fa-check-circle me-1"></i> Con Cosecha Registrada
                    </span>
                    @else
                    <span class="badge bg-warning py-2 w-100 fw-bold text-dark">
                        <i class="fas fa-exclamation-triangle me-1"></i> Sin Cosecha Registrada
                    </span>
                    @endif
                </div>


                <ul class="list-group list-group-flush border-bottom pb-3 mb-3">
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                        <strong class="text-muted small"><i class="fas fa-layer-group me-2 text-primary"></i> Capacidad:</strong>
                        <span class="fw-semibold">{{ $invernadero->tamaño }} Plántulas</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                        <strong class="text-muted small"><i class="fas fa-dollar-sign me-2 text-success"></i> Costo Construccion:</strong>
                        <span class="text-success fw-bold">${{ number_format($invernadero->costoConstruccion, 0, ',', '.') }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                        <strong class="text-muted small"><i class="fas fa-history me-2 text-secondary"></i> Cosechas registradas:</strong>
                        <span class="badge bg-secondary rounded-pill">{{ \App\Models\Invernadero::contarCosechasPorId($invernadero->id) }}</span>
                    </li>
                </ul>

            </div>

            {{-- Pie de Página (Acciones Principales) --}}
            <div class="card-footer bg-light p-3 d-grid gap-2">
                
                <!-- <a href="" class="btn btn-success btn-block shadow-sm fw-bold">Reportes</a> -->
            <!-- BOTÓN en cada card (dentro del foreach) -->
<button class="btn btn-success btn-sm"
    data-bs-toggle="modal"
    data-bs-target="#modalReporteInvernadero"
   onclick="setInvernadero('{{ $invernadero->id }}')">
    <i class="fas fa-file-pdf"></i> Reporte
</button>




                {{-- Acción Principal 1: Gestionar Cosecha --}}
                <a href="{{ route('Cosechas.index', $invernadero->id)}}" class="btn btn-info btn-block shadow-sm fw-bold">
                    <i class="fas fa-leaf me-1"></i> Gestionar Invernadero
                </a>

                {{-- Acción Principal 2: Gestionar Mantenimientos --}}
                <a href="{{ route('MantenimientoInvernadero.index', ['idinvernadero' => $invernadero->id]) }}" class="btn btn-warning btn-block shadow-sm fw-bold text-dark">
                    <i class="fas fa-tools me-1"></i> Mantenimiento
                </a>

            </div>
        </div>
    </div>
    <!-- Button trigger modal -->
@include('Reportes.InvernaderoReportes.InvernaderoReportes',['invernadero' => $invernadero])


    @empty
    {{-- Mensaje si no hay invernaderos --}}
    <div class="col-12">
        <div class="alert alert-info shadow-sm py-4 mt-3 text-center">
            <h4 class="alert-heading"><i class="fas fa-info-circle me-2"></i> ¡Zona de Producción Vacía!</h4>
            <p class="mb-0">No hay invernaderos registrados para esta finca. Haz clic en **Registrar Nuevo Invernadero** para comenzar.</p>
        </div>
    </div>
    @endforelse
</div>

@stop

@push('css')
<style>
    /* Estilos para la tarjeta de Invernadero */
    .card-invernadero {
        border-radius: 15px;
        /* Bordes más suaves */
        overflow: hidden;
        border: 1px solid #e9ecef;
    }

    .card-invernadero .card-header {
        /* Usamos Primary para darle importancia */
        background-color: #007bff !important;
        color: white;
        padding-top: 15px;
        padding-bottom: 15px;
        border-bottom: 3px solid #0056b3;
        /* Línea de color para contraste */
    }

    /* Efecto Hover (Lift-up) - Aplicado a todas las cards */
    .lift-up-effect {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .lift-up-effect:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2) !important;
    }

    /* Listas dentro del cuerpo de la tarjeta */
    .list-group-flush .list-group-item {
        border: none;
        border-bottom: 1px dashed #e9ecef;
        /* Separador sutil */
    }

    .list-group-flush .list-group-item:last-child {
        border-bottom: none;
    }

    /* Botones de acción principales en el footer */
    .card-footer {
        background-color: #f8f9fa !important;
    }

    .card-footer .btn {
        font-size: 0.95rem;
    }

    /* Ajuste de colores para los contadores y botones */
    .text-primary {
        color: #007bff !important;
    }

    .text-success {
        color: #28a745 !important;
    }

    .btn-info {
        background-color: #17a2b8;
        border-color: #17a2b8;
    }

    .btn-warning {
        background-color: #ffc107;
        border-color: #ffc107;
    }
</style>
@endpush

@push('js')
<script>
    // Función de confirmación de eliminación
    function confirmarEliminacion(event) {
        event.preventDefault();

        // Puedes reemplazar esto con SweetAlert2 si lo tienes configurado
        if (confirm('⚠️ ¿Está seguro de ELIMINAR este Invernadero? Todas las Cosechas y datos de Mantenimiento asociados se perderán.')) {
            event.target.closest('form').submit();
        }
    }
</script>
@endpush