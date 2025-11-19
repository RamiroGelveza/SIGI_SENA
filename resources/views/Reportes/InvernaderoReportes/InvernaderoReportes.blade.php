<div class="modal fade" id="modalGenerarReporte" tabindex="-1" aria-labelledby="reporteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow-lg border-0 rounded-3">

            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="reporteModalLabel">
                    <i class="fas fa-chart-bar me-2"></i> Reportes por Invernadero
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                {{-- FORMULARIO ÚNICO --}}
                <form id="formReportes" action="{{ route('Invernadero.pdf') }}" method="POST" >
                    @csrf
                    <h6 class="text-secondary mb-3">
                        <i class="fas fa-filter me-2"></i> Filtros del Reporte
                    </h6>

                    <div class="row g-3 mb-4">

                        {{-- RANGO DE FECHAS --}}
                        <div class="col-md-6">
                            <div class="row g-2">
                                <div class="col-6">
                                    <label class="form-label small fw-bold">Fecha Inicio</label>
                                    <input type="date" name="fecha_inicio" class="form-control form-control-sm">
                                </div>
                                <div class="col-6">
                                    <label class="form-label small fw-bold">Fecha Fin</label>
                                    <input type="date" name="fecha_fin" class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>

                        {{-- TIPO DE REPORTE --}}
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Tipo de Reporte</label>
                            <select name="tipo" class="form-select form-select-sm" required>
                                <option value="" disabled selected>Seleccione un tipo de reporte</option>
                                <option value="cosechas_ingresos">Ingresos y Utilidad de Cosechas</option>
                                <option value="gastos_detalle">Detalle de Gastos</option>
                                <option value="mantenimientos">Registro de Mantenimientos</option>
                                <option value="resumen_general">Resumen General</option>
                            </select>
                        </div>

                    </div>

                    <hr>

                    {{-- OPCIONES DE SALIDA --}}
                    <!-- FILTROS ACTIVOS -->
<h6 class="text-secondary mb-3">
    <i class="fas fa-filter-circle-check me-2"></i> Filtros Activos
</h6>

<div id="filtrosActivos" class="mb-3">

    <!-- Se llenará automáticamente con JS -->
    <p class="text-muted small">No hay filtros activos</p>

</div>

<input type="hidden" name="invernadero_id" value="{{ $invernadero->id }}">
<input type="hidden" name="modo" id="modoReporte" value="ver">


                </form>

            </div>

            {{-- FOOTER --}}
            <div class="modal-footer justify-content-between">

                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i> Cerrar
                </button>

                <div class="d-flex gap-2">

                    {{-- LIMPIAR FILTROS --}}
                    <button class="btn btn-sm btn-warning" onclick="limpiarFiltros()">
                        <i class="fas fa-eraser me-1"></i> Limpiar
                    </button>

                    {{-- VER EN PESTAÑA NUEVA --}}
                    <button class="btn btn-sm btn-success" onclick="generarReporte('ver')">
                        <i class="fas fa-eye me-1"></i> Ver PDF
                    </button>

                    {{-- DESCARGAR --}}
                    <button class="btn btn-sm btn-primary" onclick="generarReporte('descargar')">
                        <i class="fas fa-download me-1"></i> Descargar PDF
                    </button>

                </div>

            </div>
        </div>
    </div>
</div>


<script>
    function generarReporte(modo) {
        document.getElementById('modoReporte').value = modo;

        const form = document.getElementById('formReportes');

        if (modo === 'ver') {
            form.target = '_blank'; // abrir en nueva pestaña
        } else {
            form.target = '_self'; // descargar en la pestaña actual
        }

        form.submit();
    }

    function limpiarFiltros() {
        document.querySelector("input[name='fecha_inicio']").value = "";
        document.querySelector("input[name='fecha_fin']").value = "";
        document.querySelector("select[name='tipo']").selectedIndex = 0;
    }
</script>
<script>
    function actualizarFiltrosActivos() {
        let fechaInicio = document.querySelector("input[name='fecha_inicio']").value;
        let fechaFin = document.querySelector("input[name='fecha_fin']").value;
        let tipo = document.querySelector("select[name='tipo']");
        let tipoTexto = tipo.options[tipo.selectedIndex]?.text;

        let contenedor = document.getElementById("filtrosActivos");
        contenedor.innerHTML = ""; // limpiar

        let existen = false;

        if (fechaInicio) {
            existen = true;
            contenedor.innerHTML += `
                <span class="badge bg-success me-2">
                    Inicio: ${fechaInicio}
                    <span class="ms-2" style="cursor:pointer" onclick="borrarFiltro('fecha_inicio')">&times;</span>
                </span>`;
        }

        if (fechaFin) {
            existen = true;
            contenedor.innerHTML += `
                <span class="badge bg-success me-2">
                    Fin: ${fechaFin}
                    <span class="ms-2" style="cursor:pointer" onclick="borrarFiltro('fecha_fin')">&times;</span>
                </span>`;
        }

        if (tipo.value) {
            existen = true;
            contenedor.innerHTML += `
                <span class="badge bg-primary me-2">
                    Tipo: ${tipoTexto}
                    <span class="ms-2" style="cursor:pointer" onclick="borrarFiltro('tipo')">&times;</span>
                </span>`;
        }

        if (!existen) {
            contenedor.innerHTML = `<p class="text-muted small">No hay filtros activos</p>`;
        }
    }

    // Eliminar filtro individual
    function borrarFiltro(campo) {
        if (campo === 'tipo') {
            document.querySelector("select[name='tipo']").selectedIndex = 0;
        } else {
            document.querySelector(`input[name='${campo}']`).value = "";
        }
        actualizarFiltrosActivos();
    }

    // Hook: cuando cambian los filtros
    document.querySelector("input[name='fecha_inicio']").addEventListener("change", actualizarFiltrosActivos);
    document.querySelector("input[name='fecha_fin']").addEventListener("change", actualizarFiltrosActivos);
    document.querySelector("select[name='tipo']").addEventListener("change", actualizarFiltrosActivos);

    // Llamar al abrir modal
    document.addEventListener('DOMContentLoaded', actualizarFiltrosActivos);
    function limpiarFiltros() {
    document.querySelector("input[name='fecha_inicio']").value = "";
    document.querySelector("input[name='fecha_fin']").value = "";
    document.querySelector("select[name='tipo']").selectedIndex = 0;

    actualizarFiltrosActivos(); // ← NECESARIO PARA QUE SE LIMPIE LA VISTA
}

</script>
