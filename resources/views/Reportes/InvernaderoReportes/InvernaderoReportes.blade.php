<!-- =========================== MODAL DE REPORTES ============================ -->
<div class="modal fade" id="modalReporteInvernadero" tabindex="-1" aria-labelledby="reporteModalLabel" aria-hidden="true">
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

                <!-- FORMULARIO GENERAL (ÚNICO PARA VER Y DESCARGAR) -->
                <form id="formReportes" method="GET">
                    <input type="hidden" name="invernadero_id" id="invernadero_id">
                    <input type="hidden" name="tipo" id="inputTipo">
                    <input type="hidden" name="modo" id="modoReporte">

                    <h6 class="text-secondary mb-3">
                        <i class="fas fa-filter me-2"></i> Seleccione un tipo de reporte
                    </h6>

                    <div class="row g-3 mb-2">

                        <!-- SELECT -->
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Tipo de Reporte</label>
                            <select id="selectTipo" class="form-select form-select-sm" required>
                                <option value="" disabled selected>Seleccione...</option>
                                <option value="cosechas_ingresos">Ingresos y Utilidad de Cosechas</option>
                                <option value="gastos_detalle">Detalle de Gastos</option>
                                <option value="mantenimientos">Registro de Mantenimientos</option>
                                <option value="resumen_general">Resumen General</option>
                            </select>
                        </div>

                        <!-- ========================== FILTROS ACTIVOS ========================== -->
                        <div class="col-6">
                            <h6 class="text-secondary mb-3">
                                <i class="fas fa-toggle-on me-2"></i> Filtros Activos
                            </h6>

                            <div id="filtrosActivos" class="mb-2">
                                <p class="text-muted small">No hay filtros activos</p>
                            </div>

                        </div>
                    </div>

                </form>

            </div>

            <!-- FOOTER -->
            <div class="modal-footer d-flex justify-content-between align-items-center">

                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i> Cerrar
                </button>

                <div class="d-flex gap-2">

                    <button class="btn btn-sm btn-warning" onclick="limpiarFiltros()">
                        <i class="fas fa-eraser me-1"></i> Limpiar
                    </button>

                    <!-- VER -->
                    <button id="btnVer" class="btn btn-sm btn-success" onclick="generarReporte('ver')" disabled>
                        <i class="fas fa-eye me-1"></i> Ver PDF
                    </button>

                    <!-- DESCARGAR -->
                    <button id="btnDescargar" class="btn btn-sm btn-primary" onclick="generarReporte('descargar')" disabled>
                        <i class="fas fa-download me-1"></i> Descargar
                    </button>

                </div>

            </div>
        </div>
    </div>
</div>

<!-- ========================== SCRIPTS ========================== -->
<script>
/* HABILITAR O DESHABILITAR BOTONES SEGÚN SELECT */
const selectTipo = document.getElementById("selectTipo");
const btnVer = document.getElementById("btnVer");
const btnDescargar = document.getElementById("btnDescargar");

selectTipo.addEventListener("change", () => {
    const habilitar = selectTipo.value !== "";
    btnVer.disabled = !habilitar;
    btnDescargar.disabled = !habilitar;
    actualizarFiltrosActivos();
});

/* SETEAR ID DEL INVERNADERO */
function setInvernadero(id) {
    document.getElementById("invernadero_id").value = id;
}

/* GENERAR REPORTE: ver o descargar */
function generarReporte(modo) {
    const tipo = selectTipo.value;
    if (!tipo) return;

    const id = document.getElementById("invernadero_id").value;

    const form = document.getElementById("formReportes");
    const inputTipo = document.getElementById("inputTipo");

    inputTipo.value = tipo;
    document.getElementById("modoReporte").value = modo;

    // Rutas
    if (modo === "ver") {
        form.target = "_blank";
        form.action = `/reportes/${id}/generar`;
    } else {
        form.target = "_self";
        form.action = `/reporte/${id}/descargar`;
    }

    form.submit();
}

/* LIMPIAR FILTROS */
function limpiarFiltros() {
    selectTipo.selectedIndex = 0;
    btnVer.disabled = true;
    btnDescargar.disabled = true;
    actualizarFiltrosActivos();
}

/* MOSTRAR FILTROS ACTIVOS */
function actualizarFiltrosActivos() {
    let box = document.getElementById("filtrosActivos");
    let tipoTxt = selectTipo.options[selectTipo.selectedIndex]?.text;

    if (selectTipo.value) {
        box.innerHTML = `
            <span class="badge bg-success me-1">
                Tipo: ${tipoTxt}
                <span class="ms-2" onclick="borrarFiltro()" style="cursor:pointer">&times;</span>
            </span>`;
    } else {
        box.innerHTML = `<p class="text-muted small">No hay filtros activos</p>`;
    }
}

/* BORRAR FILTRO */
function borrarFiltro() {
    limpiarFiltros();
}
</script>
