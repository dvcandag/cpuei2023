<?php
// Iniciar la sesión si no se ha iniciado
session_start();

// Verificar si existe el dato del alumno en la sesión
if (!isset($_SESSION['alumno'])) {
    header("Location: index.php"); // Redirigir si no hay datos de alumno en sesión
    exit();
}

$alumno = $_SESSION['alumno'];

// Función para obtener la ruta de la foto del alumno
function obtenerRutaFoto($dni) {
    return '../database/foto-alumno/' . $dni . '.png';
}

// Función para obtener la ruta del código QR del alumno
function obtenerRutaQR($codalumno) {
    return '../database/qr-alumno/qr-' . $codalumno . '.png';
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carné del Alumno</title>
    
    <link rel="stylesheet" type="text/css" href="../public/assets/css/styles_global.css">

<link rel="stylesheet" type="text/css" href="../public/assets/css/styles_carnet.css">
</head>
<body>

<div class="carnet-container">
    <!-- Contenido del carnet -->
    <?php if ($alumno): ?>
        <div class="formulario-carnet">
            <?php if (isset($alumno['dni'])): ?>
                <?php
                $ruta_foto = obtenerRutaFoto($alumno['dni']);
                // Verificar si el archivo de la foto del alumno existe
                if (file_exists($ruta_foto)) {
                    echo '<img class="foto-perfil-carnet" src="' . $ruta_foto . '" alt="Foto del alumno ' . htmlspecialchars($alumno['nombrealumno']) . '" title="Foto del alumno ' . htmlspecialchars($alumno['nombrealumno']) . '">';
                } else {
                    echo '<img class="foto-perfil-carnet" src="../public/assets/images/placeholder/placeholder.png" alt="Foto no disponible" title="No se encontró la foto del alumno">';
                }
                ?>
            <?php endif; ?>

            <div class="info-alumno">
                <div class="detalle-nombres-alumno">
                    <?= htmlspecialchars($alumno['nombrealumno'] . ' ' . $alumno['apaterno'] . ' ' . $alumno['amaterno']) ?>
                </div>
                <div class="detalle-código-universidad">
                    <strong>Código Univ.</strong> <?= htmlspecialchars($alumno['codalumno']) ?>
                </div>

                <!-- Divisor -->
                <div class="linea-divisor-1">
                    <hr>
                </div>

                <div class="detalle-facultad">
                    <?= htmlspecialchars($alumno['escuela']) ?>
                </div>

                <!-- Divisor -->
                <div class="linea-divisor-2">
                    <hr>
                </div>

                <div class="sugerencia-ingreso-qr-universidad">
                    <h4>Puedes ingresar a la universidad mostrando tu código</h4>
                </div>

                <!-- Divisor -->
                <div class="linea-divisor-3">
                    <hr>
                </div>

            </div> <!-- Cierre de .info-alumno -->

            <?php if (isset($alumno['codalumno'])): ?>
                <?php
                $ruta_qr = obtenerRutaQR($alumno['codalumno']);
                // Verificar si el archivo del código QR del alumno existe
                if (file_exists($ruta_qr)) {
                    echo '<img class="qr-alumno" src="' . $ruta_qr . '" alt="QR del alumno ' . htmlspecialchars($alumno['codalumno']) . '">';
                } else {
                    echo "No se encontró el código QR del alumno.";
                }
                ?>
            <?php endif; ?>

        </div> <!-- Cierre de .formulario-carnet -->
    <?php else: ?>
        <p>No se encontraron datos del alumno.</p>
    <?php endif; ?>

</div> <!-- Cierre de .carnet-container -->


</body>
</html>
