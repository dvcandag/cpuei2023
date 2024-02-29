<?php
require_once 'models/LoginModel.php';
require_once 'models/DashboardModel.php'; // Se incluye para poder acceder a los datos del alumno en la sesión


class LoginController {
    public function showLoginForm() {
        include "views/login.php";
    }

    public function login() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Verifica si se reciben los datos del formulario correctamente
            $username = $_POST['codalumno'];
            $password = $_POST['password'];

            // Verificar las credenciales del usuario
            $loginModel = new LoginModel();
            $user = $loginModel->getUserByUsername($username);

            // Verificar si se obtiene el usuario correctamente
            if ($user) {
                // Obtener la contraseña almacenada en la base de datos
                $stored_password = $user['password'];

                // Verificar si las contraseñas coinciden
                if ($password === $stored_password) {
                    // Contraseña válida, iniciar sesión
                    session_start();
                    $_SESSION["username"] = $username;




// Obtener datos del alumno desde models/DashboardModel.php 
$dashboardModel = new DashboardModel();
$alumno = $dashboardModel->getAlumnoByCodalumno($username);
// Guardar datos del alumno en la sesión
$_SESSION["alumno"] = $alumno;



// Obtener notas del alumno
$dashboardModel = new DashboardModel();
$notas = $dashboardModel->getNotasByCodalumno($alumno['codalumno']);

// Guardar las notas del alumno en la sesión
$_SESSION['notas'] = $notas;




                    // direcciona a la pagina 
                    header("Location: views/dashboard.php");
                    exit;
                } else {
                    // Contraseña incorrecta
                    echo "<script>alert('Credenciales incorrectas.');</script>";
                    $this->showLoginForm(); 
                }
            } else {
                // Usuario no encontrado
                echo "<script>alert('Usuario no encontrado.');</script>";
                $this->showLoginForm(); 

            }
        }
    }
}
?>
