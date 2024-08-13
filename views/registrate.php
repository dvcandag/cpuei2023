<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Contraseña</title>
    
        <!-- Enlace al archivo CSS global -->
<link rel="stylesheet" type="text/css" href="../public/assets/css/styles_global.css">

   

    <!-- Incluye Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Estilos personalizados -->
    <link rel="stylesheet" type="text/css" href="../public/assets/css/styles_registrate.css">
</head>
<body>
    <div class="contenedor-principal">
        <!-- Contenedor del formulario de registro -->
        <div class="contenedor-formulario-registro">
            <!-- Logo -->
            <div class="logo">
                <img src="../public/assets/images/placeholder/placeholder.png" alt="Logo">
            </div>

            <!-- Invitación a registrarse -->
            <div class="sugerencia-nuevo-registro invitacion-registrate">
                <h4><span>DEJA TUS DATOS Y</span><br><span class="contactamos">TE CONTACTAMOS PRONTO</span></h4>
                <p class="invitacion-parrafo">Inscríbete y sé parte de nuestra comunidad académica</p>
            </div>

            <!-- Formulario de inicio de sesión con Gmail -->
            <div class="formulario-inicio-sesion">
                <button type="submit" class="icon-gmail">
                    <i class="icon-gmail <?php echo htmlentities($var, ENT_QUOTES, 'utf-8') ?>fa-brands fa-google gmail-icon"></i>
                    Iniciar sesión con Gmail
                </button>
            </div>
            
            <!-- Formulario de registro -->
            <form action="registro.php" method="POST" class="formulario-inicio-sesion">
                <div class="form-group">
                    <input type="text" id="nombres" name="nombres" placeholder="Nombres" required>
                </div>
                <div class="form-group-apellidos">
                    <input type="text" id="ApellidoPaterno" name="ApellidoPaterno" placeholder="Apellido Paterno" required>
                    <input type="text" id="ApellidoMaterno" name="ApellidoMaterno" placeholder="Apellido Materno" required>
                </div>
                <div class="form-group-DNI-fecha-nacimiento">
                    <input type="text" id="DNI" name="DNI" placeholder="DNI" required>
                    <input type="date" id="FechaNacimiento" name="FechaNacimiento" placeholder="Fecha de Nacimiento" required>
                </div>
                <div class="form-group">
                    <input type="email" id="email" name="email" placeholder="Correo electrónico" required>
                </div>
                <div class="form-group">
                    <input type="text" id="Celular" name="Celular" placeholder="Celular" required>
                </div>
                <div class="form-group-contacto">
                    <select id="MedioContacto" name="MedioContacto" required>
                        <option value="" disabled selected>¿Cómo te gustaría que te contactáramos?</option>
                        <option value="correo">Correo electrónico</option>
                        <option value="whatsApp">WhatsApp</option>
                        <option value="llamada">Llamada</option>
                    </select>
                </div>
                <button type="submit">Registrarte</button>
            </form>
            
            <!-- Divisor -->
            <div class="divisor">
                <hr>
                <span>O</span>
                <hr>
            </div>
            
            <!-- Políticas de registro -->
            <p class="sugerencia-nuevo-registro políticas">
                Al registrarte, aceptas nuestras <a href="#">Condiciones</a>, nuestra <a href="#">Política de privacidad</a> y nuestra <a href="#">Política de cookies</a>.
            </p>
        </div>
        
        <!-- Contenedor para iniciar sesión si ya tienes cuenta -->
        <div class="contenedor-nuevo-registro sugerencia-nuevo-registro">
            <p>¿Tienes una cuenta? <a href="../index.php">Inicia sesión</a></p>
        </div>
    </div>
</body>
</html>
