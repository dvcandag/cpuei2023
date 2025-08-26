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
require_once 'controllers/PeriodosFinalizadosController.php';

$action = $_GET['action'] ?? 'showLoginForm';

$loginController = new LoginController();
$headerController = new HeaderController();
$cursosController = new CursosController();
$dashboardController = new DashboardController();
$horarioAlumnoController = new HorarioAlumnoController();
$matriculaController = new MatriculaController();
$periodosFinalizadosController = new PeriodosFinalizadosController();

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
        // Asegurarnos de manejar tanto GET como POST para el período
        $horarioAlumnoController->mostrarHorario();
        break;

    case 'mostrarMatricula':
        $matriculaController->mostrarFormularioMatricula();
        break;    
    
    case 'seleccionarPeriodo':
        $matriculaController->seleccionarPeriodo();
        break;

    case 'obtenerCursosPorPeriodo':
        $matriculaController->obtenerCursosPorPeriodo();
        break;

    case 'guardarMatricula':
        $matriculaController->guardarMatricula();
        break;
        
    case 'mostrarPeriodosFinalizados':
        $periodosFinalizadosController->mostrarVistaPeriodosFinalizados();
        break;

    case 'obtenerResumenCiclo':
        $periodosFinalizadosController->mostrarResumen();
        break;

    default:
        $loginController->showLoginForm();
        break;
}

?>