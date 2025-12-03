@extends('layouts.app')
@section('title','Dashboard')

@section('titleContent')
<h1 class="fw-bold text-center text-dark mb-4">Dashboard SIGI</h1>
@endsection

@section('content')
<div class="container py-4">

    <!-- HERO SECTION -->
    <div class="hero-box mb-5 text-center">
        <h2 class="fw-bold text-dark mb-1">Bienvenido a SIGI</h2>
        <p class="text-secondary mb-0">Panel general del sistema de información agrícola.</p>
    </div>

    <!-- CARDS -->
    <div class="row g-4 justify-content-center">

        <!-- Fincas -->
        <div class="col-md-4">
            <div class="stat-card shadow-sm">
                <div class="icon-circle bg-primary text-white">
                    <i class="fas fa-tree"></i>
                </div>
                <h6 class="text-muted mt-3 mb-1">Fincas Registradas</h6>
                <h1 class="fw-bold text-dark">{{ $cantidadFincas }}</h1>

                <a href="{{ route('Fincas.index') }}" class="btn btn-primary mt-3 w-100">
                    Gestionar Fincas
                </a>
            </div>
        </div>

        <!-- Invernaderos -->
        <div class="col-md-4">
            <div class="stat-card shadow-sm">
                <div class="icon-circle bg-success text-white">
                    <i class="fas fa-seedling"></i>
                </div>
                <h6 class="text-muted mt-3 mb-1">Total Invernaderos</h6>
                <h1 class="fw-bold text-dark">{{ $cantidadInvernaderos }}</h1>
            </div>
        </div>

        <!-- Cosechas -->
        <div class="col-md-4">
            <div class="stat-card shadow-sm">
                <div class="icon-circle bg-warning text-white">
                    <i class="fas fa-tractor"></i>
                </div>
                <h6 class="text-muted mt-3 mb-1">Cosechas Registradas</h6>
                <h1 class="fw-bold text-dark">{{ $cantidadCosechas }}</h1>
            </div>
        </div>

    </div>

</div>
@endsection

@push('css')
<style>

    /* HERO BOX */
    .hero-box {
        background: #f4f6f9;
        padding: 40px;
        border-radius: 18px;
        border: 1px solid #e4e6eb;
    }

    /* STAT CARDS */
    .stat-card {
        background: #ffffff;
        border-radius: 18px;
        padding: 30px 20px;
        text-align: center;
        border: 1px solid #e7e7e7;
        transition: 0.25s ease;
    }

    .stat-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    }

    /* ICON CIRCLES */
    .icon-circle {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        margin: 0 auto;
    }

</style>
@endpush
