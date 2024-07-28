<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="../public/assets/css/styles_login.css">
</head>

<body>
    <div class="contenedor-principal">
        <div class="contenedor-inicio-sesion">
            <div class="logo">
                <img src="../public/assets/images/placeholder/placeholder.png" alt="Logo">
            </div>
            <!-- Formulario de actualización de contraseña -->
            <form class="formulario-inicio-sesion" action="../controllers/New_PasswordController.php" method="post">
                <h4>¿Olvidaste tu contraseña?</h4>
                <p>Ingresa el usuario que utilizaste en el sistema para cambiar tu contraseña.</p>
                <div class="form-group">
                    <input type="text" name="codalumno" id="codalumno" placeholder="Ingresa tu código" required>
                </div>
                <div class="form-group">
                    <div class="input-container">
                        <input type="password" name="password" id="password" placeholder="Ingresa nueva contraseña" required>
                        <span class="alternar-contraseña" onclick="AlternarContraseña()">
                            <span id="eye" class="emoji">👁️</span>
                        </span>
                    </div>
                </div>
                <button type="submit">Actualizar contraseña</button>
            </form>
            <div class="divisor">
                <hr>
                <span>O</span>
                <hr>
            </div>
            <div class="olvido-contrasena">
                <a href="../views/registrate.php">¿No tienes una cuenta? Regístrate</a>
            </div>
        </div>
        <div class="contenedor-registro">
            <p>¿Ya tienes una cuenta? <a href="../index.php">Inicia sesión</a></p>
        </div>
    </div>
    <script src="../public/assets/js/script_login.js"></script>
</body>
</html>
