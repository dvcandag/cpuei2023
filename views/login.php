<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    
    <!-- Enlace al archivo CSS global -->

    <link rel="stylesheet" type="text/css" href="public/assets/css/styles_global.css">

    <!-- Incluye Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Enlace al archivo CSS personalizado -->
    <link rel="stylesheet" type="text/css" href="public/assets/css/styles_login.css">
</head>

<body>
    <!-- Contenedor principal -->
    <div class="contenedor-principal">
        
        <!-- Contenedor de inicio de sesión -->
        <div class="contenedor-inicio-sesion">
            <!-- Logo -->
            <div class="logo">
                <img src="public/assets/images/placeholder/placeholder.png" alt="Logo">
            </div>
            
            <!-- Formulario de inicio de sesión -->
            <form class="formulario-inicio-sesion" method="POST" action="index.php?action=login">
                <!-- Campo de código de alumno -->
                <div class="form-group">
                    <input type="text" id="codalumno" name="codalumno" placeholder="Ingresa tu código de alumno" required>
                </div>
                
                <!-- En el formulario de contraseña -->
            <div class="form-group">
                <div class="input-container">
                    <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña" required>
                   <span class="icon-vista-contraseña alternar-contraseña" onclick="AlternarContraseña()">
                    <i class="fas fa-eye"></i> <!-- Icono del ojo -->
                    </span>
                </div>
            </div>

            <!-- Botón de inicio de sesión -->
                <button id="loginButton">Iniciar sesión</button>
            </form>
            
            <!-- Divisor -->
            <div class="divisor">
                <hr>
                <span>O</span>
                <hr>
            </div>
            
            <!-- Inicio de sesión con Gmail -->
            <div class="inicio-sesion-gmail">
                <a href="https://mail.google.com/" class="inicio-sesion-gmail">
                    <i class="icon-gmail fa-brands fa-google gmail-icon"></i> 
                    <span>Iniciar sesión con Gmail</span>
                </a>
            </div>
            
            <!-- Enlace de olvido de contraseña -->
            <div class="olvido-contrasena">
                <a href="views/nuevo_password.php">¿Olvidaste tu contraseña?</a>
            </div>
            </div> <!-- Fin del contenedor de inicio de sesión -->

            <!-- Contenedor para iniciar sesión si ya tienes cuenta -->
            <div class="contenedor-formulario-registrate-nuevo">
                <p>¿No tienes una cuenta? <a href="views/registrate.php">Regístrate</a></p>
            </div>
            
    </div> <!-- Fin del contenedor principal -->
    
    <!-- Incluye el archivo JavaScript -->
    <script src="public/assets/js/script_login.js"></script>
</body>

</html>
