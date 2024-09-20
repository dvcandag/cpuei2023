document.addEventListener("DOMContentLoaded", function() {
    var fotoPerfil = document.getElementById("profile-photo");
    var formularioPerfil = document.getElementById("formulario-perfil");

    // Mostrar/ocultar el formulario al hacer clic en la foto del perfil
    fotoPerfil.addEventListener("click", function(event) {
        event.stopPropagation(); // Evita que el clic se propague al contenedor padre
        if (formularioPerfil.style.display === "block") {
            formularioPerfil.style.display = "none";
        } else {
            formularioPerfil.style.display = "block";
        }
    });

    // Evitar que el clic en el formulario cierre el formulario
    formularioPerfil.addEventListener("click", function(event) {
        event.stopPropagation();
    });

    // Ocultar el formulario al hacer clic fuera de él
    document.addEventListener("click", function() {
        if (formularioPerfil.style.display === "block") {
            formularioPerfil.style.display = "none";
        }
    });
});

document.addEventListener("DOMContentLoaded", function() {
    var logoutButton = document.getElementById("logoutButton");
    
    // Añadir evento de clic al botón de cerrar sesión
    logoutButton.addEventListener("click", logout);
});

// alert de aviso de cierre de sesión
function logout() {
    if (confirm('¿Estás seguro de que deseas cerrar sesión?')) {
        // Crear formulario dinámicamente
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = 'logout.php'; // Asegúrate de que esta sea la URL correcta
        document.body.appendChild(form);
        form.submit();
    }
}
