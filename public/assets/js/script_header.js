document.addEventListener("DOMContentLoaded", function() {
    var fotoPerfil = document.getElementById("profile-photo");
    var formularioPerfil = document.getElementById("formulario-perfil");

    fotoPerfil.addEventListener("click", function(event) {
        event.stopPropagation(); // Evita que el clic se propague al contenedor padre
        if (formularioPerfil.style.display === "block") {
            formularioPerfil.style.display = "none";
        } else {
            formularioPerfil.style.display = "block";
        }
    });

    formularioPerfil.addEventListener("click", function(event) {
        event.stopPropagation(); // Evita que el clic se propague al contenedor padre
    });

    document.addEventListener("click", function() {
        formularioPerfil.style.display = "none";
    });
});

