@extends('layouts.app')

@section('title','Registrar Ingreso')

@section('titleContent')
<h1 class="text-center">Registrar Ingreso</h1>
@endsection

@section('content')
<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-lg-6">

            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4">
                    <form action="{{ route('Ingresos.store') }}" method="POST">
                        @csrf
                          <!-- Selección de Cosecha -->
                        <div class="mb-3">
                            <label for="idCosecha" class="form-label">Cosecha</label>
                            <select name="idCosecha" id="idCosecha" class="form-control @error('idCosecha') is-invalid @enderror"
                            readonly>
                                @foreach($cosechas as $cosecha)
                                <option value="{{ $cosecha->id }}">
                                 {{ $cosecha->fechaSiembra }} - Cultivo {{ $cosecha->tiposCultivo->nombre ?? 'Sin nombre' }}


                                </option>
                                @endforeach
                            </select>

                            @error('idCosecha')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>

                        <!-- Fecha -->
                        <div class="mb-3">
                            <label for="fecha" class="form-label">Fecha</label>
                            <input type="date" name="fecha" id="fecha" class="form-control @error('fecha') is-invalid @enderror">

                            @error('fecha')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>

                        <!-- Descripción -->
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea name="descripcion" id="descripcion" rows="3" class="form-control
                            @error('descripcion') is-invalid @enderror" placeholder="Ej: Venta de tomates"></textarea>
                            @error('descripcion')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>

                        <!-- Cantidad Vendida -->
                        <div class="mb-3">
                            <label for="cantidadVendida" class="form-label">Cantidad Vendida (kg)</label>
                            <input type="number" step="0.01" name="cantidadVendida" id="cantidadVendida" class="form-control
                            @error('cantidadVendida') is-invalid @enderror" placeholder="Ej: 120.50">
                            @error('cantidadVendida')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>

                        <!-- Precio Unitario -->
                        <div class="mb-3">
                            <label for="precioUnitario" class="form-label">Precio Unitario ($)</label>
                            <input type="number" step="0.01" name="precioUnitario" id="precioUnitario" class="form-control
                            @error('precioUnitario') is-invalid @enderror" placeholder="Ej: 2500">
                            @error('precioUnitario')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>

                      

                        <!-- Botones -->
                        <div class="d-flex justify-content">
                            <button type="submit" class="btn btn-success "><i class="ri-save-3-fill"></i> Guardar</button>
                            <a href="" class="btn btn-outline-secondary btn-lg rounded-3"><i class="bi bi-x-circle"></i> Cancelar</a>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection