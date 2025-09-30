@extends('layouts.app')
@section('title','Crear Estado')

@section('titleContent')
<h1 class="text-center">Registrar Estado</h1>
    
@endsection
@section('content')
<body class="bg-light">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">

            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4">

                    <form action="{{ route('EstadosCosecha.store') }}" method="POST">
                        @csrf

                        <!-- Campo Nombre -->
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre del estado</label>
                            <input type="text" class="form-control  @error('nombre')
                                    is-invalid 
                                @enderror" id="nombre" name="nombre"  placeholder="Ej.: cresimiento"  >
                                
                                @error('nombre')
                                    <div class="invalid-feedback ">{{ $message }}</div>
                                @enderror
                                <div class="mt-3">
                            <button type="submit" class="btn btn-success btn-lg rounded-3"><i class="ri-save-3-fill"></i> Guardar</button>
                            <a href="{{ route('EstadosCosecha.index') }}" class="btn btn-outline-secondary btn-lg rounded-3"><i class="bi bi-x-circle"></i> Cancelar</a>
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
