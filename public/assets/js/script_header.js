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
