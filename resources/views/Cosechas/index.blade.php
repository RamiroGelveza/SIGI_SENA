@extends('layouts.app')
@section('title','Mantenimiento')

@section('titleContent')
<h1 class="text-center">Gestion Mantenimiento Invernaderos</h1>
    
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
    <div class="container-md">
        <a href="{{route('Cosechas.create')}}" class="btn btn-success">Nueva Cosecha</a>
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>id</th>
                    <th>fecha Creacion</th>
                    <th>fecha Siembra</th>
                    <th>fecha Cosecha Estimada</th>
                    <th>fecha Cosecha Real</th>
                    <th>cantidad Sembrada</th>
                    <th>total Gastos</th>
                    <th>total Ingresos</th>
                    <th>utilidad</th>
                    <th>notas</th>
                    <th>Invernadero</th>
                    <th>Cultivo</th>
                    <th>Estado</th>
                    <th>accion</th>
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

                    <td>
                        <a href="{{route('Cosechas.edit',$cosecha->id)}}" class="btn btn-dark">Actualizar</a>
                        <form action="{{route('Cosechas.destroy',$cosecha->id)}}" method="POST">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    @endsection