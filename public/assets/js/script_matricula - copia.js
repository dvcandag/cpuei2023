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
                const contenedorCursos = document.getElementById('cursos-periodo');
                contenedorCursos.innerHTML = ''; // Limpiar el contenedor

                if (cursos.length > 0) {
                    const listaCursos = document.createElement('div');
                    listaCursos.className = 'lista-cursos';

                    cursos.forEach(curso => {
                        const cursoItem = document.createElement('div');
                        cursoItem.className = 'curso-item';
                        cursoItem.innerHTML = `
                            <label>
                                <input type="checkbox" name="cursos[]" value="${curso.codcurso}">
                                ${curso.nombrecurso} (${curso.creditos} créditos)
                            </label>
                        `;
                        listaCursos.appendChild(cursoItem);
                    });

                    contenedorCursos.appendChild(listaCursos);
                } else {
                    contenedorCursos.innerHTML = '<p>No hay cursos disponibles para este período.</p>';
                }
            })
            .catch(error => {
                console.error('Error al cargar los cursos:', error);
                document.getElementById('cursos-periodo').innerHTML = '<p>Error al cargar los cursos.</p>';
            });
    }