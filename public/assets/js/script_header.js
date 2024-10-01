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

// Para capitalizar palabras que estan en DB en mayusculas (NOMBRE ALUMNO)
document.addEventListener("DOMContentLoaded", function() {
    function capitalizeWords(text) {
        return text.split(' ').map(word => {
            return word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
        }).join(' ');
    }

    // Selecciona solo los labels con la clase texto-capitalizado
    const textElements = document.querySelectorAll("label.texto-capitalizado");

    textElements.forEach(function(element) {
        // Aplica la capitalización al texto del label
        element.childNodes.forEach(node => {
            if (node.nodeType === Node.TEXT_NODE) {
                node.textContent = capitalizeWords(node.textContent.trim());
            }
        });
    });
});


// Para capitalizar palabras que estan en DB en mayusculas (ESCUELA)
document.addEventListener("DOMContentLoaded", function() {
    function capitalizeWords(text) {
        return text.split(' ').map(word => {
            return word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
        }).join(' ');
    }

    // Selecciona solo los <li> con la clase texto-capitalizado
    const textElements = document.querySelectorAll("li.texto-capitalizado");

    textElements.forEach(function(element) {
        // Aplica la capitalización al texto del <li>
        element.childNodes.forEach(node => {
            if (node.nodeType === Node.TEXT_NODE) {
                // Solo capitaliza el texto que sigue al "Escuela: "
                const label = node.textContent.trim();
                // Si el texto contiene "Escuela:", separa y capitaliza solo la parte que sigue
                const parts = label.split(': ');
                if (parts.length > 1) {
                    parts[1] = capitalizeWords(parts[1]);
                }
                node.textContent = parts.join(': ');
            }
        });
    });
});
