@extends('layouts.app')
@section('title','Crear Gastos')

@section('titleContent')
<h1 class="text-center">Registrar Gasto</h1>
@endsection

@section('content')

<body class="bg-light">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">

                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body p-4">

                        <form action="{{ route('Gastos.update',$gastos->id) }}" method="POST">
                            @csrf

                            <!-- Campo Fecha -->
                            <div class="mb-3">
                                <label for="fecha" class="form-label">Fecha</label>
                                <input type="date"
                                    class="form-control @error('fecha') is-invalid @enderror"
                                    id="fecha" name="fecha"
                                    value="{{ $gastos->fecha }}">
                                @error('fecha')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Campo Descripción -->
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <textarea
                                    class="form-control @error('descripcion') is-invalid @enderror"
                                    id="descripcion" name="descripcion"
                                    placeholder="Ej.: Compra de fertilizantes">{{ $gastos->descripcion }}</textarea>
                                @error('descripcion')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Campo Monto -->
                            <div class="mb-3">
                                <label for="monto" class="form-label">Monto</label>
                                <input type="number" step="0.01"
                                    class="form-control @error('monto') is-invalid @enderror"
                                    id="monto" name="monto"
                                    placeholder="Ej.: 150000"
                                    value="{{  $gastos->monto  }}">
                                @error('monto')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Selección Cosecha -->
                            <div class="mb-3">
                                <label for="idCosecha" class="form-label">Cosecha</label>
                                <select class="form-control @error('idCosecha') is-invalid @enderror"
                                    id="idCosecha" name="idCosecha">
                                    <option value="">-- Selecciona una cosecha --</option>
                                    @foreach($cosechas as $cosecha)
                                    <option value="{{ $cosecha->id }}"
                                        @if ($gastos->idCosecha==$cosecha->id )selected @endif>
                                        {{ $cosecha->idCultivo }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('idCosecha')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Selección Categoría de Gastos -->
                            <div class="mb-3">
                                <label for="idCategoriaGastos" class="form-label">Categoría de Gasto</label>
                                <select class="form-control @error('idCategoriaGastos') is-invalid @enderror"
                                    id="idCategoriaGastos" name="idCategoriaGastos">
                                    <option value="">-- Selecciona una categoría --</option>
                                    @foreach($categoriaGastos as $categoriaGasto)
                                    <option value="{{ $categoriaGasto->id }}"
                                        @if ($gastos->idCategoriaGastos==$categoriaGasto->id )selected @endif>
                                        {{ $categoriaGasto->nombre }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('idCategoriaGastos')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Botones -->
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success btn-lg rounded-3">Actualizar</button>
                                <a href="{{ route('Gastos.index') }}" class="btn btn-outline-secondary btn-lg rounded-3"><i class="bi bi-x-circle"></i> Cancelar</a>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

</body>
@endsection