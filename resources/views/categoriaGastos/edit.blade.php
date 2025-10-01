@extends('layouts.app')
@section('title','Actualizar Gastos')

@section('titleContent')
<h1 class="text-center">Actualizar Gastos</h1>
    
@endsection
@section('content')
    

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow-sm border-0 rounded-3">
        <div class="card-header bg-white text-center border-0">
        </div>
        <div class="card-body p-4">

          <form action="{{ route('CategoriaGastos.update',$categoriaGasto->id) }}" method="POST">
            @csrf
            
            <!-- Nombre del Invernadero -->
            <div class="mb-3">
              <label for="nombre" class="form-label">Nombre Categoria Gastos</label>
              <input 
                  type="text" 
                  name="nombre" 
                  id="nombre" 
                  value="{{$categoriaGasto->nombre}}"
                  class="form-control form-control-lg @error('nombre') is-invalid @enderror" 
                  placeholder="Ej.: Invernadero Norte" 
                  minlength="3"
                  maxlength="255">
              @error('nombre')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Botones -->
            <div class="d-grid gap-2 mt-4">
              <button type="submit" class="btn btn-success btn-lg"><i class="fas fa-sync-alt"></i>  Actualizar</button>
              <a href="{{ route('CategoriaGastos.index') }}" class="btn btn-outline-secondary btn-lg rounded-3"><i class="bi bi-x-circle"></i> Cancelar</a>
            </div>

          </form>

        </div>
      </div>
    </div>
  </div>
</div>

@endsection
