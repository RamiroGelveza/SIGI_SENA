@extends('layouts.app')
@section('title','Registrar Cosecha')

@section('titleContent')
<h1 class="text-center">Registrar Cosecha</h1>
@endsection

@section('content')
<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body p-4">
                        <form action="{{ route('Cosechas.update',$cosecha->id) }}" method="POST">
                            @csrf

                            <!-- Fecha de Creación -->
                            <div class="mb-3">
                                <label for="fechaCreacion" class="form-label">Fecha de Creación</label>
                                <input type="date" id="fechaCreacion" name="fechaCreacion"
                                    class="form-control @error('fechaCreacion') is-invalid @enderror"
                                    value="{{ $cosecha->fechaCreacion }}">
                                @error('fechaCreacion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Fecha de Siembra -->
                            <div class="mb-3">
                                <label for="fechaSiembra" class="form-label">Fecha de Siembra</label>
                                <input type="date" id="fechaSiembra" name="fechaSiembra"
                                    class="form-control @error('fechaSiembra') is-invalid @enderror"
                                    value="{{ $cosecha->fechaSiembra }}">
                                @error('fechaSiembra')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Fecha de Cosecha Estimada -->
                            <div class="mb-3">
                                <label for="fechaCosechaEstimada" class="form-label">Fecha de Cosecha Estimada</label>
                                <input type="date" id="fechaCosechaEstimada" name="fechaCosechaEstimada"
                                    class="form-control @error('fechaCosechaEstimada') is-invalid @enderror"
                                    value="{{ $cosecha->fechaCosechaEstimada }}">
                                @error('fechaCosechaEstimada')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Fecha de Cosecha Real -->
                            <div class="mb-3">
                                <label for="fechaCosechaReal" class="form-label">Fecha de Cosecha Real</label>
                                <input type="date" id="fechaCosechaReal" name="fechaCosechaReal"
                                    class="form-control @error('fechaCosechaReal') is-invalid @enderror"
                                    value="{{ $cosecha->fechaCosechaReal }}">
                                @error('fechaCosechaReal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Cantidad Sembrada -->
                            <div class="mb-3">
                                <label for="cantidadSembrada" class="form-label">Cantidad Sembrada</label>
                                <input type="number" id="cantidadSembrada" name="cantidadSembrada" step="0.01"
                                    class="form-control @error('cantidadSembrada') is-invalid @enderror"
                                    placeholder="Ej.: 500" value="{{ $cosecha->cantidadSembrada }}">
                                @error('cantidadSembrada')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Total Gastos -->
                            <div class="mb-3">
                                <label for="totalGastos" class="form-label">Total Gastos ($)</label>
                                <input type="number" id="totalGastos" name="totalGastos" step="0.01"
                                    class="form-control @error('totalGastos') is-invalid @enderror"
                                    placeholder="Ej.: 1200000" value="{{ $cosecha->totalGastos }}">
                                @error('totalGastos')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Total Ingresos -->
                            <div class="mb-3">
                                <label for="totalIngresos" class="form-label">Total Ingresos ($)</label>
                                <input type="number" id="totalIngresos" name="totalIngresos" step="0.01"
                                    class="form-control @error('totalIngresos') is-invalid @enderror"
                                    placeholder="Ej.: 3000000" value="{{ $cosecha->totalIngresos }}">
                                @error('totalIngresos')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Utilidad -->
                            <div class="mb-3">
                                <label for="utilidad" class="form-label">Utilidad ($)</label>
                                <input type="number" id="utilidad" name="utilidad" step="0.01"
                                    class="form-control @error('utilidad') is-invalid @enderror"
                                    placeholder="Ej.: 1800000" value="{{ $cosecha->utilidad }}">
                                @error('utilidad')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Notas -->
                            <div class="mb-3">
                                <label for="notas" class="form-label">Notas</label>
                                <textarea id="notas" name="notas"
                                    class="form-control @error('notas') is-invalid @enderror"
                                    placeholder="Observaciones sobre la cosecha...">{{ $cosecha->notas }}</textarea>
                                @error('notas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Invernadero -->
                            <div class="mb-3">
                                <label for="idInvernadero" class="form-label">Invernadero</label>
                                <select id="idInvernadero" name="idInvernadero"
                                    class="form-control @error('idInvernadero') is-invalid @enderror">
                                    <option value="">-- Seleccione un Invernadero --</option>
                                    @foreach($invernaderos as $invernadero)
                                        <option value="{{ $invernadero->id }}"
                                            @if ($cosecha->idInvernadero == $invernadero->id) selected @endif>
                                            {{ $invernadero->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('idInvernadero')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Cultivo -->
                            <div class="mb-3">
                                <label for="idCultivo" class="form-label">Cultivo</label>
                                <select id="idCultivo" name="idCultivo"
                                    class="form-control @error('idCultivo') is-invalid @enderror">
                                    <option value="">-- Seleccione un Cultivo --</option>
                                    @foreach($cultivos as $cultivo)
                                        <option value="{{ $cultivo->id }}"
                                            @if ($cosecha->idCultivo == $cultivo->id) selected @endif>
                                            {{ $cultivo->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('idCultivo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Estado -->
                            <div class="mb-3">
                                <label for="idEstado" class="form-label">Estado</label>
                                <select id="idEstado" name="idEstado"
                                    class="form-control @error('idEstado') is-invalid @enderror">
                                    <option value="">-- Seleccione un Estado --</option>
                                    @foreach($estados as $estado)
                                        <option value="{{ $estado->id }}"
                                            @if ($cosecha->idEstado == $estado->id) selected @endif>
                                            {{ $estado->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('idEstado')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Botones centrados -->
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-success btn-lg rounded-3 px-5 me-2">
                                    <i class="fas fa-sync-alt"></i> Actualizar
                                </button>
                                <a href="{{ route('Cosechas.index', ['idinvernadero' => $cosecha->idInvernadero]) }}"
                                   class="btn btn-outline-secondary btn-lg rounded-3 px-5">
                                    <i class="bi bi-x-circle"></i> Cancelar
                                </a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection
