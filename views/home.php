<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard y Cursos</title>

    <!-- Incluye los estilos CSS -->
    <link rel="stylesheet" type="text/css" href="../public/assets/css/styles_home.css">
    <link rel="stylesheet" type="text/css" href="../public/assets/css/styles_global.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <!-- Contenido principal del dashboard -->
    <div class="container-home">
        <div class="home slider">
            <div class="slides">
                <div class="slide">
                    <img src="../public/assets/images/galeria/portada.jpg" alt="Portada">
                </div>
                <div class="slide">
                    <img src="../public/assets/images/galeria/foto-1.jpg" alt="Foto 1">
                </div>
                <div class="slide">
                    <img src="../public/assets/images/galeria/portada2.avif" alt="Portada 2">
                </div>
                <div class="slide">
                    <img src="../public/assets/images/galeria/foto-2.jpg" alt="Foto 2">
                </div>
            </div>
            <div id="pagination" class="indicadores">
                <button class="indicador active" data-slide="0"></button>
                <button class="indicador" data-slide="1"></button>
                <button class="indicador" data-slide="2"></button>
                <button class="indicador" data-slide="3"></button>
            </div>
        </div>

        <div class="nombre-modalidad">
            La modalidad en que estás inscrito es:
        </div>

        <!-- Sección de fecha y horario -->
        <div class="container-fecha">
            <div class="fecha-info">
                <span class="fecha-hoy">Hoy, <?php echo $fechaActual; ?></span>
                <a href="#" class="btn-fecha-matricula">Fecha de matrícula</a>
                <span class="mi-horario">
                    Horarios de Ciclo Agosto 2024
                    
                    <a href="#" class="btn-ver-horario enlace-ver-horario" data-view="HorarioAlumnoView">Ver mi horario</a>
                </span>
            </div>
        </div>
    </div>

   

    <!-- Incluye los scripts -->
    <script src="../public/assets/js/slider-dashboard.js"></script>
    <script src="../public/assets/js/script_AlternarContenido.js"></script>
        <script src="../public/assets/js/script_home.js"></script>

</body>
</html>
