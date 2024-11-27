<?php
session_start();

// Verifica si la sesión está activa
if (!isset($_SESSION['username'])) {
    header("Location: index.php?action=showLoginForm");
    exit;
}

// Definir la variable $fechaActual con la fecha actual
$fechaActual = date('d-m-Y'); // Formato de día-mes-año
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- Incluye Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Enlace al archivo CSS de Bootstrap v5.2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Enlace a los archivos CSS de Styles -->
    <link rel="stylesheet" href="../public/assets/css/styles_dashboard.css">
</head>
<body>

    <!-- Incluye el encabezado -->
    <?php include '../views/template/header.php'; ?>

    <!-- Incluye la barra de navegación -->
    <?php include '../views/template/navbar.php'; ?>

    <!-- Contenedor donde se cargará el contenido dinámico -->
    <div id="contenido" class="container-dashboard">
        <?php include '../views/home.php'; ?>
    </div>

    <!-- Incluye el pie de página -->
    <?php include '../views/template/footer.php'; ?>

    <!-- Incluye los archivos JavaScript -->
    <script src="../public/assets/js/slider-dashboard.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
