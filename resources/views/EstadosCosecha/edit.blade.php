@extends('layouts.app')
@section('title','Actualizar Estado')

@section('titleContent')
<h1 class="text-center">Actualizar Estado</h1>
    
@endsection
@section('content')
<body class="bg-light">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">

            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4">

                    <form action="{{ route('EstadosCosecha.update',$estadosCosecha->id) }}" method="POST">
                        @csrf

                        <!-- Campo Nombre -->
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre de la Finca</label>
                            <input type="text" class="form-control  @error('nombre')
                                    is-invalid 
                                @enderror" id="nombre" name="nombre" value="{{$estadosCosecha->nombre}}" placeholder="Ej.: Finca La Esperanza"  >
                                
                                @error('nombre')
                                    <div class="invalid-feedback ">{{ $message }}</div>
                                @enderror
                                <div class="mt-3">
                            <button type="submit" class="btn btn-success btn-lg rounded-3">Actualizar</button>
                            <a href="{{ route('EstadosCosecha.index') }}" class="btn btn-outline-secondary btn-lg rounded-3">Cancelar</a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
@endsection
