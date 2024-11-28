document.addEventListener("DOMContentLoaded", function() {
    const footer = document.querySelector('.footer');
    const headerHeight = 80; // Altura del header en píxeles

    // Mostrar el footer al pasar el mouse sobre el área del footer
    footer.addEventListener('mouseenter', function() { 
        // Solo mostrar el footer si no ha sido ocultado por el scroll
        if (window.scrollY < headerHeight) {
            footer.classList.add('visible'); // Mostrar el footer
        }
    });

    // Ocultar el footer cuando el mouse sale del área del footer
    footer.addEventListener('mouseleave', function() {
        footer.classList.remove('visible'); // Ocultar el footer
    });

    // Función para verificar si la página tiene suficiente contenido para scroll
    function checkScroll() {
        const windowHeight = window.innerHeight;
        const documentHeight = document.documentElement.scrollHeight;

        if (documentHeight > windowHeight) {
            footer.classList.add('visible'); // Mostrar el footer si hay scroll
        } else {
            footer.classList.remove('visible'); // Ocultar si no hay suficiente contenido
        }
    }

    // Ejecutar la función cuando se cargue la página y cuando se redimensione la ventana
    window.addEventListener('load', checkScroll);
    window.addEventListener('resize', checkScroll);

    // Función para manejar el scroll
    window.addEventListener('scroll', () => {
        // Verificar si el scroll es mayor o igual a la altura del header
        if (window.scrollY >= headerHeight) {
            footer.classList.remove('visible'); // Ocultar el footer si se ha alcanzado la altura del header
        } else {
            // Solo mostrar el footer si el scroll es menor que headerHeight y el mouse está sobre el footer
            if (footer.classList.contains('visible')) {
                footer.classList.add('visible'); // Mostrar el footer si está visible y no se ha alcanzado el scroll
            }
        }
    });
});
