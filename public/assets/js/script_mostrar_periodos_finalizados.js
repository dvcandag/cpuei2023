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
                configurarSelectPeriodos();
            })
            .catch(error => {
                console.error('Error:', error);
                mostrarError('No se pudieron cargar los periodos');
            });
    }

    // Configurar el evento change para el select de periodos
    function configurarSelectPeriodos() {
        const select = document.getElementById('seleccion-curso');
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

