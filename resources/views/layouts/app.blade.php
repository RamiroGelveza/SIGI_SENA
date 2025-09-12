@extends('adminlte::page')

@section('title', $title ?? 'Dashboard')

@section('content_header')
    <h1>@yield('page-title', 'SIGI')</h1>
    @yield('titleContent')
@stop

@section('content')
    {{-- Dynamic content --}}
    @yield('content')
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin-custom.css') }}">
    @stack('styles')
@stop

@section('js')
    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
@stop