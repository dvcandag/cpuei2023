<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}
$username = $_SESSION['username'];
$alumno = $_SESSION['alumno']; // Obtener datos del alumno desde la sesión
?>

<?php
// Obtener la fecha actual en el formato deseado
$fechaActual = date('j \d\e F \d\e Y');
?>

 <!-- Incluye Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- Incluye estilos propios -->
<link rel="stylesheet" href="../public/assets/css/dashboard.css">


<body>
    <?php include '../views/template/header.php'; ?>
    <?php include '../views/template/navbar.php'; ?>

    

<!-- Contenido principal del dashboard -->
<div class="container-home">
    <div class="home slider">
        <div class="slides">
            <div class="slide">
                    <img src="../public/assets/images/galeria/portada.jpg">

            </div>
            <div class="slide">
                <img src="../public/assets/images/galeria/foto-1.jpg">
            </div>
            <div class="slide">
                <img src="../public/assets/images/galeria/portada2.avif">
            </div>
            <div class="slide">
                <img src="../public/assets/images/galeria/foto-2.jpg">
            </div>
            <!-- Agregar más slides según sea necesario -->
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
</div>



<div class="container-fecha">
    <div class="fecha-info">
        <span class="fecha-hoy">Hoy, <?php echo $fechaActual; ?></span>

        <a href="#" class="btn-fecha-matricula">Fecha de matrícula</a>
        <span class="mi-horario">
            Horarios de Ciclo Agosto 2024
            <a href="#" class="btn-ver-horario">Ver mi horario</a>
        </span>
    </div>
</div>








<!-- /* Contenedor de Horarios de matrícula y Información institucional */
 -->
<div class="acceso-container">
    <!-- Horarios de matrícula -->
    <div class="acceso-directo-tramites-info">
        <button class="acceso-btn-container">
            <i class="fa-solid fa-calendar-check icon-left"></i>
            <div class="text-container">
                <p>Realiza tus trámites</p>
            </div>
        </button>
    </div>

    <!-- Información institucional -->
    <div class="acceso-directo-tramites-info">
        <button class="acceso-btn-container">
            <i class="fa-solid fa-info-circle icon-left"></i>
            <div class="text-container">
                <p>Información institucional</p>
            </div>
        </button>
    </div>
</div>







<!-- Contenedor de "Te podría interesar" -->
<div class="container-otros-accesos">
    <div class="otros-accesos">
        <h1>Te podría interesar:</h1>
        <div class="row">
            <div class="col-md-3 mb-4">
                <button class="accesos-interes" data-testid="cmp-btn-beneficios" formtarget="_blank">
                    <i class="fas fa-gift fa-2x"></i> <!-- Icono de Beneficios -->
                    <div class="infos-acceso">
                        <h1>Beneficios</h1>
                        <p>Disfruta de promociones, descuentos y más en UTP</p>
                    </div>
                    <i class="fas fa-external-link-alt fa-lg external-link"></i> <!-- Icono de Enlace Externo -->
                </button>
            </div>
            <div class="col-md-3 mb-4">
                <button class="accesos-interes" data-testid="cmp-btn-biblioteca" formtarget="_blank">
                    <i class="fas fa-book fa-2x"></i> <!-- Icono de Biblioteca -->
                    <div class="infos-acceso">
                        <h1>Ingreso a la Biblioteca</h1>
                        <p>Encuentra recursos, libros y más.</p>
                    </div>
                    <i class="fas fa-external-link-alt fa-lg external-link"></i> <!-- Icono de Enlace Externo -->
                </button>
            </div>
            <div class="col-md-3 mb-4">
                <button class="accesos-interes" data-testid="cmp-btn-bolsa-trabajo" formtarget="_blank">
                    <i class="fas fa-briefcase fa-2x"></i> <!-- Icono de Bolsa de Trabajo -->
                    <div class="infos-acceso">
                        <h1>Bolsa de Trabajo</h1>
                        <p>Encuentra ofertas laborales exclusivas para ti</p>
                    </div>
                    <i class="fas fa-external-link-alt fa-lg external-link"></i> <!-- Icono de Enlace Externo -->
                </button>
            </div>
            <div class="col-md-3 mb-4">
                <button class="accesos-interes" data-testid="cmp-btn-empleabilidad" formtarget="_blank">
                    <i class="fas fa-chart-line fa-2x"></i> <!-- Icono de Empleabilidad -->
                    <div class="infos-acceso">
                        <h1>Empleabilidad</h1>
                        <p>Conoce más sobre tu ruta laboral con UTP</p>
                    </div>
                    <i class="fas fa-external-link-alt fa-lg external-link"></i> <!-- Icono de Enlace Externo -->
                </button>
            </div>
        </div>
    </div>
</div>


<footer class="container-footer">
    <div class="footer">
       
        <p>&copy; 2024 CURSO-MVC - Todos los derechos reservados.</p>
    </div>
</footer>








    <script src="../public/assets/js/slider-dashboard.js"></script> <!-- Incluye tu archivo JavaScript aquí -->



</body>
</html>
