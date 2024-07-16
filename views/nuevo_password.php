<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Contraseña</title>
    <!-- Enlace al archivo CSS de Bootstrap -->
    <link rel="stylesheet" type="text/css" href="../public/assets/css/bootstrap.css">
    <!-- Enlace al archivo CSS de Styles -->
    <link rel="stylesheet" type="text/css" href="../public/assets/css/styles_login.css">

</head>
<body>
    <div class="container">
                <!-- Formulario de actualización de contraseña -->
                <form action="../controllers/New_PasswordController.php" method="post">
                    <h3 class="text-center">¿Olvidaste tu contraseña?</h3>
                    <p class="text-center">Ingresa el usuario que utilizaste en el sistema para cambiar tu contraseña.</p></p>
                    <div class="form-group">
                        <label for="codalumno">Código de Alumno:</label>
                        <input type="text" name="codalumno" id="codalumno" placeholder="Ingresa tu código" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Nueva Contraseña:</label>
                        <input type="password" name="password" id="password" placeholder="Ingresa nueva contraseña" required>
                    </div></p>
                    <button type="submit" class="btn-submit">Actualizar contraseña</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Enlace al archivo JS de Bootstrap -->
    <script src=""></script>
</body>
</html>
