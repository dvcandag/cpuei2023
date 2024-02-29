<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PE | Login</title>

  <!-- Enlace al archivo CSS de Bootstrap -->
  <link rel="stylesheet" type="text/css" href="public/assets/css/bootstrap.css">
  <!-- Enlace al archivo CSS de Styles -->
  <link rel="stylesheet" type="text/css" href="public/assets/css/styles.css">
</head>
<body>

  <div class="container-fluid" id="main-container">
    <div class="row vh-100">

      <!-- Formulario de inicio de sesión -->
      <div class="col-md-12 p-4">
        <form method="POST" action="index.php?action=login">
          <label for="codalumno">Código de alumno</label>
          <input type="text" id="codalumno" name="codalumno" placeholder="Ingresa tu código de alumno" required>
          <label for="password">Contraseña</label>
          <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña" required>
          <p><a href="views/nuevo_password.php">¿Olvidaste tu contraseña?</a></p>
          <p>¿No tienes una cuenta? <a href="views/registrate.php">Regístrate</a></p>
          <button type="submit">Ingresar</button>
        </form>
      </div>

    </div>
  </div>

</body>
</html>
