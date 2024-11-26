
document.addEventListener('DOMContentLoaded', function() {
    // Agrega un listener a todos los enlaces de navegación
    document.querySelectorAll('.enlace-ver-horario').forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault(); // Previene el comportamiento por defecto del enlace

            const view = this.getAttribute('data-view'); // Obtiene el valor de data-view
            cargarContenido(view); // Llama a la función para cargar el contenido
        });
    });

    // Función para cargar el contenido dinámicamente
    function cargarContenido(view) {
        fetch(`../views/${view}.php`) // Carga el archivo PHP correspondiente
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error al cargar el contenido'); // Manejo de errores
                }
                return response.text(); // Devuelve el contenido como texto
            })
            .then(html => {
                document.getElementById('contenido').innerHTML = html; // Inserta el HTML en el contenedor
            })
            .catch(error => console.error('Error al cargar contenido:', error));
    }
});
