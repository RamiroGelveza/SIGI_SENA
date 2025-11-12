@extends('layouts.app')
@section('title','Registrar Cosecha')

@section('titleContent')
<h1 class="text-center mt-3 text-success fw-bold">🌾 Registrar Nueva Cosecha</h1>
@endsection

@section('content')
<div class="container py-3">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body px-4 py-3">

            <form action="{{ route('Cosechas.store') }}" method="POST">
                @csrf
                <input type="hidden" id="totalGastos" name="totalGastos" value="0">
                <input type="hidden" id="totalIngresos" name="totalIngresos" value="0">
                <input type="hidden" id="utilidad" name="utilidad" value="0">



                <!-- Invernadero -->
                <div class="mb-3">
                    <label for="idInvernadero" class="form-label fw-semibold">Invernadero</label>
                    <select id="idInvernadero" name="idInvernadero"
                        class="form-control @error('idInvernadero') is-invalid @enderror" readonly>
                        @foreach($invernaderos as $invernadero)
                        <option value="{{ $invernadero->id }}">{{ $invernadero->nombre }}</option>
                        @endforeach
                    </select>
                    @error('idInvernadero')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row g-3">

                    {{-- 🔹 Columna Izquierda --}}
                    <div class="col-md-6">


                        <!-- Fecha de Siembra -->
                        <div class="mb-3">
                            <label for="fechaSiembra" class="form-label fw-semibold">Fecha de Siembra</label>
                            <input type="date" id="fechaSiembra" name="fechaSiembra"
                                class="form-control @error('fechaSiembra') is-invalid @enderror">
                            @error('fechaSiembra')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Fecha de Cosecha Estimada -->
                        <div class="mb-3">
                            <label for="fechaCosechaEstimada" class="form-label fw-semibold">Cosecha Estimada</label>
                            <input type="date" id="fechaCosechaEstimada" name="fechaCosechaEstimada"
                                class="form-control @error('fechaCosechaEstimada') is-invalid @enderror">
                            @error('fechaCosechaEstimada')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Fecha de Cosecha Real -->
                        <div class="mb-3">
                            <label for="fechaCosechaReal" class="form-label fw-semibold">Cosecha Real</label>
                            <input type="date" id="fechaCosechaReal" name="fechaCosechaReal"
                                class="form-control @error('fechaCosechaReal') is-invalid @enderror">
                            @error('fechaCosechaReal')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                       
                    </div>

                    {{-- 🔹 Columna Derecha --}}
                    <div class="col-md-6">

                        <!-- Cantidad Sembrada -->
                        <div class="mb-3">
                            <label for="cantidadSembrada" class="form-label fw-semibold">Cantidad Sembrada</label>
                            <input type="number" id="cantidadSembrada" name="cantidadSembrada" step="0.01"
                                class="form-control @error('cantidadSembrada') is-invalid @enderror"
                                placeholder="Ej.: 500">
                            @error('cantidadSembrada')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Total Gastos -->
                        <!-- <div class="mb-3">
                            <label for="totalGastos" class="form-label fw-semibold">Total Gastos ($)</label>
                            <input type="number" id="totalGastos" name="totalGastos" step="0.01"
                                class="form-control @error('totalGastos') is-invalid @enderror"
                                placeholder="Ej.: 1200000">
                            @error('totalGastos')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div> -->

                        <!-- Total Ingresos -->
                        <!-- <div class="mb-3">
                            <label for="totalIngresos" class="form-label fw-semibold">Total Ingresos ($)</label>
                            <input type="number" id="totalIngresos" name="totalIngresos" step="0.01"
                                class="form-control @error('totalIngresos') is-invalid @enderror"
                                placeholder="Ej.: 3000000">
                            @error('totalIngresos')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div> -->

                        <!-- Utilidad -->
                        <!-- <div class="mb-3">
                            <label for="utilidad" class="form-label fw-semibold">Utilidad ($)</label>
                            <input type="number" id="utilidad" name="utilidad" step="0.01"
                                class="form-control @error('utilidad') is-invalid @enderror"
                                placeholder="Ej.: 1800000">
                            @error('utilidad')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div> -->

                        <!-- Estado -->
                        <div class="mb-3">
                            <label for="idEstado" class="form-label fw-semibold">Estado</label>
                            <select id="idEstado" name="idEstado"
                                class="form-control @error('idEstado') is-invalid @enderror">
                                <option value="">-- Seleccione un Estado --</option>
                                @foreach($estados as $estado)
                                <option value="{{ $estado->id }}">{{ $estado->nombre }}</option>
                                @endforeach
                            </select>
                            @error('idEstado')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Cultivo -->

                         <div class="mb-3">
                            <label for="idCultivo" class="form-label fw-semibold">Cultivo</label>
                            <select id="idCultivo" name="idCultivo"
                                class="form-control @error('idCultivo') is-invalid @enderror">
                                <option value="">-- Seleccione un Cultivo --</option>
                                @foreach($cultivos as $cultivo)
                                <option value="{{ $cultivo->id }}">{{ $cultivo->nombre }}</option>
                                @endforeach
                            </select>
                            @error('idCultivo')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                </div>

                <!-- Notas -->
                <div class="mb-3">
                    <label for="notas" class="form-label fw-semibold">Notas</label>
                    <textarea id="notas" name="notas" rows="4"
                        class="form-control @error('notas') is-invalid @enderror"
                        placeholder="Observaciones sobre la cosecha..."></textarea>
                    @error('notas')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- 🔸 Botones --}}
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-success px-4 me-2">
                        <i class="bi bi-save2-fill"></i> Guardar
                    </button>
                    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary px-4">
                        <i class="bi bi-x-circle"></i> Cancelar
                    </a>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection