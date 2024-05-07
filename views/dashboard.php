<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}
$username = $_SESSION['username'];
$alumno = $_SESSION['alumno']; // Obtener datos del alumno desde la sesión

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Enlace al archivo CSS de Bootstrap -->
    <link rel="stylesheet" type="text/css" href="../public/assets/css/bootstrap.css">
    <!-- Enlace al archivo CSS de Styles -->
    <link rel="stylesheet" type="text/css" href="../public/assets/css/styles_navbar.css">
    <link rel="stylesheet" type="text/css" href="../public/assets/css/font.css">
</head>

<?php include '../views/template/header.php'; ?>
<?php include '../views/template/navbar.php'; ?>

