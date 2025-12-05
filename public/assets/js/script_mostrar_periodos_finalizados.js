document.addEventListener('DOMContentLoaded', function() {
    // Manejar clic en el enlace de periodos finalizados
    document.querySelectorAll('.js-periodos-finalizados').forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            cargarPeriodosFinalizados();
        });
    });

    // Función para cargar la vista de periodos finalizados
    function cargarPeriodosFinalizados() {
    fetch('http://localhost/cpuei2023/index.php?action=mostrarPeriodosFinalizados')
        .then(response => {
            if (!response.ok) throw new Error('Error al cargar periodos');
            return response.text();
        })
        .then(html => {
            document.getElementById('contenido').innerHTML = html;

            configurarSelectPeriodos(); // reactivar evento

            // ✅ Intentar encontrar un periodo ya seleccionado
            const select = document.getElementById('seleccion-periodo');
            if (select && select.value) {
                // Llamar a cargarResumenPeriodo inmediatamente
                cargarResumenPeriodo(select.value);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            mostrarError('No se pudieron cargar los periodos');
        });
}


    // Configurar el evento change para el select de periodos
    function configurarSelectPeriodos() {
        const select = document.getElementById('seleccion-periodo');
        if (!select) return;

        select.addEventListener('change', function() {
            const codPeriodo = this.value;
            if (!codPeriodo) return;

            fetch(`http://localhost/cpuei2023/index.php?action=mostrarPeriodosFinalizados&codPeriodo=${codPeriodo}`)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('contenido').innerHTML = html;
                    configurarSelectPeriodos(); // Reconfigurar para el nuevo contenido
                })
                .catch(error => console.error('Error:', error));
        });
    }


function cargarResumenPeriodo(codPeriodo) {
    fetch(`http://localhost/cpuei2023/index.php?action=obtenerResumenPeriodo&codPeriodo=${codPeriodo}`)
        .then(response => response.json())
        .then(data => {
            if (data && !data.error) {
                const contenedor = document.getElementById('contenedor-resumen');

                // Asegurar que existe el contenedor
                if (!contenedor) return;

                contenedor.innerHTML = `
                    <header class="resumen-header">
                        <span>Resumen general del ciclo</span>
                    </header>
                    <div class="resumen-contenido">
                        <div class="resumen-indicador">
                            <div class="resumen-etiqueta">Campus:</div>
                            <div class="resumen-dato">${data.campus}</div>
                        </div>
                        <div class="resumen-indicador">
                            <div class="resumen-etiqueta">Cursos matriculados:</div>
                            <div class="resumen-dato">${data.cursos_matriculados ?? 'N/A'}</div>
                        </div>
                        <div class="resumen-indicador">
                            <div class="resumen-etiqueta">Ciclo relativo:</div>
                            <div class="resumen-dato">${data.ciclo_relativo}</div>
                        </div>
                        <div class="resumen-indicador">
                            <div class="resumen-etiqueta">Horas semanales:</div>
                            <div class="resumen-dato">${data.horas_semanales}</div>
                        </div>
                        <div class="resumen-indicador">
                            <div class="resumen-etiqueta">Cantidad de créditos:</div>
                            <div class="resumen-dato">${data.cantidad_creditos}</div>
                        </div>
                        <div class="resumen-indicador">
                            <div class="resumen-etiqueta">Orden de mérito:</div>
                            <div class="resumen-dato">${data.orden_merito ?? 'N/A'}</div>
                        </div>
                    </div>
                `;
            } else {
                console.warn(data.error || 'No se encontraron datos');
            }
        })
        .catch(error => console.error('Error al cargar resumen:', error));
}



    // Función para mostrar errores
    function mostrarError(mensaje) {
        const contenido = document.getElementById('contenido');
        contenido.innerHTML = `
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle"></i>
                ${mensaje}
            </div>
        `;
    }
});

