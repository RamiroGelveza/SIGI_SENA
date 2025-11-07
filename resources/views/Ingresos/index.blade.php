@extends('layouts.app')
@section('title','Ingreso')

@section('titleContent')
<h1 class="text-center">Gestion Ingresos</h1>

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
        <a href="{{route('Ingresos.create',$idcosecha)}}" class="btn btn-success"><i class="bi bi-plus-circle"></i> Nuevo Ingreso</a>

        <table class="table table-bordered table-hover">
            <thead class="table-success">
                <tr>
                    <th>id</th>
                    <th>fecha</th>
                    <th>descripcion</th>
                    <th>cantidadVendida</th>
                    <th>precioUnitario</th>
                    <th>Cosecha</th>
                    <th>opciones</th>

                </tr>
            </thead>
            <tbody>

                @foreach ($ingresos as $ingreso )
                <tr>

                    <td>{{$ingreso->id}}</td>
                    <td>{{$ingreso->fecha}}</td>
                    <td>{{$ingreso->descripcion}}</td>
                    <td>{{$ingreso->cantidadVendida}}</td>
                    <td>{{$ingreso->precioUnitario}}</td>
                   <td>{{ $ingreso->cosecha->tiposCultivo->nombre ?? 'Sin cultivo' }}</td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{route('Ingresos.edit',$ingreso->id)}}"
                                class="btn btn-warning shadow-sm btn-accion">
                                <i class="bi bi-pencil-square"></i> Editar
                            </a>
                            <form action="{{route('Ingresos.destroy',$ingreso->id)}}" method="POST">
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