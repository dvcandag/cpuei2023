<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="public/assets/css/styles_login.css">
</head>

<body>
    <div class="contenedor-principal">
        <div class="contenedor-inicio-sesion">
            <div class="logo">
                <img src="public/assets/images/placeholder/placeholder.png" alt="Logo">
            </div>
            <form class="formulario-inicio-sesion" method="POST" action="index.php?action=login">
                <div class="form-group">
                    <input type="text" id="codalumno" name="codalumno" placeholder="Ingresa tu código de alumno" required>
                </div>
                <div class="form-group">
                    <div class="input-container">
                        <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña" required>
                        <span class="alternar-contraseña" onclick="AlternarContraseña()">
                            <span id="eye" class="emoji">👁️</span>
                        </span>
                    </div>
                </div>
                <button type="submit">Iniciar sesión</button>
            </form>
            <div class="divisor">
                <hr>
                <span>O</span>
                <hr>
            </div>
            <div class="inicio-sesion-facebook">
                <img src="https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg" alt="Facebook">
                <span>Iniciar sesión con Facebook</span>
            </div>
            <div class="olvido-contrasena">
                <a href="views/nuevo_password.php">¿Olvidaste tu contraseña?</a>
            </div>
        </div>
        <div class="contenedor-registro">
            <p>¿No tienes una cuenta? <a href="views/registrate.php">Regístrate</a></p>
        </div>
    </div>
    <!-- Incluye el archivo JavaScript -->
    <script src="public/assets/js/script_login.js"></script>
</body>

</html>
