<?php
session_start();

// Incluir archivos de configuración y controladores
require_once 'config/config.php';
require_once 'config/database.php';
require_once 'controllers/LoginController.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'showLoginForm';

$loginController = new LoginController();

switch ($action) {
    case 'showLoginForm':
        $loginController->showLoginForm();
        break;
    case 'login':
        $loginController->login();
        break;
    case 'logout':
        // Redirigir a logout.php para manejar el cierre de sesión
        header("Location: logout.php");
        exit;
    default:
        $loginController->showLoginForm();
        break;
}
?>
