<?php
require_once 'models/LoginModel.php';
require_once 'models/DashboardModel.php';
require_once 'controllers/CursosController.php';

class LoginController {
    public function showLoginForm() {
        include "views/login.php";
    }

    public function login() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['codalumno'];
            $password = $_POST['password'];

            $loginModel = new LoginModel();
            $user = $loginModel->getUserByUsername($username);

            if ($user && password_verify($password, $user['password'])) {
                session_start();
                $_SESSION["username"] = $username;

                $dashboardModel = new DashboardModel();
                $alumno = $dashboardModel->getAlumnoByCodalumno($username);
                $_SESSION["alumno"] = $alumno;

                $cursosController = new CursosController();
                $cursosMatriculados = $cursosController->mostrarCursosMatriculados($username);

                if ($cursosMatriculados) {
                    $_SESSION['cursosMatriculados'] = $cursosMatriculados;
                }

                $notas = $dashboardModel->getNotasByCodalumno($alumno['codalumno']);
                $_SESSION['notas'] = $notas;

                // Redireccionar al panel de control
                header("Location: views/dashboard.php");
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
