@extends('layouts.app') {{-- Cambiado a la plantilla maestra de Laravel-AdminLTE --}}

@section('title', 'Gestión de Fincas')

@section('content_header')
<h1 class="text-dark"><i class="fas fa-fw fa-tractor"></i> Gestión de Fincas</h1>
@stop

@section('content')

{{-- Contenedor de Acciones (Botones Superiores) --}}
<div class="mb-4 d-flex justify-content-between">
    <a href="{{ route('Fincas.create') }}" class="btn btn-success shadow">
        <i class="fas fa-fw fa-plus-circle"></i> Nueva Finca
    </a>
</div>

{{-- CUADRÍCULA DE FINCAS (Usa Bootstrap Row) --}}
<div class="row">
    @forelse($fincas as $finca)

    <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
        {{-- La tarjeta de la finca --}}
        <div class="card h-100 shadow-lg border-0">

            {{-- Encabezado con Ícono y Nombre --}}
            <div class="card-header card-header-finca border-0 py-3 d-flex justify-content-between align-items-center">
                <div class="col-11">
                <h5 class="mb-0 fw-bold">
                    <i class="fas fa-fw fa-tractor me-3"></i> {{ $finca->nombre }}
                </h5></div>
                <div class="col-1">
                <div class="dropdown position-left top-2 end-2 mt-0 me-0 ">
                    <button class=""
                        type="button"
                        data-toggle="dropdown"
                        aria-expanded="true"
                        title="Más opciones">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">


                        {{-- Editar --}}
                        <li>
                            <a href="{{ route('Fincas.edit', $finca->id) }}" class="dropdown-item text-warning">
                                <i class="fas fa-fw fa-edit me-2" style="color:#FFE70F !important;"></i> Editar
                            </a>
                        </li>

                        {{-- Eliminar --}}
                        <li>
                            <form action="{{ route('Fincas.destroy', $finca->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger"
                                    onclick="confirmarEliminacion(event)">
                                    <i class="fas fa-fw fa-trash-alt me-2" style="color:#F82B2B !important;"></i> Eliminar
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
                </div>
            </div>



            {{-- Cuerpo de la Tarjeta (Información) --}}
            <div class="card-body">

                <!-- {{-- Detalles de la Finca --}}
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <small class="text-muted">ID:</small>
                    <span class="badge bg-secondary rounded-pill">{{ $finca->id }}</span>
                </div> -->

                <div class="d-flex align-items-center mb-0">
                    <i class="fas fa-fw fa-map-marker-alt text-danger me-2"></i>
                    <span class="fw-semibold">{{ $finca->ubicacion }}</span>
                </div>

            </div>

            {{-- Pie de Página (Acciones) --}}
            <div class="card-footer bg-light p-2">

                <div class="d-grid gap-2 mb-1">
                    {{-- Acción Principal --}}
                    <a href="{{ route('Invernaderos.index',$finca->id) }}"
                        class="btn btn-info btn-block shadow-sm">
                        <i class="fas fa-fw fa-seedling"></i> Administrar Invernaderos
                    </a>
                </div>

                {{-- Acciones Secundarias --}}

            </div>
        </div>
    </div>


    @empty
    {{-- Mensaje si no hay fincas --}}
    <div class="col-12">
        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i> No hay fincas registradas aún. ¡Crea una para empezar!
        </div>
    </div>
    @endforelse




</div>

<a href="{{ route('welcome') }}" class="btn btn-secondary shadow">
    <i class="fas fa-fw fa-arrow-left"></i> Volver al Inicio
</a>

@stop