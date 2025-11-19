@extends('layouts.app')

@section('title', 'Dashboard de la Cosecha')

@section('content')

<div class="container py-5">
    
    <div class="card shadow-lg border-0 mb-5">
        <div class="card-body bg-success text-white rounded-3 p-4 p-md-5">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                
                <div class="mb-4 mb-md-0">
                    <h1 class="fw-bolder display-6 mb-2">
                        <i class="bi bi-tree-fill me-2"></i> Gestión Financiera: {{ $cosecha->tiposCultivo->nombre ?? 'Cosecha' }}
                    </h1>
                    <p class="fs-5 mb-0 opacity-75">
                        <i class="bi bi-shop me-1"></i> Invernadero: <strong class="text-warning">{{ $cosecha->invernadero->nombre ?? 'N/D' }}</strong>
                        <span class="mx-3 d-none d-sm-inline">|</span>
                        <i class="bi bi-activity me-1"></i> Estado: 
                        <span class="badge bg-light text-success fw-bold">{{ $cosecha->estadosCosecha->nombre ?? 'Sin estado' }}</span>
                    </p>
                </div>

                <a href="{{ route('Cosechas.index', ['idinvernadero' => $cosecha->idInvernadero]) }}" class="btn btn-outline-light btn-lg fw-bold shadow-sm">
                    <i class="bi bi-arrow-left-circle-fill"></i> Volver a Invernadero
                </a>
            </div>
        </div>
    </div>
    
    <div class="row g-4 mb-5 text-center">
        
        <div class="col-md-4">
            <div class="card shadow-sm border-success border-3 h-100 lift-up">
                <div class="card-body">
                    <div class="text-success mb-3">
                        <i class="bi bi-graph-up-arrow fs-2"></i>
                    </div>
                    <h6 class="text-uppercase text-muted fw-bold">Ingresos Totales</h6>
                    <h2 class="fw-bolder text-success display-5">
                        ${{ number_format($totalIngresos, 0, ',', '.') }}
                    </h2>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card shadow-sm border-danger border-3 h-100 lift-up">
                <div class="card-body">
                    <div class="text-danger mb-3">
                        <i class="bi bi-graph-down-arrow fs-2"></i>
                    </div>
                    <h6 class="text-uppercase text-muted fw-bold">Gastos Totales</h6>
                    <h2 class="fw-bolder text-danger display-5">
                        ${{ number_format($totalGastos, 0, ',', '.') }}
                    </h2>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card shadow-lg border-primary border-3 h-100 lift-up">
                <div class="card-body">
                    <div class="text-primary mb-3">
                        <i class="bi bi-currency-exchange fs-2"></i>
                    </div>
                    <h6 class="text-uppercase text-muted fw-bold">Utilidad Neta</h6>
                    <h2 class="fw-bolder display-5 {{ $utilidad >= 0 ? 'text-success' : 'text-danger' }}">
                        ${{ number_format($utilidad, 0, ',', '.') }}
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow border-0 mb-5">
        <div class="card-body p-4">
            <h4 class="fw-bold mb-3"><i class="bi bi-bar-chart-fill me-2"></i> Balance General</h4>
            
            {{-- EL CONTENEDOR CON CSS PARA FIJAR LA ALTURA --}}
            <div class="chart-container">
                <canvas id="graficoFinanzas"></canvas>
            </div>
            
        </div>
    </div>
    
    <div class="row g-4">
        
        <div class="col-md-6">
            <div class="card shadow border-0 h-100">
                <div class="card-header bg-success bg-opacity-75 text-white d-flex justify-content-between align-items-center py-3">
                    <h5 class="mb-0"><strong><i class="bi bi-cash-stack me-2"></i> Detalle de Ingresos</strong></h5>
                    <a href="{{ route('Ingresos.create', $cosecha->id) }}" class="btn btn-primary btn-sm fw-bold shadow-sm">
                        <i class="bi bi-pencil-square"></i> Crear
                    </a>
                </div>
                <div class="card-body p-0 table-responsive">
                    <table id="myTable" class="table table-striped table-hover align-middle mb-0">
                        <thead class="table-light text-center">
                            <tr>
                                <th>Fecha</th>
                                <th>Concepto</th>
                                <th>Valor Total</th>
                                <th>Accion</th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse($ingresos as $ingreso)
                                <tr class="text-center">
                                    <td>{{ date('d/m/Y', strtotime($ingreso->fecha)) }}</td>
                                    {{-- Asumimos que 'descripcion' es la columna correcta para el concepto --}}
                                    <td>{{ $ingreso->descripcion ?? 'Venta' }}</td> 
                                    {{-- El cálculo se hace aquí para mostrar el valor total --}}
                                    <td class="text-success fw-bold">${{ number_format(((float)$ingreso->cantidadVendida * (float)$ingreso->precioUnitario), 0, ',', '.') }}</td>
                               <td>
                                        <div class="dropdown position-left top-2 end-2 mt-0 me-0 ">
                    <button class="btn btn-light btn-sm border-0"
                        type="button"
                        data-toggle="dropdown"
                        aria-expanded="true"
                        title="Más opciones">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">


                        {{-- Editar --}}
                        <li>
                            <a href="{{ route('Ingresos.edit',$ingreso->id) }}" class="dropdown-item text-warning">
                                <i class="fas fa-fw fa-edit me-2" style="color:#FFE70F !important;"></i> Editar
                            </a>
                        </li>

                        {{-- Eliminar --}}
                        <li>
                            <form action="{{ route('Ingresos.destroy',$ingreso->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger"
                                    onclick="confirmarEliminacion(event)">
                                    <i class="fas fa-fw fa-trash-alt me-2" style="color:#F82B2B !important;"></i> Eliminar
                                </button>
                            </form>
                        </li>
                    </ul>
                 </div>
                </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">No hay ingresos registrados para esta cosecha.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow border-0 h-100">
                <div class="card-header bg-danger bg-opacity-75 text-white d-flex justify-content-between align-items-center py-3">
                    <h5 class="mb-0"><strong><i class="bi bi-receipt-cutoff me-2"></i> Detalle de Gastos</strong></h5>
                    <a href="{{ route('Gastos.create', $cosecha->id) }}" class="btn btn-warning btn-sm fw-bold shadow-sm">
                        <i class="bi bi-pencil-square"></i> Crear
                    </a>
                </div>
                <div class="card-body p-0 table-responsive">
                    <table id="dataTable" class="table table-striped table-hover align-middle mb-0">
                        <thead class="table-light text-center">
                            <tr>
                                <th>Fecha</th>
                                <th>Concepto</th>
                                <th>Categoria</th>
                                <th>Valor</th>
                                <th>Accion</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($gastos as $gasto)
                                <tr class="text-center">
                                    <td>{{ date('d/m/Y', strtotime($gasto->fecha)) }}</td>
                                    <td>{{ $gasto->descripcion ?? 'Gasto' }}</td>
                                    <td>{{ $gasto->categoriaGasto->nombre ?? 'Sin categoría' }}</td>


                                    <td class="text-danger fw-bold">${{ number_format($gasto->monto, 0, ',', '.') }}</td>
                                    
                                    <td>
                                        <div class="dropdown position-left top-2 end-2 mt-0 me-0 ">
                    <button class="btn btn-light btn-sm border-0"
                        type="button"
                        data-toggle="dropdown"
                        aria-expanded="true"
                        title="Más opciones">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">


                        {{-- Editar --}}
                        <li>
                            <a href="{{ route('Gastos.edit',$gasto->id) }}" class="dropdown-item text-warning">
                                <i class="fas fa-fw fa-edit me-2" style="color:#FFE70F !important;"></i> Editar
                            </a>
                        </li>

                        {{-- Eliminar --}}
                        <li>
                            <form action="{{ route('Gastos.destroy',$gasto->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger"
                                    onclick="confirmarEliminacion(event)">
                                    <i class="fas fa-fw fa-trash-alt me-2" style="color:#F82B2B !important;"></i> Eliminar
                                </button>
                            </form>
                        </li>
                    </ul>
                 </div>
                </div>
                 </td>


                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">No hay gastos registrados para esta cosecha.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- 🎨 ESTILOS CSS para los efectos visuales y el FIX del gráfico --}}
<style>
/* Estilo para el efecto de elevación de las tarjetas */
.lift-up {
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}
.lift-up:hover {
    transform: translateY(-5px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
}

/* 🚨 FIX PARA EL TAMAÑO DEL GRÁFICO 🚨 */
.chart-container {
    position: relative; 
    height: 350px; /* Altura máxima que queremos para el gráfico */
    width: 100%; 
    margin: auto;
}
</style>

@push('scripts')
{{-- Asegúrate de que tienes Chart.js incluido en tu layout.app o añádelo aquí si no lo está --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script> 

<script>
document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('graficoFinanzas');
    
    // Datos pasados desde Laravel
    const totalIngresos = {{ $totalIngresos }};
    const totalGastos = {{ $totalGastos }};

    if (ctx) { // Asegura que el elemento existe antes de inicializar el gráfico
        const graficoFinanzas = new Chart(ctx, {
            type: 'doughnut', 
            data: {
                labels: ['Ingresos', 'Gastos'],
                datasets: [{
                    data: [totalIngresos, totalGastos],
                    backgroundColor: [
                        'rgba(40, 167, 69, 0.8)', // Verde
                        'rgba(220, 53, 69, 0.8)',  // Rojo
                    ],
                    borderColor: [
                        '#fff',
                        '#fff'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false, // CLAVE: Permite que la altura definida en CSS controle el tamaño
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { font: { size: 14 } }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                let label = tooltipItem.label || '';
                                if (label) { label += ': '; }
                                // Formato de moneda
                                label += '$' + Number(tooltipItem.raw).toLocaleString('es-CO'); 
                                return label;
                            }
                        }
                    },
                    title: {
                        display: true,
                        text: 'Distribución de Flujo de Caja'
                    }
                }
            }
        });
    }
});
</script>

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            responsive: true,
            autoWidth: true,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.8/i18n/es-ES.json'
            }
        });
    });
</script>
@endpush
@endsection