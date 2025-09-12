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
        <a href="{{route('EstadosCosecha.create')}}" class="btn btn-success">Nueva Estado</a>
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
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
                    <td>
                        <a href="{{route('EstadosCosecha.edit',$estado->id)}}" class="btn btn-dark">Actualizar</a>
                        <form action="{{route('EstadosCosecha.destroy',$estado->id)}}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger" onclick="confirmarEliminacion(event)">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{route('welcome')}}" class="btn btn-info">Volver</a>

    </div>
    @endsection