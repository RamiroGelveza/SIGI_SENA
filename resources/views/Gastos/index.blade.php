@extends('layouts.app')
@section('title','Gastos')

@section('titleContent')
<h1 class="text-center">Gestion Gastos</h1>

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
        <a href="{{route('Gastos.create',$idcosecha)}}" class="btn btn-success"><i class="bi bi-plus-circle"></i> Registrar Gasto</a>

        <table class="table table-bordered table-hover">
            <thead class="table-success">
                <tr>
                    <th>id</th>
                    <th>fecha</th>
                    <th>descripcion</th>
                    <th>monto</th>
                    <th>cosecha</th>
                    <th>categoria Gastos</th>
                    <th>opciones</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($gastos as $gasto )
                <tr>

                    <td>{{$gasto->id}}</td>
                    <td>{{$gasto->fecha}}</td>
                    <td>{{$gasto->descripcion}}</td>
                    <td>{{$gasto->monto}}</td>
                    <td>{{$gasto->idCosecha}}</td>
                    <td>{{$gasto->idCategoriaGastos}}</td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{route('Gastos.edit',$gasto->id)}}"
                                class="btn btn-warning shadow-sm btn-accion">
                                <i class="bi bi-pencil-square"></i> Editar
                            </a>
                            <form action="{{route('Gastos.destroy',$gasto->id)}}" method="POST">
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
        <a href="" class="btn btn-info"><i class="bi bi-arrow-left-circle"></i> Volver</a>

    </div>
    @endsection