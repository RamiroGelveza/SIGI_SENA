@extends('layouts.app')
@section('title',' Actualizar Invernadero')

@section('titleContent')
<h1 class="text-center">Actualizar Invernadero</h1>

@endsection
@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-7 col-lg-6">
      <div class="card shadow-sm border-0 rounded-3">
        <div class="card-header bg-white text-center border-0">
        </div>
        <div class="card-body p-4">

          <form action="{{ route('Invernaderos.update',$invernadero->id) }}" method="POST">
            @csrf
            <!-- Finca -->
            <div class="mb-3">
              <input type="text" class="form-control"
                value="{{ $invernadero->finca->nombre }}" readonly>

              <input type="hidden" name="idFinca" value="{{ $invernadero->idFinca }}">

              @error('idFinca')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <!-- Nombre -->
            <div class="mb-3">
              <label for="nombre" class="form-label">Nombre</label>
              <input
                type="text"
                name="nombre"
                id="nombre"
                value="{{$invernadero->nombre}}"
                class="form-control form-control-lg @error('nombre') is-invalid @enderror"
                placeholder="Ej.: Invernadero Norte">
              @error('nombre')
              <div class="invalid-feedback">{{$message}}</div>
              @enderror
            </div>

            <!-- Tamaño -->
            <div class="mb-3">
              <label for="tamaño" class="form-label">Tamaño (Cantidad Plantulas)</label>
              <input
                type="number"
                name="tamaño"
                id="tamaño"
                value="{{$invernadero->tamaño}}"
                class="form-control form-control-lg @error('tamaño') is-invalid @enderror"
                placeholder="Ej.: 150.50">
              @error('tamaño')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Costo Construcción -->
            <div class="mb-3">
              <label for="costoConstruccion" class="form-label">Costo de Construcción</label>
              <input
                type="number"
                name="costoConstruccion"
                id="costoConstruccion"
                step="0.01"
                value="{{$invernadero->costoConstruccion}}"
                class="form-control form-control-lg @error('costoConstruccion') is-invalid @enderror"
                placeholder="Ej.: 25000000">
              @error('costoConstruccion')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Rendimiento -->
            <!-- <div class="mb-3">
              <label for="rendimiento" class="form-label">Rendimiento (Canastillas / Ciclo)</label>
              <input
                type="number"
                name="rendimiento"
                id="rendimiento"
                step="0.01"
                value="{{$invernadero->costoConstruccion}}"
                class="form-control form-control-lg @error('rendimiento') is-invalid @enderror"
                placeholder="Ej.: 15.5">
              @error('rendimiento')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div> -->

            <!-- Botones -->
            <div class="d-grid gap-2 mt-4">
              <button type="submit" class="btn btn-success btn-lg"><i class="fas fa-sync-alt"></i> Actualizar</button>
              <a href="" class="btn btn-outline-secondary btn-lg rounded-3"> <i class="bi bi-x-circle"></i> Cancelar</a>
            </div>

          </form>

        </div>
      </div>
    </div>
  </div>
</div>
@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: "{{ session('success') }}",
            confirmButtonText: 'Aceptar',
            timer: 3000
        });
    });
</script>
@endif
@endsection