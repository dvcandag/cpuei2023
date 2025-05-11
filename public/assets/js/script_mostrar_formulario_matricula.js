document.addEventListener('DOMContentLoaded', function () {
    // Selecciona el enlace para mostrar el formulario de matrícula
    document.querySelectorAll('.enlace-ver-formulario-matricula').forEach(link => {
        link.addEventListener('click', function (event) {
            event.preventDefault(); // Previene el comportamiento por defecto del enlace

            const codPeriodo = this.getAttribute('data-codperiodo'); // Obtiene el código del período
            mostrarFormularioMatricula(codPeriodo); // Llama a la función para mostrar el formulario
        });
    });

    // Función para mostrar el formulario de matrícula
    function mostrarFormularioMatricula(codPeriodo) {
        fetch(`http://localhost/cpuei2023/index.php?action=mostrarMatricula&codPeriodo=${codPeriodo}`) // Hace la solicitud al controlador
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error al cargar el formulario de matrícula');
                }
                return response.text(); // Devuelve el contenido como texto
            })
            .then(html => {
                console.log(html); // Para depurar qué HTML está llegando
                document.getElementById('contenido').innerHTML = html; // Inserta el HTML en el contenedor
            })
            .catch(error => {
                console.error('Error al cargar el formulario de matrícula:', error); // Manejo de errores
            });
    }
});