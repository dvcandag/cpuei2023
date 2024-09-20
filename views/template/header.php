<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header Elegante</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <!-- CSS Personalizado -->
    <link rel="stylesheet" type="text/css" href="../public/assets/css/styles_header.css">
</head>
<body>

    <!-- Header -->
    <header class="p-3 header-container">
        <div class="container-fluid">
            <div class="d-flex align-items-center justify-content-between">
                
                <!-- Logo -->
                <div class="logo">
                    <img src="../public/assets/images/logo/logo5.png" alt="Logo">
                </div>

                <!-- Buscador para pantallas mediana y grande -->
                <form class="d-none d-md-flex w-50 mx-auto formulario-busqueda">
                    <input class="input-busqueda pe-5" type="search" placeholder="Busque aquí..." aria-label="Search">
                    <button class="btn" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </form>

                <!-- Grupo de íconos -->
                <div class="d-flex align-items-center">

                    <!-- Icono de búsqueda para pantallas pequeñas -->
                    <div class="contenedor-icono d-block d-md-none me-2">
                        <i class="fas fa-search" id="searchIcon"></i>
                    </div>

                    <!-- Links e iconos -->
                    <a href="#" class="me-2">
                        <div class="contenedor-icono">
                            <i class="fas fa-home"></i> <!-- Icono de Home -->
                        </div>
                    </a>
                    <a href="#" class="me-2 position-relative">
                        <div class="contenedor-icono">
                            <i class="fas fa-id-card"></i> <!-- Icono de Tarjeta de Identificación -->
                        </div>
                    </a>
                    <a href="#" class="me-2 position-relative">
                        <div class="contenedor-icono">
                            <i class="fas fa-envelope"></i> <!-- Icono de Enviar Correo -->
                        </div>
                    </a>
                    <a href="#" class="me-2 position-relative">
                        <div class="contenedor-icono">
                            <i class="fas fa-bell"></i> <!-- Icono de Notificaciones -->
                        </div>
                    </a>
                </div>

                <!-- Grupo para foto o perfil -->
                <div class="profile-info">
                    <div class="foto-perfil" id="profile-photo">
                        <img src="../public/assets/images/alumnos/foto-1.jpg">
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Lightbox despliegue del buscador en pantallas pequeñas -->
    <div class="despliegue-search-lateral" id="searchLightbox">
        <div class="search-box">
            <input type="search" placeholder="Buscar...">
            <i class="fas fa-times close-lightbox" id="closeLightbox"></i>
        </div>
    </div>

    <!-- Formulario de perfil -->
    <div class="formulario-perfil" id="formulario-perfil">
        <div class="perfil-info">
            <input type="checkbox" id="toggleProfile1" class="toggle-checkbox">
            <label for="toggleProfile1" class="toggle-button">
                <i class="fas fa-user"></i> <!-- Icono antes del texto -->
                <h1>Bienvenido, <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
                <i class="fas fa-chevron-down"></i>
            </label>
            <ul class="info-personal">
                <li><strong>Código:</strong> 123456</li>
                <li><strong>DNI:</strong> 123456</li>
                <li><strong>Fecha de Nacimiento:</strong> 123456</li>
                <li><strong>Correo:</strong> 123456</li>
                <li><strong>Escuela:</strong> Ingeniería de Sistemas</li>
                <li><strong>Ciclo:</strong> A-101</li>
            </ul>
        </div>

        <div class="perfil-info">
            <input type="checkbox" id="toggleProfile2" class="toggle-checkbox">
            <label for="toggleProfile2" class="toggle-button">
                <i class="fas fa-cog"></i> <!-- Icono antes del texto -->
                Configuración y privacidad
                <i class="fas fa-chevron-down"></i>
            </label>
            <ul class="info-personal">
                <li>Datos personales</a></li>
                <li>Contraseña y seguridad</a></li>
                <li>Registro de actividad</a></li>
                <li>Idioma</a></li>
            </ul>
        </div>

        <div class="perfil-info">
            <input type="checkbox" id="toggleProfile4" class="toggle-checkbox">
            <label for="toggleProfile4" class="toggle-button">
                <i class="fas fa-desktop"></i> <!-- Icono alternativo para pantalla -->
                Pantalla y accesibilidad
                <i class="fas fa-chevron-down"></i>
            </label>
            <ul class="info-personal">
                <li class="mode-option mode-dark">
                    <label class="switch">
                        <input type="checkbox" id="darkModeSwitch" class="mode-switch">
                        <span class="slider"></span>
                        <span class="mode-label">Modo oscuro</span>
                    </label>
                </li>
                <li class="mode-option mode-light">
                    <label class="switch">
                        <input type="checkbox" id="lightModeSwitch" class="mode-switch">
                        <span class="slider"></span>
                        <span class="mode-label">Modo normal</span>
                    </label>
                </li>
            </ul>
        </div>

        <div class="perfil-info">
            <input type="checkbox" id="toggleProfile3" class="toggle-checkbox">
            <label for="toggleProfile3" class="toggle-button">
                <i class="fas fa-question-circle"></i> <!-- Icono antes del texto -->
                Ayuda y soporte técnico
                <i class="fas fa-chevron-down"></i>
            </label>
            <ul class="info-personal">
                <li>Servicio de ayuda</li>
                <li>Buzón de ayuda</li>
                <li>Reportar un problema</li>
            </ul>
        </div>

        <!-- Formulario de Cierre de Sesión -->
        <div class="logout-button" id="logoutButton">
            <i class="fas fa-sign-out-alt"></i> Cerrar sesión
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- JS Personalizado -->
    <script src="../public/assets/js/script_header.js"></script>
    <script src="../public/assets/js/script_Buscador_header.js"></script>
</body>
</html>
