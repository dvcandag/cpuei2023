<?php
session_start();

// Habilitar el reporte de errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'config/config.php';
require_once 'config/database.php';
require_once 'controllers/LoginController.php';
require_once 'controllers/HeaderController.php';
require_once 'controllers/DashboardController.php';
require_once 'controllers/CursosController.php';
require_once 'controllers/HorarioAlumnoController.php';
require_once 'controllers/MatriculaController.php';


$action = $_GET['action'] ?? 'showLoginForm';

$loginController = new LoginController();
$headerController = new HeaderController();
$cursosController = new CursosController();
$dashboardController = new DashboardController();
$horarioAlumnoController = new HorarioAlumnoController();
$matriculaController = new MatriculaController(); 


if (isset($_SESSION['username'])) {
    // No es necesario llamar a $headerController->index() aquí si no existe este método
}

switch ($action) {
    case 'showLoginForm':
        $loginController->showLoginForm();
        break;

    case 'login':
        $loginController->login();
        break;

    case 'logout':
        session_destroy();
        header("Location: index.php?action=showLoginForm");
        exit;

    case 'mostrarCursosMatriculados':
        $cursosController->mostrarCursosMatriculados();
        break;

    case 'dashboard':
        $dashboardController->showDashboard();
        break;

    case 'mostrarHorario':
        $horarioAlumnoController->mostrarHorario();
        break;

    case 'mostrarMatricula': // por ver Acción para mostrar el formulario de matrícula
        $matriculaController->mostrarFormularioMatricula();
        break;    
case 'seleccionarPeriodo':///va
        $controller = new MatriculaController();
        $controller->seleccionarPeriodo();
        break;

case 'obtenerCursosPorPeriodo': // Nueva acción para obtener cursos por período
        $matriculaController->obtenerCursosPorPeriodo();
        break;

    default:
        $loginController->showLoginForm();
        break;
}
?>