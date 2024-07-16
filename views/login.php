<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PE | Login</title>

    <!-- Enlace al archivo CSS de Bootstrap -->
    <link rel="stylesheet" type="text/css" href="public/assets/css/bootstrap.css">
    <!-- Enlace al archivo CSS personalizado -->
    <link rel="stylesheet" type="text/css" href="public/assets/css/styles_login.css">
</head>
<body>

    <div class="container">
    <form method="POST" action="index.php?action=login">
        <div class="form-group">
            <label for="codalumno">Código de alumno</label>
            <input type="text" id="codalumno" name="codalumno" placeholder="Ingresa tu código de alumno" required>
        </div>
        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña" required>
        </div>
        <p><a href="views/nuevo_password.php">¿Olvidaste tu contraseña?</a></p>
        <p>¿No tienes una cuenta? <a href="views/registrate.php">Regístrate</a></p>
        <button type="submit" class="btn-submit">Ingresar</button>
    </form>
</div>


</body>
</html>
