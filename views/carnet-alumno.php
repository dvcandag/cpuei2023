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
    <link rel="stylesheet" type="text/css" href="../public/assets/css/styles_header.css">
</head>
<body>

<div class="carnet-container">
    <!-- Contenido del carnet -->
    <?php if (isset($alumno) && $alumno): ?>
        <div class="carnet">
            <h2>Carné del Alumno</h2>
            <p><strong>Nombre:</strong> <?= $alumno['nombrealumno'] . ' ' . $alumno['apaterno'] . ' ' . $alumno['amaterno'] ?></p>
            <p><strong>Código:</strong> <?= $alumno['codalumno'] ?></p>
            <p><strong>Escuela:</strong> <?= $alumno['escuela'] ?></p>
            
           




////////NO FUNCIONA 

 <?php if (isset($alumno['../qr_alumno']) && file_exists($alumno['qr_alumno'])): ?>
                <img class="qr-alumno" src="<?= $alumno['../qr_alumnoqr_alumno'] ?>" alt="QR del alumno <?= $alumno['codalumno'] ?>">
            <?php else: ?>
                <p>No se encontró el código QR del alumno.</p>
            <?php endif; ?>

//////////SI FUNCIONA PERO SOLO PARA UNA ESPECIFICANDO
<?php
// Ruta directa al archivo del código QR del alumno
$ruta_qr = '../database/qr-alumno/qr-11400001.png'; // Ajusta esta ruta según la ubicación y nombre de tu archivo QR

// Verificar si el archivo existe antes de mostrarlo
if (file_exists($ruta_qr)) {
    // Mostrar el código QR del alumno si existe
    echo '<img class="qr-alumno" src="' . $ruta_qr . '" alt="QR del alumno 11400001">';
} else {
    // Mostrar un mensaje si el archivo no existe
    echo "No se encontró el código QR del alumno.";
}
?>




////////EN CORECION
<?php
// Verificar si el campo 'qr_alumno' está definido en los datos del alumno y si el archivo existe
if (isset($alumno['qr_alumno']) && file_exists($alumno['qr_alumno'])) {
    // Mostrar el código QR del alumno si existe
    echo '<img class="qr-alumno" src="' . $alumno['qr_alumno'] . '" alt="QR del alumno ' . $alumno['codalumno'] . '">';
} else {
    // Mostrar un mensaje si el archivo no existe
    echo "No se encontró el código QR del alumno.";
}
?>






        </div>
    <?php else: ?>
        <p>No se encontraron datos del alumno.</p>
    <?php endif; ?>
</div>

</body>
</html>
