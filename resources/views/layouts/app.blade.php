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

@section('adminlte_css_pre')

@vite(['resources/css/app.css', 'resources/js/app.js'])
@endsection

@section('css')
<style>
    .btn-accion {
        min-width: 120px;
        padding: 6px 14px;
        font-size: 0.95rem;
    }
</style>
@stop


@section('js')
@stack('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">




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