@extends('layouts.app')
@section('title','Crear Cultivo')

@section('titleContent')
<h1 class="text-center">Registrar Tipos de Cultivo</h1>
    
@endsection
@section('content')

<div class="container ">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow-sm border-0 rounded-3">
        <div class="card-header bg-white text-center border-0">
        </div>
        <div class="card-body p-4">

          <form action="{{ route('TiposCultivos.store') }}" method="POST">
            @csrf
            
            <!-- Nombre del Invernadero -->
            <div class="mb-3">
              <label for="nombre" class="form-label">Nombre del Tipo de Cultivo</label>
              <input 
                  type="text" 
                  name="nombre" 
                  id="nombre" 
                  class="form-control form-control-lg @error('nombre') is-invalid @enderror" 
                  placeholder="Ej.: Invernadero Norte" >
              @error('nombre')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Ciclo en Días -->
            <div class="mb-3">
              <label for="cicloDias" class="form-label">Ciclo (días)</label>
              <input 
                  type="number" 
                  name="cicloDias" 
                  id="cicloDias" 
                  class="form-control form-control-lg @error('cicloDias') is-invalid @enderror" 
                  placeholder="Ej.: 120" >
              @error('cicloDias')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Botones -->
            <div class="d-grid gap-2 mt-4">
              <button type="submit" class="btn btn-success btn-lg"><i class="ri-save-3-fill"></i> Guardar</button>
              <a href="{{route('TiposCultivos.index')}}" class="btn btn-outline-secondary btn-lg rounded-3"><i class="bi bi-x-circle"></i>  Cancelar</a>
            </div>

          </form>

        </div>
      </div>
    </div>
  </div>
</div>

@endsection
