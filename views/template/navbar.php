

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Título de tu página</title> <!-- Agrega un título para tu página aquí -->
   
    <!-- Enlace al archivo CSS de Bootstrap -->
    <link rel="stylesheet" type="text/css" href="../public/assets/css/bootstrap.css">
    <!-- Enlace al archivo CSS de Styles -->
    <link rel="stylesheet" type="text/css" href="../public/assets/css/styles_navbar.css">
    <link rel="stylesheet" type="text/css" href="../public/assets/css/font.css">
</head>
<body>
<div class="container-fluid">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 navbar-container">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li class="nav-item">
                        <a href="#" class="align-middle px-0">
                            <span class="ms-1 d-none d-sm-inline">Horario</span>
                        </a>
                    </li>
                    <li class="dropdown">

                        <a href="#" class="align-middle px-0" id="dropdownCursos" data-bs-toggle="dropdown" aria-expanded="false" aria-controls="submenu1">
                            <span class="ms-1 d-none d-sm-inline">Cursos</span>
                        </a>
                         <ul class="dropdown-menu" aria-labelledby="dropdownCursos" data-bs-trigger="hover" aria-expanded="false" id="submenu1">

                             <?php
// Verificar si existen cursos matriculados en la sesión
if (isset($_SESSION['cursosMatriculados']) && is_array($_SESSION['cursosMatriculados'])) {
    foreach ($_SESSION['cursosMatriculados'] as $curso) {
        echo "<li><a class='nav-link' href='#'>" . $curso['nombrecurso'] . "</a></li>";
    }
} else {
    echo "<li><a class='nav-link' href='#'>Aún no te has matriculado en ningún curso</a></li>";
}
?>

                         </ul>
                    </li>

                    <li>
                        <a href="#" class="align-middle px-0">
                            <span class="ms-1 d-none d-sm-inline">Pagos</span></a>
                    </li>
                      <li>
                        <a href="#" class="align-middle px-0">
                            <span class="ms-1 d-none d-sm-inline">Refuerzo Académico</span></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="align-middle px-0" id="dropdownTramites" data-bs-toggle="dropdown" aria-expanded="false" aria-controls="submenu2">
                            <span class="ms-1 d-none d-sm-inline">Trámites</span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownTramites" data-bs-trigger="hover" aria-expanded="false" id="submenu2">
                            <li><a class="dropdown-item" href="#">Retiro del curso</a></li>
                            <li><a class="dropdown-item" href="#">Rectificación de notas</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="align-middle px-0" id="dropdownServicios" data-bs-toggle="dropdown" aria-expanded="false" aria-controls="submenu3">
                            <span class="ms-1 d-none d-sm-inline">Servicios</span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownServicios" data-bs-trigger="hover" aria-expanded="false" id="submenu3">
                            <li><a class="dropdown-item" href="#">Empleabilidad</a></li>
                            <li><a class="dropdown-item" href="#">Bienestar</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="#" class="align-middle px-0">
                            <span class="ms-1 d-none d-sm-inline">Eventos</span> </a>
                    </li>
                    <li>
                        <a href="#" class="align-middle px-0">
                            <span class="ms-1 d-none d-sm-inline">Citas y asesorías</span> </a>
                    </li>
                     <li>
                        <a href="#" class="align-middle px-0">
                            <span class="ms-1 d-none d-sm-inline">Reserva de recursos</span> </a>
                    </li>
                     <li>
                        <a href="#" class="align-middle px-0">
                            <span class="ms-1 d-none d-sm-inline">¿Necesitas ayuda?</span> </a>
                    </li>
                </ul>
                <hr>
                
            </div>
        </div>
     
    </div>
</div>
</body>
</html>
