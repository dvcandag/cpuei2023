<?php

if (!isset($_SESSION['username'])) {
    header("Location: index.php?action=showLoginForm");
    exit;
}

$horario = $_SESSION['horario'] ?? [];
$progresoPeriodo = $_SESSION['progresoPeriodo'] ?? [];

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horario del Alumno</title>
    <link rel="stylesheet" type="text/css" href="../public/assets/css/styles_global.css">
    <link rel="stylesheet" href="../public/assets/css/styles_horario_alumno.css"> <!-- Suponiendo que has guardado los estilos proporcionados en este archivo -->
</head>
<body>
    
<div class="container-horario-alumno"> 
    <h1>Horario del Alumno</h1>
    <?php if (!empty($_SESSION['horario'])): ?>
        <div class="card-grid">
            <?php foreach ($_SESSION['horario'] as $dia => $clases): ?>
                <div class="card">
                    <div class="card-header">
                        <h2><?= htmlspecialchars($dia) ?></h2>
                        <?php if (!empty($clases)): ?>
                            <p class="card-subtitle"><strong>MODALIDAD:</strong> <?= htmlspecialchars($clases[0]['modalidad']) ?></p>
                        <?php endif; ?>
                    </div>
                    
<div class="card-content">
    <?php if (!empty($clases)): ?>
        <!-- Mostrar las clases -->
        <?php foreach ($clases as $clase): ?>
            <div class="course-item">
                <p class="course-name"><?= htmlspecialchars($clase['nombrecurso']) ?></p>
                <p class="course-time"><strong>Hora:</strong> <?= htmlspecialchars($clase['hora_inicio']) ?> - <?= htmlspecialchars($clase['hora_fin']) ?></p>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No hay clases, es momento de recargar energías.</p>
    <?php endif; ?>
</div>



                    
<!-- Este bloque se muestra solo una vez por día y semana durante la duracion de periodo -->
                    
<?php
if (isset($progresoPeriodo[$clase['codcurso']])): 
    $progreso = $progresoPeriodo[$clase['codcurso']];
    $porcentajeProgreso = $progreso['porcentaje'];
    $diasTranscurridos = $progreso['diasTranscurridos'];
    $diasTotales = $progreso['diasTotales'];
?>
    <!-- Este bloque se muestra solo una vez por día y semana durante la duración del período -->
   <div class="card-footer">
                                                <div class="progress-container">
                                                    <div class="progress-bar">
                                                        <div class="relleno-progress-bar" style="width: <?= $porcentajeProgreso ?>%;"></div>
                                                    </div>
                                                    <div class="progress-label"><?= round($porcentajeProgreso, 2) ?>%</div>
                                                    <div class="progress-label"><?= $diasTranscurridos ?> / <?= $diasTotales ?> días</div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    
                                   






                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>No se encontraron horarios para este alumno.</p>
    <?php endif; ?>
</div>


    <?php include 'template/footer.php'; ?>
    <!-- Incluye los archivos JavaScript -->
        <script src="../public/assets/js/AlternarContenidoCursos.js"></script>
    <script src="../public/assets/js/script_home.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <script src="../public/assets/js/script_navbar.js"></script>
    <script src="../public/assets/js/script_navegacion.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>