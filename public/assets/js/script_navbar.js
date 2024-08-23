document.addEventListener('DOMContentLoaded', function () {
    // Selecciona todos los elementos de menú desplegable
    const dropdowns = document.querySelectorAll('.dropdown');

    dropdowns.forEach(dropdown => {
        const dropdownToggle = dropdown.querySelector('a');

        dropdownToggle.addEventListener('click', function (event) {
            // Evita que el clic en el botón cierre el menú inmediatamente
            event.stopPropagation();

            // Cierra todos los menús abiertos
            dropdowns.forEach(d => {
                if (d !== dropdown) {
                    d.classList.remove('show');
                }
            });

            // Alterna la clase .show en el contenedor .dropdown
            dropdown.classList.toggle('show');
        });
    });

    // Cerrar el menú si se hace clic fuera de él
    document.addEventListener('click', function (event) {
        dropdowns.forEach(dropdown => {
            if (dropdown.classList.contains('show') && !dropdown.contains(event.target)) {
                dropdown.classList.remove('show');
            }
        });
    });
});


