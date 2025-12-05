function cargarCursos(codPeriodo) {
    if (!codPeriodo) return;

    // AÑADE ESTA LÍNEA para actualizar el campo oculto
    document.querySelector('input[name="codPeriodo"]').value = codPeriodo;

    fetch(`http://localhost/cpuei2023/index.php?action=obtenerCursosPorPeriodo&codPeriodo=${codPeriodo}`)
        .then(response => response.json())
        .then(cursos => {
            const contenedorDesaprobados = document.querySelector('#cursos-desaprobados .container-listado-curso');
            const contenedorDisponibles = document.querySelector('#cursos-disponibles .container-listado-curso');

            contenedorDesaprobados.innerHTML = '';
            contenedorDisponibles.innerHTML = '';

            const desaprobados = cursos.filter(c => c.estado === 'desaprobado');
            const disponibles = cursos.filter(c => c.estado === 'disponible');

            desaprobados.forEach(curso => {
                contenedorDesaprobados.innerHTML += `
                    <div>
                        <label>
                            <input type="checkbox" name="cursos[]" value="${curso.codcurso}" onchange="actualizarResumenSeleccion()">
                            ${curso.nombrecurso} <span>(Curso obligatorio)</span>
                        </label>
                    </div>`;
            });

            disponibles.forEach(curso => {
                contenedorDisponibles.innerHTML += `
                    <div>
                        <label>
                            <input type="checkbox" name="cursos[]" value="${curso.codcurso}" onchange="actualizarResumenSeleccion()">
                            ${curso.nombrecurso}
                        </label>
                    </div>`;
            });

            actualizarResumenSeleccion();
        });
}

function actualizarResumenSeleccion() {
    const contenedorResumen = document.getElementById('resumen-seleccion');
    const seleccionados = document.querySelectorAll('input[name="cursos[]"]:checked');

    contenedorResumen.innerHTML = seleccionados.length === 0
        ? '<p>No hay cursos seleccionados</p>'
        : '';

    seleccionados.forEach(curso => {
        contenedorResumen.innerHTML += `<div>${curso.parentNode.textContent.trim()}</div>`;
    });
}

// Función para eliminar un curso del resumen
function eliminarCurso(codCurso) {
    // Desmarcar el checkbox del curso
    const checkbox = document.querySelector(`input[name="cursos[]"][value="${codCurso}"]`);
    checkbox.checked = false;

    // Llamar a la función para actualizar el resumen
    actualizarResumenSeleccion();
}