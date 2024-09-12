function AlternarContenido
(element) {
    const header = element;
    const content = header.nextElementSibling;
    const button = header.querySelector('.toggle-button i');
    
    header.classList.toggle('open');
    if (header.classList.contains('open')) {
        content.style.display = 'block';
    } else {
        content.style.display = 'none';
    }
}
