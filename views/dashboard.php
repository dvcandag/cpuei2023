<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}
$username = $_SESSION['username'];
$alumno = $_SESSION['alumno']; // Obtener datos del alumno desde la sesión
?>

<?php
// Obtener la fecha actual en el formato deseado
$fechaActual = date('j \d\e F \d\e Y');
?>

 <!-- Incluye Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- Incluye estilos propios -->
<link rel="stylesheet" href="../public/assets/css/dashboard.css">


<body>
    <?php include '../views/template/header.php'; ?>
    <?php include '../views/template/navbar.php'; ?>

    


</body>
</html>
