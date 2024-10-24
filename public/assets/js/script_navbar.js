// Selecciona todos los enlaces que tienen la clase 'enlace-navegacion'
const links = document.querySelectorAll('.enlace-navegacion');

// Itera sobre cada enlace para agregar un evento de clic
links.forEach(link => {
    link.addEventListener('click', () => {
        // Elimina la clase 'active' de todos los enlaces para asegurarse de que solo un enlace esté activo
        links.forEach(l => l.classList.remove('active'));
        
        // Añade la clase 'active' al enlace que fue clicado, indicando que es el enlace seleccionado
        link.classList.add('active');
    });
});
