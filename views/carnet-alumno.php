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
        <p><?= $alumno['nombrealumno'] . ' ' . $alumno['apaterno'] . ' ' . $alumno['amaterno'] ?></p>
        <p><strong>Código Univ.
        </strong> <?= $alumno['codalumno'] ?></p>
            <p><?= $alumno['escuela'] ?></p>
            <h3>Puedes ingresar a la universidad mostrando tu código</h3>
            
           
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
} else {
    // Mostrar un mensaje si no se encontraron datos del alumno en la sesión
    echo "No se encontraron datos del alumno en la sesión.";
}
?>

        </div>
    <?php else: ?>
        <p>No se encontraron datos del alumno.</p>
    <?php endif; ?>
</div>

</body>
</html>
