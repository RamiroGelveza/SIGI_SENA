<!-- ===========================
      MODAL DE REPORTES
============================ -->
<div class="modal fade" id="modalReporteInvernadero" tabindex="-1"
    aria-labelledby="reporteModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow-lg border-0 rounded-3">

            <!-- HEADER -->
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="reporteModalLabel">
                    <i class="fas fa-chart-pie me-2"></i> Reporte del Invernadero
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <!-- BODY -->
            <div class="modal-body">

                <form id="formReportes" method="POST" action="">
                    @csrf

                    <input type="hidden" name="invernadero_id" id="invernadero_id">

                    <h6 class="text-secondary mb-3">
                        <i class="fas fa-filter me-2"></i> Filtros del Reporte
                    </h6>

                    <div class="row g-3 mb-4">

                        <!-- FECHA INICIO/FIN -->
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

                        <!-- TIPO REPORTE -->
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Tipo de Reporte</label>
                            <select name="tipo" class="form-select form-select-sm" required>
                                <option value="" disabled selected>Seleccione...</option>
                                <option value="cosechas_ingresos">Ingresos y Utilidad de Cosechas</option>
                                <option value="gastos_detalle">Detalle de Gastos</option>
                                <option value="mantenimientos">Registro de Mantenimientos</option>
                                <option value="resumen_general">Resumen General</option>
                            </select>
                        </div>

                    </div>

                    <hr>

                    <!-- ==========================
                         FILTROS ACTIVOS
                    ========================== -->
                    <h6 class="text-secondary mb-3">
                        <i class="fas fa-toggle-on me-2"></i> Filtros Activos
                    </h6>

                    <div id="filtrosActivos" class="mb-2">
                        <p class="text-muted small">No hay filtros activos</p>
                    </div>

                    <input type="hidden" name="modo" id="modoReporte" value="ver">

                </form>

            </div>

            <!-- FOOTER -->
            <div class="modal-footer justify-content-between">

                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i> Cerrar
                </button>

                <div class="d-flex gap-2">

                    <button class="btn btn-sm btn-warning" onclick="limpiarFiltros()">
                        <i class="fas fa-eraser me-1"></i> Limpiar
                    </button>

                    <button class="btn btn-sm btn-success" onclick="generarReporte('ver')">
                        <i class="fas fa-eye me-1"></i> Ver PDF
                    </button>

                    <button class="btn btn-sm btn-primary" onclick="generarReporte('descargar')">
                        <i class="fas fa-download me-1"></i> Descargar
                    </button>

                </div>

            </div>

        </div>
    </div>
</div>


<!-- ==========================
      SCRIPTS
========================== -->
<script>

    // Setear ID y ruta del invernadero al abrir modal
    function setInvernadero(id) {
        document.getElementById("invernadero_id").value = id;
        document.getElementById("formReportes").action = "/reportes/" + id + "/generar";

        console.log("Invernadero:", id);
    }

    function generarReporte(modo) {
        document.getElementById("modoReporte").value = modo;

        let form = document.getElementById("formReportes");

        if (modo === 'ver') form.target = "_blank";
        else form.target = "_self";

        form.submit();
    }

    function limpiarFiltros() {
        document.querySelector("input[name='fecha_inicio']").value = "";
        document.querySelector("input[name='fecha_fin']").value = "";
        document.querySelector("select[name='tipo']").selectedIndex = 0;

        actualizarFiltrosActivos();
    }

    function actualizarFiltrosActivos() {
        let inicio = document.querySelector("input[name='fecha_inicio']").value;
        let fin = document.querySelector("input[name='fecha_fin']").value;
        let tipoSel = document.querySelector("select[name='tipo']");
        let tipoTxt = tipoSel.options[tipoSel.selectedIndex]?.text;

        let box = document.getElementById("filtrosActivos");
        box.innerHTML = "";
        let hay = false;

        if (inicio) {
            hay = true;
            box.innerHTML += `<span class="badge bg-success me-1">Inicio: ${inicio}
                <span class="ms-2" onclick="borrarFiltro('fecha_inicio')" style="cursor:pointer">&times;</span></span>`;
        }

        if (fin) {
            hay = true;
            box.innerHTML += `<span class="badge bg-success me-1">Fin: ${fin}
                <span class="ms-2" onclick="borrarFiltro('fecha_fin')" style="cursor:pointer">&times;</span></span>`;
        }

        if (tipoSel.value) {
            hay = true;
            box.innerHTML += `<span class="badge bg-primary me-1">Tipo: ${tipoTxt}
                <span class="ms-2" onclick="borrarFiltro('tipo')" style="cursor:pointer">&times;</span></span>`;
        }

        if (!hay) {
            box.innerHTML = `<p class="text-muted small">No hay filtros activos</p>`;
        }
    }

    function borrarFiltro(campo) {
        if (campo === "tipo") {
            document.querySelector("select[name='tipo']").selectedIndex = 0;
        } else {
            document.querySelector(`input[name='${campo}']`).value = "";
        }
        actualizarFiltrosActivos();
    }

    document.querySelector("input[name='fecha_inicio']").addEventListener("change", actualizarFiltrosActivos);
    document.querySelector("input[name='fecha_fin']").addEventListener("change", actualizarFiltrosActivos);
    document.querySelector("select[name='tipo']").addEventListener("change", actualizarFiltrosActivos);

</script>
