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

                <!-- Buscador Moderno con Icono -->
                <form class="d-none d-md-flex w-50 mx-auto formulario-busqueda">
                    <input class="form-control rounded-pill pe-5" type="search" placeholder="Buscar..." aria-label="Search">
                    <button class="btn" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </form>

                <!-- Links e iconos -->
                <div class="d-flex align-items-center">
                    <a href="#" class="nav-link">
                        <i class="fas fa-home"></i> <!-- Icono de Home -->
                    </a>
                    <a href="#" class="nav-link position-relative">
                        <i class="fas fa-envelope"></i>
                    </a>
                    <a href="#" class="nav-link position-relative">
                        <i class="fas fa-comments"></i>
                    </a>
                    <a href="#" class="nav-link position-relative">
                        <i class="fas fa-bell"></i>
                    </a>

                    <!-- Icono de búsqueda para pantallas pequeñas -->
                    <i class="fas fa-search search-icon d-md-none" id="searchIcon"></i>

                    <div class="profile-info">
                        <div class="foto-perfil" id="profile-photo">
                            <img src="../public/assets/images/alumnos/foto-1.jpg">
                        </div>
                    </div>
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
