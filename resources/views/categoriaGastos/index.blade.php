@extends('layouts.app')
@section('title','Gastos')

@section('titleContent')
<h1 class="text-center">Gestion Categoria Gastos</h1>
    
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
        <a href="{{route('CategoriaGastos.create')}}" class="btn btn-success">Nueva Categoria Gasto</a>
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>id</th>
                <th>nombre</th>
                <th>opciones</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($categoriaGastos as $categoriaGasto )
                <tr>
            
            <td>{{$categoriaGasto->id}}</td>
            <td>{{$categoriaGasto->nombre}}</td>
            <td>
                <a href="{{route('CategoriaGastos.edit',$categoriaGasto->id)}}" class="btn btn-dark">Actualizar</a>
                <form action="{{route('CategoriaGastos.destroy',$categoriaGasto->id)}}" method="POST">
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
