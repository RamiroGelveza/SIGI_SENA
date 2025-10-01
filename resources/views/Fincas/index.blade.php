@extends('adminlte::page') {{-- Cambiado a la plantilla maestra de Laravel-AdminLTE --}}

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
                    <div class="card-header bg-primary text-white border-0 py-3">
                        <h5 class="mb-0 fw-bold">
                            <i class="fas fa-fw fa-tractor me-2"></i> {{ $finca->nombre }}
                        </h5>
                    </div>

                    {{-- Cuerpo de la Tarjeta (Información) --}}
                    <div class="card-body">

                        {{-- Detalles de la Finca --}}
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <small class="text-muted">ID:</small>
                            <span class="badge bg-secondary rounded-pill">{{ $finca->id }}</span>
                        </div>

                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-fw fa-map-marker-alt text-danger me-2"></i>
                            <span class="fw-semibold">{{ $finca->ubicacion }}</span>
                        </div>

                    </div>

                    {{-- Pie de Página (Acciones) --}}
                    <div class="card-footer bg-light p-3">

                        <div class="d-grid gap-2 mb-2">
                            {{-- Acción Principal --}}
                            <a href="{{ route('Invernaderos.index',$finca->id) }}"
                               class="btn btn-info btn-block shadow-sm">
                                <i class="fas fa-fw fa-seedling"></i> Administrar Invernaderos
                            </a>
                        </div>

                        {{-- Acciones Secundarias --}}
                        <div class="d-flex gap-2">

                            {{-- Botón Editar --}}
                            <a href="{{ route('Fincas.edit',$finca->id) }}"
                               class="btn btn-warning btn-sm flex-fill shadow-sm">
                                <i class="fas fa-fw fa-edit"></i> Editar
                            </a>

                            {{-- Formulario Eliminar --}}
                            <form action="{{ route('Fincas.destroy',$finca->id) }}" method="POST" class="flex-fill">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm w-100 shadow-sm"
                                        onclick="confirmarEliminacion(event)">
                                    <i class="fas fa-fw fa-trash-alt"></i> Eliminar
                                </button>
                            </form>
                        </div>
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

@section('js')
    {{-- La función de confirmar eliminación se pone aquí si usas SweetAlert2 --}}
    <script>
        function confirmarEliminacion(event) {
            // ... (Tu código de SweetAlert2 aquí)
            event.preventDefault();
            const form = event.target.closest('form');

            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    </script>
@stop
