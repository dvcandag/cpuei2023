function cargarContenido(url, event) {
    event.preventDefault(); // Evita que el enlace haga una navegación tradicional

    // Usa jQuery para cargar el contenido
    $('#contenido-cursos').load(url, function(response, status, xhr) {
        if (status == "error") {
            console.error("No se pudo cargar el contenido: " + xhr.status + " " + xhr.statusText);
        }
    });
}
