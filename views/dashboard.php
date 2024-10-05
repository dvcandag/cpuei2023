<?php
session_start();

// Verifica si la sesión está activa
if (!isset($_SESSION['username'])) {
    // Si no hay sesión activa, redirigir al login
    header("Location: index.php?action=showLoginForm");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../public/assets/css/styles_dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    
    <!-- Aquí va el contenido del dashboard -->
    <?php include '../views/template/header.php'; ?>
    <?php include '../views/template/navbar.php'; ?>

 <!-- Contenedor principal del Dashboard -->
    <div class="dashboard-container">

            <?php include '../views/CursosView.php'; ?>

    <!-- Contenido del dashboard aquí -->
   


<!-- contenido del footer -->
<?php include '../views/template/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../public/assets/js/custom.js"></script>
</body>
</html>
