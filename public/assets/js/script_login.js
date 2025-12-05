function AlternarContraseña() { 
    const passwordInput = document.getElementById('password');
    const icon = document.querySelector('.icon-vista-contraseña i');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

// Botón de inicio de sesión
const loginButton = document.getElementById('loginButton');

loginButton.addEventListener('click', (e) => {
    e.preventDefault(); // Evita que el formulario se envíe antes de obtener la ubicación
    
    const codalumno = document.getElementById('codalumno').value.trim();
    const password = document.getElementById('password').value.trim();

    if (!codalumno || !password) {
        alert("Por favor, complete usuario y contraseña.");
        return;
    }

    // Verificar si el navegador soporta geolocalización
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            (position) => {
                //Usuario aceptó ubicación
                const latitud = position.coords.latitude;
                const longitud = position.coords.longitude;
                sendLoginData(codalumno, password, latitud, longitud);
            },
            (error) => {
                //Usuario denegó o hubo error
                if (error.code === error.PERMISSION_DENIED) {
                    alert("Debes activar el GPS y permitir la ubicación para iniciar sesión.");
                } else {
                    alert("Error al obtener la ubicación. Activa el GPS e inténtalo nuevamente.");
                }
            },
            { enableHighAccuracy: true, timeout: 10000, maximumAge: 0 } // Config extra
        );
    } else {
        alert("Tu navegador no soporta geolocalización.");
    }
});

// Función para enviar datos al servidor
function sendLoginData(codalumno, password, latitud, longitud) {
    const formData = new FormData();
    formData.append('codalumno', codalumno);
    formData.append('password', password);
    formData.append('latitud', latitud);
    formData.append('longitud', longitud);

    fetch('index.php?action=login', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            window.location.href = "views/dashboard.php";
        } else {
            alert(data.message);
        }
    })
    .catch(error => console.error('Error en la solicitud:', error));
}
