<?php
require_once 'models/DashboardModel.php';

class DashboardController {
    public function showDashboard() {
        session_start();
        if (!isset($_SESSION["username"])) {   
            header("Location: index.php?action=showLoginForm");
            exit;
        }

        $codalumno = $_SESSION["username"]; // Suponiendo que el username es el código del alumno
        $dashboardModel = new DashboardModel();
      
        // Obtener información del alumno
        $alumno = $dashboardModel->getAlumnoByCodalumno($codalumno);

        // Si el alumno no existe, redireccionar al login
        if (!$alumno) {
            session_destroy();
            header("Location: index.php?action=showLoginForm");
            exit;
        }

        // Cargar la vista del dashboard
        include "views/dashboard.php";
    }
}
?>
