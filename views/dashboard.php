<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: index.php?action=showLoginForm");
    exit;
}

// Código para mostrar el dashboard
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../public/assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    
    <!-- Aquí va el contenido del dashboard -->
    <?php include '../views/template/header.php'; ?>
    <?php include '../views/template/navbar.php'; ?>


    
    <?php include '../views/template/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../public/assets/js/custom.js"></script>
</body>
</html>
