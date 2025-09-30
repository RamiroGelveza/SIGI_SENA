@extends('layouts.app')

@section('title','Fincas')

@section('titleContent')
<h1 class="text-center">Gestion Fincas</h1>
@endsection
@section('content')

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

<body class="bg-light">
    <div class="container">
        <a href="{{route('Fincas.create')}}" class="btn btn-success"><i class="bi bi-plus-circle"></i> Nueva Finca</a>

        <table class="table table-bordered table-hover">
            <thead class="table-success">
                <tr>
                    <th>id</th>
                    <th>nombre</th>
                    <th>ubicacion</th>
                    <th>opciones</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($fincas as $finca )
                <tr>

                    <td>{{$finca->id}}</td>
                    <td>{{$finca->nombre}}</td>
                    <td>{{$finca->ubicacion}}</td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">

                        <a href="{{route('Invernaderos.index',$finca->id)}}"
                                class="btn btn-info shadow-sm btn-accion">
                                <i class="bi bi-pencil-square"></i> Administrar Invernaderos
                            </a>

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
                    </td>


                </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{route('welcome')}}" class="btn btn-info"><i class="bi bi-arrow-left-circle"></i> Volver</a>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    @endsection