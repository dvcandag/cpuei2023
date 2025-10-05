<?php

// Incluir el archivo del modelo para registrar el acceso.
require_once dirname(__DIR__) . '/models/RegistroAccesoModel.php';

// Iniciar la sesión de PHP para acceder a las variables de sesión.
session_start();

// Verificar si el usuario está autenticado comprobando la variable de sesión.
if (isset($_SESSION["codalumno"])) {
// Obtener el código del alumno de la sesión.
    $codalumno = $_SESSION["codalumno"];
    
    // Crear una instancia del modelo para interactuar con la base de datos.
    $registroAccesoModel = new RegistroAccesoModel();
    $registroAccesoModel->registrarSalida($codalumno);
}

// Limpiar todas las variables de la sesión.
$_SESSION = [];

// Si se usan cookies de sesión, elimina del navegador del usuario.
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// destruir la sesión en el servidor.
session_destroy();

// Redirigir al usuario de vuelta a la página de inicio de sesión.
header("Location: ../index.php?action=showLoginForm");
exit;
?>