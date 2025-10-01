@extends('layouts.app')
@section('title','Crear Fincas')

@section('titleContent')
<h1 class="text-center">Registrar Finca</h1>
    
@endsection
@section('content')
<body class="bg-light">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">

            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4">

                    <form action="{{ route('Fincas.store') }}" method="POST">
                        @csrf

                        <!-- Campo Nombre -->
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre de la Finca</label>
                            <input type="text" class="form-control  @error('nombre')
                                    is-invalid 
                                @enderror" id="nombre" name="nombre"  placeholder="Ej.: Finca La Esperanza"  >
                                
                                @error('nombre')
                                    <div class="invalid-feedback ">{{ $message }}</div>
                                @enderror
                        </div>

                        <!-- Campo Ubicación -->
                        <div class="mb-3">
                            <label for="ubicacion" class="form-label">Ubicación</label>
                            <input 
                                type="text" id="ubicacion" name="ubicacion" class="form-control form-control-lg @error('ubicacion')
                                is-invalid @enderror"
                                placeholder="Ej.: Vereda El Paraíso, Municipio" >
                                @error('ubicacion')
                                <div class="invalid-feedback">{{$message}}</div>
                                    
                                @enderror
                        </div>

                        <!-- Botones -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success btn-lg rounded-3"><i class="ri-save-3-fill"></i> Guardar</button>
                            <a href="{{ route('Fincas.index') }}" class="btn btn-outline-secondary btn-lg rounded-3"><i class="bi bi-x-circle"></i> Cancelar</a>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
@endsection
