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
    <i class="fas fa-search search-icon contenedor-icono" id="searchIcon"></i>
</div>


    <!-- Links e iconos -->
    <a href="#" class="nav-link me-2">
        <div class="contenedor-icono">
            <i class="fas fa-home"></i> <!-- Icono de Home -->
        </div>
    </a>
    <a href="#" class="nav-link me-2 position-relative">
        <div class="contenedor-icono">
            <i class="fas fa-id-card"></i> <!-- Icono de Tarjeta de Identificación -->
        </div>
    </a>
    <a href="#" class="nav-link me-2 position-relative">
        <div class="contenedor-icono">
            <i class="fas fa-envelope"></i> <!-- Icono de Enviar Correo -->
        </div>
    </a>
    <a href="#" class="nav-link me-2 position-relative">
        <div class="contenedor-icono">
            <i class="fas fa-bell"></i> <!-- Icono de Notificaciones -->
        </div>
    </a>

</div>


<!-- Grupo de para foto o perfil -->
<div class="profile-info">
    <div class="foto-perfil" id="profile-photo">
        <img src="../public/assets/images/alumnos/foto-1.jpg">
    </div>
</div>


</div>
 </header>

    <!-- Lightbox desplique del buscador en pantallas pequeñas -->
    <div class="search-lightbox" id="searchLightbox">
        <div class="search-box">
            <input type="search" placeholder="Buscar..." aria-label="Search">
            <i class="fas fa-times close-lightbox" id="closeLightbox"></i>
        </div>
    </div>








    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- JS Personalizado -->
    <script src="../public/assets/js/script_Buscador_header.js"></script>
</body>
</html>
