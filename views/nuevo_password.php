<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Contraseña</title>
    
    <!-- Enlace al archivo CSS global -->
<link rel="stylesheet" type="text/css" href="../public/assets/css/styles_global.css">

    <!-- Incluye Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Enlace al archivo CSS personalizado -->
    <link rel="stylesheet" type="text/css" href="../public/assets/css/styles_login.css">
</head>
<body>
    <!-- Contenedor principal -->
    <div class="contenedor-principal">
        
        <!-- Contenedor para la actualización de contraseña -->
        <div class="contenedor-nuevo-password">
            <!-- Logo -->
            <div class="logo">
                <img src="../public/assets/images/placeholder/placeholder.png" alt="Logo">
            </div>
            
            <!-- Formulario de actualización de contraseña -->
            <form class="formulario-inicio-sesion" action="../controllers/New_PasswordController.php" method="post">
                <!-- Sugerencia para el usuario -->
                <div class="sugerencia-nuevo-password">
                    <h4>¿Olvidaste tu contraseña?</h4>
                    <p>Ingresa el usuario que utilizaste en el sistema para cambiar tu contraseña.</p>
                </div>
                
                <!-- Campo para el código de alumno -->
                <div class="form-group">
                    <input type="text" name="codalumno" id="codalumno" placeholder="Ingresa tu código" required>
                </div>
                
                <!-- Campo para la nueva contraseña -->
                <div class="form-group">
                    <div class="input-container">
                        <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña" required>
                        <span class="alternar-contraseña" onclick="AlternarContraseña()">
                            <span id="eye" class=" icon-vista-contraseña emoji">
                                <i class="fas fa-eye"></i>
                            </span>
                        </span>
                    </div>
                </div>
                
                <!-- Botón para actualizar contraseña -->
                <button type="submit">Actualizar contraseña</button>
            </form>
            
            <!-- Divisor -->
            <div class="divisor">
                <hr>
                <span>O</span>
                <hr>
            </div>
            
            <!-- Enlace para registro -->
            <div class="olvido-contrasena">
                <a href="../views/registrate.php">¿No tienes una cuenta? Regístrate</a>
            </div>
        </div>
        
        <!-- Contenedor para el registro -->
        <div class="contenedor-formulario-usuario-existente">
            <p>¿Ya tienes una cuenta? <a href="../index.php">Inicia sesión</a></p>
        </div>
    </div>
    
    <!-- Incluye el archivo JavaScript -->
    <script src="../public/assets/js/script_login.js"></script>
</body>
</html>
