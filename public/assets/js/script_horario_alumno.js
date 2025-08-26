document.getElementById('periodo').addEventListener('change', function() {
    const periodo = this.value;
    const url = new URL(window.location.href);
    
    // Actualizar parámetros de la URL
    url.searchParams.set('action', 'mostrarHorario');
    if (periodo) {
        url.searchParams.set('periodo', periodo);
    } else {
        url.searchParams.delete('periodo');
    }
    
    // Recargar la página con los nuevos parámetros
    window.location.href = url.toString();
});