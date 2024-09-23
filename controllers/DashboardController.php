<?php
require_once 'models/DashboardModel.php';

class DashboardController {
    public function showDashboard() {
        session_start();
        if (!isset($_SESSION["username"])) {
            header("Location: index.php?action=showLoginForm");
            exit;
        }
        
        // Cargar la vista del dashboard
        include "views/dashboard.php";
    }
}
?>

