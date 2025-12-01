@extends('layouts.app')
@section('title','Dashboard')

@section('titleContent')
<h1 class="fw-bold text-center text-dark mb-4" style="letter-spacing: -1px;">
    🌿 Gestión del Sistema
</h1>
@endsection

@section('content')
<div class="container py-5">

    <!-- Hero Section -->
    <div class="modern-hero mb-5 text-center">
        <h2 class="fw-bold text-dark">Bienvenido al Sistema SIGI</h2>
        <p class="text-secondary mb-0">Administra tus fincas y cultivos con un diseño moderno y minimalista.</p>
    </div>

    <!-- Tarjeta única -->
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="modern-card shadow-sm">
                <div>
                    <h4 class="mb-1 fw-bold">Fincas Registradas</h4>
                    <p class="text-secondary small">Administra toda la información de tus fincas.</p>
                </div>
                <h1 class="display-4 fw-bold text-primary">{{ $cantidadFincas }}</h1>
                <a href="{{ route('Fincas.index') }}" class="btn-modern">Gestionar Fincas</a>
            </div>
        </div>
    </div>

</div>
@endsection

@push('css')
<style>
    .modern-hero {
        padding: 40px;
        background: #f8f9fa;
        border-radius: 25px;
    }

    .modern-card {
        background: #ffffff;
        border-radius: 25px;
        padding: 35px;
        text-align: center;
        transition: 0.3s;
        border: 1px solid #eee;
    }

    .modern-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 35px rgba(0,0,0,0.07);
    }

    .btn-modern {
        display: inline-block;
        margin-top: 20px;
        padding: 12px 25px;
        border-radius: 30px;
        background: #1d72f3;
        color: #fff;
        font-weight: bold;
        text-decoration: none;
        transition: 0.3s;
    }

    .btn-modern:hover {
        background: #0d5ad8;
    }
</style>
@endpush
