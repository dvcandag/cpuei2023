<?php
require_once 'models/DashboardModel.php';

class DashboardController {
    public function index() {
        session_start();
        if (!isset($_SESSION['username'])) {
            header("Location: index.php");
            exit;
        }
        $username = $_SESSION['username'];

          // Obtener datos del alumno desde la sesión
        $alumno = $_SESSION['alumno'];

        $notas = $_SESSION['notas']; 

        // Renderizar la vista
        include "views/dashboard.php";
    }
}
?>
