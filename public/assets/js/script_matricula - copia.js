function cargarCursos(codPeriodo) {
    if (!codPeriodo) {
        console.error("No se ha seleccionado un período válido.");
        return;
    }

    fetch(`http://localhost/cpuei2023/index.php?action=obtenerCursosPorPeriodo&codPeriodo=${codPeriodo}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error al cargar los cursos');
            }
            return response.json(); // Devuelve los cursos en formato JSON
        })
        .then(cursos => {
            const contenedorDesaprobados = document.getElementById('cursos-desaprobados').querySelector('.container-listado-curso');
            const contenedorDisponibles = document.getElementById('cursos-disponibles').querySelector('.container-listado-curso');

            // Limpiar los contenedores
            contenedorDesaprobados.innerHTML = '';
            contenedorDisponibles.innerHTML = '';

            if (cursos.length > 0) {
                // Separar cursos desaprobados y disponibles
                const cursosDesaprobados = cursos.filter(curso => curso.estado === 'desaprobado');
                const cursosDisponibles = cursos.filter(curso => curso.estado === 'disponible');

                // Mostrar cursos desaprobados
                if (cursosDesaprobados.length > 0) {
                    cursosDesaprobados.forEach(curso => {
                        const cursoItem = document.createElement('div');
                        cursoItem.className = 'listado-curso curso-desaprobado';
                        cursoItem.innerHTML = `
                            <label>
                                <input type="checkbox" name="cursos[]" value="${curso.codcurso}" onchange="actualizarResumenSeleccion()">
                                ${curso.nombrecurso}
                                <span>(Curso obligatorio)</span>
                            </label>
                        `;
                        contenedorDesaprobados.appendChild(cursoItem);
                    });
                } else {
                    contenedorDesaprobados.innerHTML = '<p>No tienes cursos desaprobados.</p>';
                }

                // Mostrar cursos disponibles
                if (cursosDisponibles.length > 0) {
                    cursosDisponibles.forEach(curso => {
                        const cursoItem = document.createElement('div');
                        cursoItem.className = 'listado-curso';
                        cursoItem.innerHTML = `
                            <label>
                                <input type="checkbox" name="cursos[]" value="${curso.codcurso}" onchange="actualizarResumenSeleccion()">
                                ${curso.nombrecurso}
                            </label>
                        `;
                        contenedorDisponibles.appendChild(cursoItem);
                    });
                } else {
                    contenedorDisponibles.innerHTML = '<p class="mensaje-error">No hay cursos disponibles para este período.</p>';
                }
            } else {
                contenedorDisponibles.innerHTML = '<p class="mensaje-error">No hay cursos disponibles para este período.</p>';
            }
        })
        .catch(error => {
            console.error('Error al cargar los cursos:', error);
            document.getElementById('cursos-disponibles').innerHTML = '<p>Error al cargar los cursos.</p>';
        });
}

// Función para listar seleccion en  "resumen de selección"
function actualizarResumenSeleccion() {
    const contenedorResumen = document.getElementById('resumen-seleccion');
    contenedorResumen.innerHTML = ''; // Limpiar el resumen

    // Obtener todos los checkboxes seleccionados
    const cursosSeleccionados = document.querySelectorAll('input[name="cursos[]"]:checked');

    cursosSeleccionados.forEach(checkbox => {
        const cursoCod = checkbox.value;
        const cursoNombre = checkbox.parentNode.textContent.trim();

        // Crear el elemento de resumen
        const cursoItem = document.createElement('div');
        cursoItem.classList.add('curso-resumen');
        cursoItem.innerHTML = `<span>${cursoNombre}</span>`;
        contenedorResumen.appendChild(cursoItem);
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
