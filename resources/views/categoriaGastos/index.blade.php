@extends('layouts.app')
@section('title','Gastos')

@section('titleContent')
<h1 class="text-center">Gestion Categoria Gastos</h1>

@endsection
@section('content')

<body class="bg-light">
    <div class="container">
        <a href="{{route('CategoriaGastos.create')}}" class="btn btn-success"><i class="bi bi-plus-circle"></i> Nueva Categoria Gasto</a>
        <table id="myTable"  class="table table-bordered table-hover mt-2">
            <thead class="table-success">
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
                    <td class="">
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{route('CategoriaGastos.edit',$categoriaGasto->id)}}"
                                class="btn btn-warning shadow-sm btn-accion">
                                <i class="bi bi-pencil-square"></i> Editar
                            </a>
                            <form action="{{route('CategoriaGastos.destroy',$categoriaGasto->id)}}" method="POST">
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