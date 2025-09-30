@extends('layouts.app')
@section('title','Cosechas')

@section('titleContent')
<h1 class="text-center">Gestion Cosechas Invernaderos</h1>

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

<body class="">
    <div class="">
        <a href="{{route('Cosechas.create')}}" class="btn btn-success"><i class="bi bi-plus-circle"></i> Nueva Cosecha</a>
        <table class="table table-hover table-bordered">
            <thead class="table-success ">
                <tr>
                    <th>ID</th>
                    <th>Fecha Creación</th>
                    <th>Fecha Siembra</th>
                    <th>Fecha Cosecha Estimada</th>
                    <th>Fecha Cosecha Real</th>
                    <th>Cantidad Sembrada</th>
                    <th>Total Gastos</th>
                    <th>Total Ingresos</th>
                    <th>Utilidad</th>
                    <th>Notas</th>
                    <th>Invernadero</th>
                    <th>Cultivo</th>
                    <th>Estado</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($cosechas as $cosecha )
                <tr>

                    <td>{{$cosecha->id}}</td>
                    <td>{{$cosecha->fechaCreacion}}</td>
                    <td>{{$cosecha->fechaSiembra}}</td>
                    <td>{{$cosecha->fechaCosechaEstimada}}</td>
                    <td>{{$cosecha->fechaCosechaReal}}</td>
                    <td>{{$cosecha->cantidadSembrada}}</td>
                    <td>{{$cosecha->totalGastos}}</td>
                    <td>{{$cosecha->totalIngresos}}</td>
                    <td>{{$cosecha->utilidad}}</td>
                    <td>{{$cosecha->notas}}</td>
                    <td>{{$cosecha->invernadero->nombre}}</td>
                    <td>{{$cosecha->tiposCultivo->nombre}}</td>
                    <td>{{$cosecha->estadosCosecha->nombre}}</td>

                    <td class="">
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{route('Cosechas.edit',$cosecha->id)}}"
                                class="btn btn-warning shadow-sm btn-accion">
                                <i class="bi bi-pencil-square"></i> Editar
                            </a>
                            <form action="{{route('Cosechas.destroy',$cosecha->id)}}" method="POST">
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