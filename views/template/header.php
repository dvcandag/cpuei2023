<?php

// valor almacenado en la sesión
$alumno = $_SESSION['alumno'];

// Función para obtener la ruta de la foto del alumno desde la carpeta local
function obtenerRutaFoto($dni) {
    return '../database/foto-alumno/' . $dni . '.png';
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    
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
                    <!-- Icono de búsqueda para pantallas pequeñas usando Bootstrap -->
                    <div class="contenedor-icono me-2 d-block d-sm-none d-flex justify-content-center align-items-center">
                        <i class="fas fa-search" id="searchIcon"></i>
                    </div>

                    <!-- Links e iconos -->
                    <a href="#" class="me-2">
                        <div class="contenedor-icono">
                            <i class="fas fa-home"></i> <!-- Icono de Home -->
                        </div>
                    </a>
                    <a href="carnet-alumno.php" class="me-2 position-relative" target="_blank">
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

                <!-- Grupo para foto de perfil -->
                <div class="profile-info">
                    <?php
                    $foto = '../public/assets/images/placeholder/placeholder.png'; // Foto por defecto

                    // Verificar si tiene DNI
                    if (isset($alumno['dni'])) {
                        $ruta_foto = obtenerRutaFoto($alumno['dni']);

                        // Verificar si la foto existe
                        if (file_exists($ruta_foto)) {
                            $foto = htmlspecialchars($ruta_foto); // Asignar la ruta de la foto si existe
                        }
                    }
                    ?>
                    <div class="foto-perfil" id="profile-photo">
                        <img src="<?= $foto ?>" alt="Foto de perfil">
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
            <label for="toggleProfile1" class="toggle-button texto-capitalizado">
                <i class="fas fa-user"></i>
                <?php echo htmlspecialchars($_SESSION['nombre_completo'] ?? 'Usuario'); ?>
                <i class="fas fa-chevron-down"></i>
            </label>
            <ul class="info-personal">
                <li>Código: <?= htmlspecialchars($alumno['codalumno'] ?? 'N/A'); ?></li>
                <li>DNI: <?= htmlspecialchars($alumno['dni'] ?? 'N/A'); ?></li>
                <li>Fecha de Nacimiento: <?= htmlspecialchars($alumno['fecha_nacimiento'] ?? 'N/A'); ?></li>
                <li>Correo: <?= htmlspecialchars($alumno['correo'] ?? 'N/A'); ?></li>
<li class="texto-capitalizado">Escuela: <?= htmlspecialchars($alumno['escuela_nombre'] ?? 'N/A'); ?></li>

                <li>Ciclo: <?= htmlspecialchars($alumno['aula'] ?? 'N/A'); ?></li>
            </ul>
        </div>

        <div class="perfil-info">
            <input type="checkbox" id="toggleProfile2" class="toggle-checkbox">
            <label for="toggleProfile2" class="toggle-button">
                <i class="fas fa-cog"></i> <!-- Icono de Configuración -->
                Configuración y privacidad
                <i class="fas fa-chevron-down"></i>
            </label>
            <ul class="info-personal">
                <li>Datos personales</li>
                <li>
                    <a href="nuevo_password.php">Contraseña y seguridad</a>
                </li>
                <li>Registro de actividad</li>
                <li>Idioma</li>
            </ul>
        </div>

        <div class="perfil-info">
            <input type="checkbox" id="toggleProfile4" class="toggle-checkbox">
            <label for="toggleProfile4" class="toggle-button">
                <i class="fas fa-desktop"></i> <!-- Icono de Pantalla -->
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
                <i class="fas fa-question-circle"></i> <!-- Icono de Ayuda -->
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
