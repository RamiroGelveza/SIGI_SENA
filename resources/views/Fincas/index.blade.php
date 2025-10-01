@extends('layouts.app')

@section('title','Fincas')

@section('titleContent')
<h1 class="text-center">Gestion Fincas</h1>
@endsection
@section('content')



<body class="bg-light">
    <div class="container">
        <a href="{{route('Fincas.create')}}" class="btn btn-success"><i class="bi bi-plus-circle"></i> Nueva Finca</a>




                @foreach ($fincas as $finca )

                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100 shadow-sm border-top border-primary border-3">

                            <div class="card-body">

                                <h5 class="card-title text-primary">
                                    <i class="fas fa-fw fa-tractor me-2"></i> {{ $finca->nombre }}
                                </h5>

                                <ul class="list-group list-group-flush mt-3">
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                        <strong>ID:</strong>
                                        <span class="badge bg-secondary">{{ $finca->id }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                        <strong>Ubicación:</strong>
                                        <span><i class="fas fa-fw fa-map-marker-alt me-1"></i> {{ $finca->ubicacion }}</span>
                                    </li>
                                </ul>
                            </div>

                            <div class="card-footer bg-light p-3">
                                <div class="d-grid gap-2">

                                    <a href="{{route('Invernaderos.index',$finca->id)}}"
                                                    class="btn btn-info shadow-sm btn-accion">
                                                    <i class="bi bi-pencil-square"></i> Administrar Invernaderos
                                                </a>

                                    <div class="d-flex justify-content-between gap-2">

                                    <a href="{{route('Fincas.edit',$finca->id)}}"
                                                    class="btn btn-warning shadow-sm btn-accion">
                                                    <i class="bi bi-pencil-square"></i> Editar
                                                </a>

                                <form action="{{route('Fincas.destroy',$finca->id)}}" method="POST">
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
                    </div>

                @endforeach


        <a href="{{route('welcome')}}" class="btn btn-info"><i class="bi bi-arrow-left-circle"></i> Volver</a>

    </div>


    <script>
    function confirmarEliminacion(event) {
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    @endsection
