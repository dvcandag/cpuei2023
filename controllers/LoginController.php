<?php

require_once 'models/LoginModel.php';
require_once 'models/DashboardModel.php';
require_once 'controllers/CursosController.php';
require_once 'controllers/HorarioAlumnoController.php';

class LoginController {
    public function showLoginForm() {
        // Si el usuario ya está autenticado, redirigir al dashboard
        if (isset($_SESSION["username"])) {
            header("Location: views/dashboard.php");
            exit;
        }
        include "views/login.php";
    }

    public function login() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['codalumno'];
            $password = $_POST['password'];

            $loginModel = new LoginModel();
            $user = $loginModel->getUserByUsername($username);

            // Verificar que el usuario existe y la contraseña es correcta
            if ($user && password_verify($password, $user['password'])) {
                // Verificar si la sesión ya está iniciada
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }

                 // Guardamos el código de alumno en la sesión

$_SESSION["username"] = $username;
$_SESSION["nombre_completo"] = $user['nombrealumno'] . ' ' . $user['apaterno'] . ' ' . $user['amaterno']; // Nombre completo y muestra en header.php
$_SESSION["codalumno"] = $user['codalumno'];  // Guardamos codalumno en la sesión

                
                // Obtener los datos del alumno en perfil del Dashboard
                $dashboardModel = new DashboardModel();
                $alumno = $dashboardModel->getAlumnoByCodalumno($username);
                $_SESSION["alumno"] = $alumno;

             
                

                // Redirigir al panel de control (dashboard)
            header("Location: " . URL . "views/dashboard.php");
                exit;

            } else {
                // Credenciales incorrectas
                echo "<script>alert('Credenciales incorrectas.');</script>";
                $this->showLoginForm(); 
            }
        }
    }
}
?>
