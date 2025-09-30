@extends('layouts.app')
@section('title','invernadero')

@section('titleContent')
<h1 class="text-center">Gestion Invernaderos</h1>
    
@endsection
@section('content')
    
<body class="bg-light">
    <div class="container">
        <a href="{{route('Invernaderos.create,$invernadero->Finca->id')}}" class="btn btn-success"><i class="bi bi-plus-circle"></i> Nuevo Invernadero</a>
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
    <table class="table table-bordered table-hover">
        <thead class="table-success">
            <tr>
                <th>id</th>
                <th>nombre</th>
                <th>tamaño</th>
                <th>costoConstruccion</th>
                <th>rendimiento</th>
                <th>finca</th>
                <th>opciones</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($invernaderos as $invernadero )
                <tr>
            
            <td>{{$invernadero->id}}</td>
            <td>{{$invernadero->nombre}}</td>
            <td>{{$invernadero->tamaño}}</td>
            <td>{{$invernadero->costoConstruccion}}</td>
            <td>{{$invernadero->rendimiento}}</td>
            <td>{{$invernadero->Finca->nombre}}</td>
            <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{route('Invernaderos.edit',$invernadero->id)}}"
                                class="btn btn-warning shadow-sm btn-accion">
                                <i class="bi bi-pencil-square"></i> Editar
                            </a>
                            <form action="{{route('Invernaderos.destroy',$invernadero->id)}}" method="POST">
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
    <a href="{{route('Fincas.index')}}" class="btn btn-info"><i class="bi bi-arrow-left-circle"></i> Volver</a>
            
@endsection
