// Abrir el lightbox al hacer clic en el icono de búsqueda
document.getElementById('searchIcon').addEventListener('click', function(event) {
    event.stopPropagation(); // Evita que otros elementos capturen el evento de clic
    // Abrir el lightbox y mostrar el ícono de cerrar
    const lightbox = document.getElementById('searchLightbox');
    if (lightbox) {
        lightbox.classList.add('active');
        document.querySelector('.search-box input').value = ''; // Limpia el input al abrir el lightbox
    }
});

// Cerrar el lightbox al hacer clic en el icono de cerrar
document.getElementById('closeLightbox').addEventListener('click', function(event) {
    event.stopPropagation(); // Evita que otros elementos capturen el evento de clic
    // Cerrar el lightbox y ocultar el ícono de cerrar
    const lightbox = document.getElementById('searchLightbox');
    if (lightbox) {
        lightbox.classList.remove('active');
    }
});
