@extends('adminlte::page')

@section('title', $title ?? 'Dashboard')

@section('content_header')
@yield('titleContent')
@stop

@section('content')
{{-- Dynamic content --}}
@yield('content')
@stop

@section('adminlte_css_pre')

{{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
@endsection

@section('css')
{{-- DataTables con Bootstrap 4 --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">

<style>
    .btn-accion {
        min-width: 120px;
        padding: 6px 14px;
        font-size: 0.95rem;
    }
    .card-header-finca {
        background-color: #1BBB63 !important;
        color:black;
        font-weight: bold;
        border-radius: 0.5rem 0.5rem 0 0;
        padding: 1rem 1.25rem;
    }

    .card-header-finca i {
        color:black;
    }
    
    
</style>
<style>
    /* --- ESTILOS GENERALES DEL DASHBOARD --- */
    .card {
        transition: all 0.3s ease-in-out;
    }

    .card:hover {
        transform: translateY(-4px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
    }

    .card-header {
        font-size: 1.1rem;
        letter-spacing: 0.5px;
    }

    /* --- TARJETA PRINCIPAL DEL INVERNADERO --- */
    .card-invernadero {
        background: linear-gradient(145deg, #f6fff7, #ffffff);
        border-left: 6px solid #198754;
    }

    .card-invernadero .card-header {
        background: linear-gradient(90deg, #198754, #28a745);
        font-size: 1.2rem;
        padding: 0.9rem 1.2rem;
    }

    .card-invernadero .card-body {
        background: #ffffff;
        padding: 1.5rem;
    }

    /* --- MÉTRICAS DE INFORMACIÓN --- */
    .metric-card {
        background-color: #f8fdf9;
        border-radius: 12px;
        padding: 1rem 0.5rem;
        border: 1px solid #e2efe4;
        transition: all 0.3s ease;
    }

    .metric-card:hover {
        background-color: #eaf9ed;
        transform: scale(1.02);
    }

    .metric-card h4 {
        font-size: 1.6rem;
        margin: 0;
    }

    .metric-card i {
        color: #198754;
    }

    /* --- BOTONES DE ACCIÓN --- */
    .btn-success {
        border-radius: 12px;
        font-weight: 600;
        letter-spacing: 0.3px;
        transition: all 0.3s ease-in-out;
    }

    .btn-success:hover {
        background-color: #157347 !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(21, 115, 71, 0.3);
    }

    .btn-light.text-success {
        background-color: #ffffff !important;
        border: 1px solid #cce5d1;
    }

    .btn-light.text-success:hover {
        background-color: #e8f6ec !important;
        border-color: #198754;
        transform: translateY(-2px);
    }

    /* --- GRÁFICAS --- */
    canvas {
        margin-top: 0.5rem;
    }

    .card-header i {
        opacity: 0.9;
    }

    /* --- RESPONSIVE --- */
    @media (max-width: 768px) {
        .metric-card {
            margin-bottom: 1rem;
        }

        .card-header h4 {
            font-size: 1rem;
        }
    }
</style>

@stop


@section('js')
@stack('scripts')

{{-- jQuery siempre primero --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

{{-- Bootstrap (usa jQuery, por eso va después) --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnDdM2B6U8LwW3hFw5xUq0g"
    crossorigin="anonymous"></script>

{{-- DataTables --}}
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

{{-- SweetAlert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- Iconos --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

{{-- DataTables con Bootstrap 4 --}}
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script>

<!-- script de datatables -->
<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            responsive: true,
            autoWidth: true,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.8/i18n/es-ES.json'
            }
        });
    });
</script>

<!-- script para confirmar el exito  -->

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

<!-- script para confirmar Eliminacion -->

<script>
    function confirmarEliminacion(event) {
        event.preventDefault();
        const form = event.target.closest('form');

        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }
</script>

<!-- script para tablas relacionadas  -->
@if(session('error'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'error',
            title: '¡Atención!',
            text: "{{ session('error') }}",
            confirmButtonText: 'Aceptar',
        });
    });
</script>
@endif
@stop