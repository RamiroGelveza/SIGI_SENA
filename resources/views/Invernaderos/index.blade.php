@extends('layouts.app')
@section('title','invernadero')

@section('titleContent')
<h1 class="text-center">Gestion Invernaderos</h1>
@endsection

{{-- Título y contexto en el encabezado de contenido --}}
@section('content_header')
    <h1 class="text-dark">
        <i class="fas fa-fw fa-seedling"></i> Gestión de Invernaderos
        {{-- Puedes añadir el nombre de la finca aquí para dar contexto al usuario --}}
        {{-- <small class="text-muted">en la Finca: {{ $invernaderos->first()->Finca->nombre ?? 'N/A' }}</small> --}}
    </h1>
@stop

@section('content')

    {{-- Contenedor de Acciones (Botones Superiores) --}}
    <div class="mb-4 d-flex justify-content-between">
        <a href="{{ route('Invernaderos.create', $idfinca)}}" class="btn btn-success shadow">
            <i class="fas fa-fw fa-plus-circle"></i> Nuevo Invernadero
        </a>
    </div>

    {{-- CUADRÍCULA DE INVERNADEROS (Usa Bootstrap Row) --}}
    <div class="row">
        @forelse ($invernaderos as $invernadero )

            {{-- Define el tamaño de la columna: 1 en móvil, 2 en tablet, 3 en desktop --}}
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">

                <div class="card h-100 shadow-lg border-0">

                    {{-- Encabezado con Ícono y Nombre --}}
                    <div class="card-header bg-info text-white border-0 py-3">
                        <h5 class="mb-0 fw-bold">
                            <i class="fas fa-fw fa-warehouse me-2"></i> {{ $invernadero->nombre }}
                        </h5>
                    </div>

                    {{-- Cuerpo de la Tarjeta (Información Detallada) --}}
                    <div class="card-body">

                        <ul class="list-group list-group-flush mb-3">
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <strong class="text-muted">ID:</strong>
                                <span class="badge bg-secondary rounded-pill">{{ $invernadero->id }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <strong class="text-muted">Tamaño:</strong>
                                <span>{{ $invernadero->tamaño }}-Plantulas</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <strong class="text-muted">Rendimiento:</strong>
                                <span>{{ $invernadero->rendimiento }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <strong class="text-muted">Costo:</strong>
                                <span>${{ number_format($invernadero->costoConstruccion, 0, ',', '.') }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <strong class="text-muted">Finca:</strong>
                                <span class="fw-semibold text-primary">{{ $invernadero->Finca->nombre }}</span>
                            </li>
                        </ul>

                    </div>

                    {{-- Pie de Página (Acciones: Editar y Eliminar) --}}
                    <div class="card-footer bg-light p-3">

                            <div>
                                <a href="{{ route('Cosechas.index',$invernadero->id)}}" class="btn btn-info">Gestionar cosecha</a>
                            </div>

                        <div class="d-flex gap-2">

                            {{-- Botón Editar --}}
                               <a href="{{route('Invernaderos.edit',$idfinca)}}"
                                class="btn btn-warning shadow-sm btn-accion">
                                <i class="bi bi-pencil-square"></i> Editar
                            </a>

                            {{-- Formulario Eliminar --}}
                                        <form action="{{route('Invernaderos.destroy',$invernadero->id)}}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger shadow-sm btn-accion"
                                    onclick="confirmarEliminacion(event)">
                                    <i class="bi bi-trash3"></i> Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        @empty
            {{-- Mensaje si no hay invernaderos --}}
            <div class="col-12">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> No hay invernaderos registrados para esta finca.
                </div>
            </div>
        @endforelse
    </div>

            <a href="{{ route('Fincas.index') }}" class="btn btn-secondary shadow">
            <i class="fas fa-fw fa-arrow-left"></i> Volver a Fincas
        </a>

@stop



