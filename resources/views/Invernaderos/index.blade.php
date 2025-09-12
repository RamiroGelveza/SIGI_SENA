@extends('layouts.app')
@section('title','invernadero')

@section('titleContent')
<h1 class="text-center">Gestion Invernaderos</h1>
    
@endsection
@section('content')
    
<body class="bg-light">
    <div class="container">
        <a href="{{route('Invernaderos.create')}}" class="btn btn-success">Nuevo Invernadero</a>
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
        <thead class="table-dark">
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
            <td>
                <a href="{{route('Invernaderos.edit',$invernadero->id)}}" class="btn btn-dark">Actualizar</a>
                <form action="{{ route('Invernaderos.destroy',$invernadero->id)}}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger" onclick="confirmarEliminacion(event)">Eliminar</button>
                </form>
            </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{route('welcome')}}" class="btn btn-info">Volver</a>
            
     
@endsection
