<?php
// Iniciar la sesión
session_start();

// Verificar si los datos del alumno están 
// Obtener los datos del alumno desde la sesión
$alumno = $_SESSION['alumno'];
?>

<!DOCTYPE html>
<html lang="es">
  <link rel="stylesheet" type="text/css" href="../public/assets/css/styles_header.css">
<body>
   <div class="carnet-container">
        <!-- Contenido del carnet -->
        <?php if (isset($alumno) && $alumno): ?>
        <div class="carnet">
            <h2>Carnet del Alumno</h2>
            <p><strong>Nombre:</strong> <?= $alumno['nombrealumno'] . ' ' . $alumno['apaterno'] . ' ' . $alumno['amaterno'] ?></p>
            <p><strong>Código:</strong> <?= $alumno['codalumno'] ?></p>
            <p><strong>Escuela:</strong> <?= $alumno['escuela'] ?></p>
            
            <img class="foto-alumno" src="data:image/jpeg;base64,<?= base64_encode($alumno['fotoalumno']) ?>" alt="Foto del alumno">
            <img class="qr-alumno" src="data:image/png;base64,<?= base64_encode($alumno['qr_alumno']) ?>" alt="QR del alumno">
        </div>
        <?php else: ?>
        <p>No se encontraron datos del alumno.</p>
        <?php endif; ?>
    </div>
</body>
</html>
