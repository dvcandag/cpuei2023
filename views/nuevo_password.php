<!DOCTYPE html>
<html>
<head>
    <title>Actualizar Contraseña</title>

     <!-- Enlace al archivo CSS de Bootstrap -->
  <link rel="stylesheet" type="text/css" href="public/assets/css/bootstrap.css">
  <!-- Enlace al archivo CSS de Styles -->
  <link rel="stylesheet" type="text/css" href="../public/assets/css/styles.css">
</head>
<body>

  <div class="container-fluid" id="main-container">
    <div class="row vh-100">
      <!-- Formulario de inicio de sesión -->
      <div class="col-md-12 p-4">
        <form action="../controllers/New_PasswordController.php" method="post">
          <h3>¿Olvidaste tu contraseña?</h3>
          <p>Ingresa el usuario que creaste en el sistema, para poder cambiar tu contraseña.</p><br>
          <label for="codalumno">Código de Alumno:</label>
          <input type="text" name="codalumno" id="codalumno" placeholder="Ingresa tu código" required>
          <label for="password">Nueva Contraseña:</label>
          <input type="password" name="password" id="password" placeholder="Ingresa nueva contraseña" required><br><br>
          <button type="submit" class="btn-actualizar">Actualizar contraseña</button>
        </form>
      </div> 
    </div>
  </div>
</body>
</html>
