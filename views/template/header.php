
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Enlace al archivo CSS de Bootstrap -->
    <link rel="stylesheet" type="text/css" href="../public/assets/css/bootstrap.css">
    <!-- Enlace al archivo CSS de Styles -->
    <link rel="stylesheet" type="text/css" href="../public/assets/css/styles_header.css">
    <link rel="stylesheet" type="text/css" href="../public/assets/css/font.css">
</head>
<body>
    <header>
        <div class="header-container">
            <div class="logo">
                <img src="../public/assets/images/logo/logo5.png" alt="Logo">
            </div>
            <nav class="contenedor-icono">
                <ul>
                    <li><a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
                        <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z"/>
                        <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293z"/>
                    </svg></a></li>
                    <li><a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-vcard-fill" viewBox="0 0 16 16">
                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm9 1.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1h-4a.5.5 0 0 0-.5.5M9 8a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1h-4A.5.5 0 0 0 9 8m1 2.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 0-1h-3a.5.5 0 0 0-.5.5m-1 2C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1 1 0 0 0 2 13h6.96q.04-.245.04-.5M7 6a2 2 0 1 0-4 0 2 2 0 0 0 4 0"/>
                    </svg></a></li>
                    <li><a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                        <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414zM0 4.697v7.104l5.803-3.558zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586zm3.436-.586L16 11.801V4.697z"/>
                    </svg></a></li>
                    <li><a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell-fill" viewBox="0 0 16 16">
                        <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2m.995-14.901a1 1 0 1 0-1.99 0A5 5 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901"/>
                    </svg></a></li>
                </ul>
            </nav>
            <div class="profile-info" id="profile-info">
                <div class="usuario"><?php echo $username; ?></div>
                <div class="foto foto-perfil" id="profile-photo">
                    <img src="../public/assets/images/alumnos/foto-1.jpg">
                </div>
            </div>
        </div>
    </header>
    
    <div class="formulario-perfil" id="formulario-perfil">
        <ul>
            <li><strong>Código:</strong> <?php echo $alumno['codalumno']; ?></li>
            <li><strong>Nombre:</strong> <?php echo $alumno['nombrealumno']; ?></li>
            <li><strong>Apellido Paterno:</strong> <?php echo $alumno['apaterno']; ?></li>
            <li><strong>Apellido Materno:</strong> <?php echo $alumno['amaterno']; ?></li>
            <li><strong>Escuela:</strong> <?php echo $alumno['escuela']; ?></li>
            <li><strong>Aula:</strong> <?php echo $alumno['aula']; ?></li>
            <li><br><a href="logout.php">Cerrar sesión</a></li>
        </ul>
    </div>
    
    <script src="../public/assets/js/script_header.js"></script>
    
</body>
</html>









