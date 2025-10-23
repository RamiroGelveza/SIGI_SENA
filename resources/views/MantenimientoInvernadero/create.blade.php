@extends('layouts.app')
@section('title','Crear Mantenimiento')

@section('titleContent')
<h1 class="text-center">Registrar Mantenimiento</h1>
    
@endsection
@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-7 col-lg-6">
      <div class="card shadow-sm border-0 rounded-3">
        <div class="card-header bg-white text-center border-0">
        </div>
        <div class="card-body p-4">

          <form action="{{ route('MantenimientoInverndero.store') }}" method="POST">
            @csrf
              
            <!-- Invernadero -->
            <div class="mb-3">
              <label for="idInvernadero" class="form-label">Invernadero</label>
              <select
                name="idInvernadero"
                id="idInvernadero"
                class="form-control form-select-lg @error('idInvernadero') is-invalid @enderror"
              readonly>
                @foreach($invernaderos as $inv)
                <option value="{{ $inv->id }}">{{ $inv->nombre }}</option>
                @endforeach
              </select>
              @error('idInvernadero')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <!-- Fecha de Mantenimiento -->
            <div class="mb-3">
              <label for="fechaMantenimiento" class="form-label">Fecha de Mantenimiento</label>
              <input
                type="date"
                name="fechaMantenimiento"
                id="fechaMantenimiento"
                class="form-control form-control-lg @error('fechaMantenimiento') is-invalid @enderror">
              @error('fechaMantenimiento')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Costo de Mantenimiento -->
            <div class="mb-3">
              <label for="costoMantenimiento" class="form-label">Costo de Mantenimiento</label>
              <input
                type="number"
                name="costoMantenimiento"
                id="costoMantenimiento"
                step="0.01"
                class="form-control form-control-lg @error('costoMantenimiento') is-invalid @enderror"
                placeholder="Ej.: 500000">
              @error('costoMantenimiento')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Descripción -->
            <div class="mb-3">
              <label for="descripcion" class="form-label">Descripción</label>
              <textarea
                name="descripcion"
                id="descripcion"
                rows="3"
                class="form-control form-control-lg @error('descripcion') is-invalid @enderror"
                placeholder="Ej.: Cambio de plásticos, reparación de estructuras"></textarea>
              @error('descripcion')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>


            <!-- Botones -->
            <div class="d-grid gap-2 mt-4">
              <button type="submit" class="btn btn-success btn-lg"><i class="ri-save-3-fill"></i> Guardar</button>
              <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-lg rounded-3"> <i class="bi bi-x-circle"></i> Cancelar</a>
            </div>

          </form>

        </div>
      </div>
    </div>
  </div>
</div>

@endsection
