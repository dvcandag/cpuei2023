<?php
// Iniciar la sesión si no se ha iniciado
session_start();

// Obtener los datos del alumno desde la sesión
$alumno = $_SESSION['alumno'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carné del Alumno</title>
    <link rel="stylesheet" type="text/css" href="../public/assets/css/styles_carnet.css">
</head>
<body>

<div class="carnet-container">
    <!-- Contenido del carnet -->
    <?php if (isset($alumno) && $alumno): ?>
        <div class="carnet">
            <?php
            // Verificar si el campo 'dni' está definido en los datos del alumno
            if (isset($alumno['dni'])) {
                // Construir la ruta a la foto del alumno
                $ruta_foto = '../database/foto-alumno/' . $alumno['dni'] . '.png';

                // Verificar si el archivo existe
                if (file_exists($ruta_foto)) {
                    // Mostrar la foto del alumno si existe
                    echo '<img class="foto-perfil-carnet" src="' . $ruta_foto . '" alt="Foto del alumno ' . $alumno['nombrealumno'] . '" title="Foto del alumno ' . $alumno['nombrealumno'] . '">';
                } else {
                    // Mostrar la imagen de placeholder si no hay foto
                    echo '<img class="foto-perfil-carnet" src="../public/assets/images/placeholder/placeholder.png" alt="Foto no disponible" title="No se encontró la foto del alumno">';
                }
            }
            ?>

            <p><strong><?= $alumno['nombrealumno'] . ' ' . $alumno['apaterno'] . ' ' . $alumno['amaterno'] ?></strong></p>
            <p><strong>Código Univ.</strong> <?= $alumno['codalumno'] ?></p>
            <p><strong>Facultad</strong> <?= $alumno['escuela'] ?></p>
            <h5>Puedes ingresar a la universidad mostrando tu código</h5>

            <?php
            // Verificar si el campo 'codalumno' está definido en los datos del alumno
            if (isset($alumno['codalumno'])) {
                // Construir la ruta al código QR del alumno
                $ruta_qr = '../database/qr-alumno/qr-' . $alumno['codalumno'] . '.png';

                // Verificar si el archivo existe
                if (file_exists($ruta_qr)) {
                    // Mostrar el código QR del alumno si existe
                    echo '<img class="qr-alumno" src="' . $ruta_qr . '" alt="QR del alumno ' . $alumno['codalumno'] . '">';
                } else {
                    // Mostrar un mensaje si el archivo no existe
                    echo "No se encontró el código QR del alumno.";
                }
            }
            ?>
        </div>
    <?php else: ?>
        <p>No se encontraron datos del alumno.</p>
    <?php endif; ?>
</div>

</body>
</html>
