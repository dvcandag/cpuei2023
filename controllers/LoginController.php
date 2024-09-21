<?php
require_once 'models/LoginModel.php';
require_once 'models/DashboardModel.php';
require_once 'controllers/CursosController.php';

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
                session_start();

                // Guardar los datos del usuario en la sesión
                $_SESSION["username"] = $username;
                $_SESSION["nombre_completo"] = $user['nombrealumno'] . ' ' . $user['apaterno'] . ' ' . $user['amaterno']; // Nombre completo
                
                // Obtener los datos del alumno desde el DashboardModel
                $dashboardModel = new DashboardModel();
                $alumno = $dashboardModel->getAlumnoByCodalumno($username);
                $_SESSION["alumno"] = $alumno;

                // Obtener los cursos matriculados y guardarlos en la sesión
                $cursosController = new CursosController();
                $cursosMatriculados = $cursosController->mostrarCursosMatriculados($username);
                if ($cursosMatriculados) {
                    $_SESSION['cursosMatriculados'] = $cursosMatriculados;
                }

                // Obtener las notas del alumno y guardarlas en la sesión
                $notas = $dashboardModel->getNotasByCodalumno($alumno['codalumno']);
                $_SESSION['notas'] = $notas;

                // Redirigir al panel de control (dashboard)
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
