@extends('layouts.app')
@section('title','Estado Cosecha')

@section('titleContent')
<h1 class="text-center">Gestion Estado Cosecha</h1>

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
        <a href="{{route('EstadosCosecha.create')}}" class="btn btn-success"><i class="bi bi-plus-circle"></i> Nueva Estado</a>
        <table class="table table-bordered table-hover">
            <thead class="table-success">
                <tr>
                    <th>id</th>
                    <th>nombre</th>
                    <th>opciones</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($estadosCosecha as $estado )
                <tr>

                    <td>{{$estado->id}}</td>
                    <td>{{$estado->nombre}}</td>
                    <td class="">
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{route('EstadosCosecha.edit',$estado->id)}}"
                                class="btn btn-warning shadow-sm btn-accion">
                                <i class="bi bi-pencil-square"></i> Editar
                            </a>
                            <form action="{{route('EstadosCosecha.destroy',$estado->id)}}" method="POST">
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
    @endsection