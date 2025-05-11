document.addEventListener('DOMContentLoaded', function () {
    // Selecciona tanto enlaces con clase 'enlace-navegacion' como 'enlace-ver-horario'
    document.querySelectorAll('.enlace-navegacion, .enlace-ver-horario').forEach(link => {
        link.addEventListener('click', function (event) {
            event.preventDefault(); // Previene el comportamiento por defecto del enlace

            const view = this.getAttribute('data-view'); // Obtiene el valor de data-view
            if (view === "HorarioAlumnoView") {
                cargarHorario(); // Llama a la función para cargar el contenido del horario
            } else {
                cargarContenido(view); // Llama a la función para cargar el contenido genérico
            }
        });
    });

    // Función para cargar el contenido del horario desde el controlador
    function cargarHorario() {
        fetch('http://localhost/cpuei2023/index.php?action=mostrarHorario') // Se hace la solicitud al controlador
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error al cargar el contenido');
                }
                return response.text(); // Devuelve el contenido como texto
            })
            .then(html => {
                console.log(html); // Para depurar qué HTML está llegando
                document.getElementById('contenido').innerHTML = html; // Inserta el HTML en el contenedor
            })
            .catch(error => {
                console.error('Error al cargar contenido:', error); // Manejo de errores
            });
    }

    // Función para cargar contenido genérico
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