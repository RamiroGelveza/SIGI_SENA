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
        <a href="{{route('Fincas.create')}}" class="btn btn-success">Nueva Finca</a>
    
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
            <td>

            <div class="row">
                <div class="col-6">
<a href="{{route('Fincas.edit',$finca->id)}}" class="btn btn-warning">Actualizar</a>
                </div>
                <div class="col-6">
     <form action="{{route('Fincas.destroy',$finca->id)}}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger" onclick="confirmarEliminacion(event)">Eliminar</button>
                </form>
                </div>
            </div>
                
           
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
