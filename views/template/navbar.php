<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>navbar</title> <!-- Título de la página -->

    <!-- Incluye Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Enlace al archivo CSS de Bootstrap v5.2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- Enlace a los archivos CSS de Styles -->
    <link rel="stylesheet" href="../public/assets/css/styles_global.css">
    <link rel="stylesheet" href="../public/assets/css/styles_navbar.css">
</head>
<body>
    <!-- Contenidos del menu de navegación -->
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-0 navbar-container">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                        
<li class="elemento-navegacion">
    <a href="#" id="horario-link" class="enlace-navegacion" data-view="HorarioAlumnoView">
        <i class="fa-solid fa-clock"></i>
        <span class="ms-1 d-none d-sm-inline">Horario</span>
    </a>
</li>


                        <li class="elemento-navegacion">
                            <a href="#" class="enlace-navegacion js-periodos-finalizados" data-view="PeriodosFinalizadosView">
                                <i class="fa-solid fa-book"></i>
                                <span class="ms-1 d-none d-sm-inline">Cursos</span>
                            </a>
                        </li>
                        <li class="elemento-navegacion">
                            <a href="#" class="enlace-navegacion" data-view="PagosView">
                                <i class="fa-solid fa-credit-card"></i>
                                <span class="ms-1 d-none d-sm-inline">Pagos</span>
                            </a>
                        </li>
                        <li class="elemento-navegacion">
                            <a href="#" class="enlace-navegacion" data-view="RefuerzoAcademicoView">
                                <i class="fa-solid fa-graduation-cap"></i>
                                <span class="ms-1 d-none d-sm-inline">Refuerzo Académico</span>
                            </a>
                        </li>
                        <li class="elemento-navegacion">
                            <a href="#" class="enlace-navegacion" data-view="TramitesView">
                                <i class="fa-solid fa-file-alt"></i>
                                <span class="ms-1 d-none d-sm-inline">Trámites</span>
                            </a>
                        </li>
                        <li class="elemento-navegacion">
                            <a href="#" class="enlace-navegacion" data-view="EventosView">
                                <i class="fa-solid fa-calendar-alt"></i>
                                <span class="ms-1 d-none d-sm-inline">Eventos</span>
                            </a>
                        </li>
                        <li class="elemento-navegacion">
                            <a href="#" class="enlace-navegacion" data-view="CitasAsesoriaView">
                                <i class="fa-solid fa-calendar-check"></i>
                                <span class="ms-1 d-none d-sm-inline">Citas y asesorías</span>
                            </a>
                        </li>
                        <li class="elemento-navegacion">
                            <a href="#" class="enlace-navegacion" data-view="ReservaRecursosView">
                                <i class="fa-solid fa-box-open"></i>
                                <span class="ms-1 d-none d-sm-inline">Reserva de recursos</span>
                            </a>
                        </li>
                        <li class="elemento-navegacion">
                            <a href="#" class="enlace-navegacion" data-view="AyudaView">
                                <i class="fa-solid fa-question-circle"></i>
                                <span class="ms-1 d-none d-sm-inline">¿Necesitas ayuda?</span>
                            </a>
                        </li>
                    </ul>
                    <hr>
                </div>
            </div>
        </div>
    </div>

    <!-- Incluye los archivos JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <script src="../public/assets/js/script_navbar.js"></script>
    <script src="../public/assets/js/script_navegacion.js"></script>
    <script src="../public/assets/js/script_home.js"></script>
            <script src="../public/assets/js/script_mostrar_periodos_finalizados.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>
