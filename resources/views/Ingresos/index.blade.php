@extends('layouts.app')
@section('title','Ingreso')

@section('titleContent')
<h1 class="text-center">Gestion Ingreso</h1>
    
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
        <a href="{{route('Ingresos.create')}}" class="btn btn-success">Nuevo Ingreso</a>
    
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
            <td>{{$ingreso->Cosecha->idCultivo}}</td>

            <td>

            <div class="row">
                <div class="col-4">
<a href="{{route('Ingresos.edit',$ingreso->id)}}" class="btn btn-warning">Actualizar</a>
                </div>
                <div class="col-4">
     <form action="{{route('Ingresos.destroy',$ingreso->id)}}" method="POST">
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
@endsection
