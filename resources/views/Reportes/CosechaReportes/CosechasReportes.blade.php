{% raw %}
<div class="modal fade" id="modalReportesUnico" tabindex="-1" aria-labelledby="modalReportesLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">

            <div class="modal-header bg-gradient-success text-white py-3 px-4">
                <h5 class="fw-bold">
                    <i class="fas fa-chart-line me-2"></i> Reporte de Cosecha: <span id="cosechaTituloDinamico">Cargando...</span>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body p-4">
                <form id="formReportesCosechaUnico" method="GET" target="_blank">
                    @csrf

                    <input type="hidden" name="cosecha_id" id="inputCosechaId" value="">
                    <input type="hidden" name="cultivo_id" id="inputCultivoId" value="">
                    
                    <div class="row g-4">
                        
                        <div class="col-md-6"> 
                            <label class="form-label fw-bold text-primary">🌱 Cultivo</label>
                            <div class="bg-light p-3 border rounded-3 form-control-lg shadow-sm">
                                <strong class="text-dark" id="cultivoNombreDinamico"></strong>
                            </div>
                        </div>

                        <div class="col-md-6"> 
                            <label class="form-label fw-bold text-primary">📅 Rango de Fechas</label>
                            <div class="input-group shadow-sm">
                                <input type="date" class="form-control form-control-lg" name="fecha_inicio" id="fechaInicioFiltro" title="Fecha de inicio">
                                <span class="input-group-text bg-light fw-bold text-muted">A</span>
                                <input type="date" class="form-control form-control-lg" name="fecha_fin" id="fechaFinFiltro" title="Fecha de fin">
                            </div>
                        </div>
                        
                        </div>

                    <div class="d-flex justify-content-between align-items-center mt-5 pt-3 border-top">
                        <div>
                            <button type="button" id="btnLimpiarFiltrosUnico" class="btn btn-outline-secondary btn-sm rounded-pill">
                                <i class="fas fa-eraser"></i> Limpiar filtros
                            </button>
                        </div>
                        <div>
                            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">
                                <i class="fas fa-times"></i> Cerrar
                            </button>
                            <button type="submit" formaction="{{ route('cosechas.reporte.vista') }}" formtarget="_blank" class="btn btn-info text-white me-2">
                                <i class="fas fa-eye"></i> Ver Reporte
                            </button>
                            <button type="submit" formaction="{{ route('cosechas.reporte.pdf') }}" class="btn btn-danger">
                                <i class="fas fa-file-pdf"></i> Descargar PDF
                            </button>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div id="filtrosAplicadosDinamico" class="alert alert-secondary d-none border-0 rounded-3">
                        <h6 class="fw-bold mb-1 text-dark"><i class="fas fa-filter me-1"></i> Filtros activos:</h6>
                        <div id="filtrosTextoDinamico" class="mt-2"></div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
{% endraw %}
<script>
document.addEventListener('DOMContentLoaded', function () {
    
    const modalReportesUnico = document.getElementById('modalReportesUnico');
    const form = document.getElementById('formReportesCosechaUnico');
    
    // Referencias de los elementos del modal (IDs fijos)
    const inputCosechaId = document.getElementById('inputCosechaId');
    const inputCultivoId = document.getElementById('inputCultivoId');
    const spanCosechaNombre = document.getElementById('cosechaTituloDinamico');
    const cultivoNombreFijo = document.getElementById('cultivoNombreDinamico');
    // const estadoSelect = document.getElementById('estadoFiltro'); <-- ELIMINADO
    const fechaInicioInput = document.getElementById('fechaInicioFiltro');
    const fechaFinInput = document.getElementById('fechaFinFiltro');
    const filtrosDiv = document.getElementById('filtrosAplicadosDinamico');
    const filtrosTexto = document.getElementById('filtrosTextoDinamico');
    const btnLimpiar = document.getElementById('btnLimpiarFiltrosUnico');


    // -----------------------------------------------------
    // A. Llenar el modal al abrir
    // -----------------------------------------------------
    modalReportesUnico.addEventListener('show.bs.modal', function (event) {
        
        const button = event.relatedTarget; 

        // Obtener los datos del botón
        const cosechaId = button.getAttribute('data-cosecha-id');
        const cultivoId = button.getAttribute('data-cultivo-id');
        const cultivoNombre = button.getAttribute('data-cultivo-nombre');

        // Inyectar datos
        spanCosechaNombre.textContent = `#${cosechaId} (${cultivoNombre})`;
        cultivoNombreFijo.textContent = cultivoNombre;
        
        // Inyectar datos en el formulario (CRUCIAL para el backend)
        inputCosechaId.value = cosechaId;
        inputCultivoId.value = cultivoId;
        
        form.reset();
        actualizarFiltros(); 
    });


    // -----------------------------------------------------
    // B. Lógica de Previsualización de Filtros (Actualizada)
    // -----------------------------------------------------
    const actualizarFiltros = () => {
        let texto = '';
        
        // 1. Filtro de Cultivo (Siempre activo)
        const nombreFijo = cultivoNombreFijo.textContent || 'Sin Cultivo';
        texto += `<span class="badge bg-primary text-white me-2 py-2 px-3"><i class="fas fa-seedling me-1"></i> Cultivo: ${nombreFijo}</span>`;

        // 2. Filtro de Fechas (Solo por fechas)
        const f1 = fechaInicioInput.value;
        const f2 = fechaFinInput.value;
        if (f1 || f2) {
            texto += `<span class="badge bg-warning text-dark me-2 py-2 px-3"><i class="fas fa-calendar-alt me-1"></i> Fechas: ${f1 || '...'} a ${f2 || '...'}</span>`;
        }
        
        // 3. Renderizar
        if (texto) {
            filtrosDiv.classList.remove('d-none');
            filtrosTexto.innerHTML = texto;
        } else {
            // Esto es solo un fallback, ya que el Cultivo siempre debe aparecer
            filtrosDiv.classList.add('d-none'); 
        }
    };

    // Escuchar cambios en el formulario (solo Fechas)
    form.addEventListener('change', actualizarFiltros);
    
    // Botón Limpiar Filtros
    btnLimpiar.addEventListener('click', () => {
        form.reset();
        actualizarFiltros(); 
    });
});
</script>