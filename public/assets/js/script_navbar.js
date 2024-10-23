// Suponiendo que tus enlaces tienen la clase 'enlace-navegacion'
const links = document.querySelectorAll('.enlace-navegacion');

links.forEach(link => {
    link.addEventListener('click', () => {
        // Eliminar la clase 'active' de todos los enlaces
        links.forEach(l => l.classList.remove('active'));
        // Añadir la clase 'active' al enlace que fue clicado
        link.classList.add('active');
    });
});
