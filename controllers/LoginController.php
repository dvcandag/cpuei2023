<?php
// Incluir los archivos de modelo y controlador necesarios.
require_once 'models/LoginModel.php';
require_once 'models/DashboardModel.php';
require_once 'models/RegistroAccesoModel.php'; 
require_once 'controllers/CursosController.php';

// Definir la clase principal del controlador de inicio de sesión.
class LoginController {
    public function showLoginForm() {
        if (isset($_SESSION["username"])) {
            header("Location: views/dashboard.php");
            exit;
        }
        include "views/login.php";
    }

    public function login() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            header('Content-Type: application/json; charset=utf-8'); //importante para que indique tipo de respuesta

            $username = $_POST['codalumno'];
            $password = $_POST['password'];

            $loginModel = new LoginModel();
            $user = $loginModel->getUserByUsername($username);

            if ($user && password_verify($password, $user['password'])) {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }

            // Almacenar los datos del usuario en la sesión para usarlos en otras páginas.
                $_SESSION["username"] = $username;
                $_SESSION["nombre_completo"] = $user['nombrealumno'] . ' ' . $user['apaterno'] . ' ' . $user['amaterno'];
                $_SESSION["codalumno"] = $user['codalumno'];
            
            // Obtener datos adicionales del alumno.
                $dashboardModel = new DashboardModel();
                $alumno = $dashboardModel->getAlumnoByCodalumno($username);
                $_SESSION["alumno"] = $alumno;
                
            // Obtener la dirección IP del usuario y las coordenadas de geolocalización.
                $ip = $_SERVER['REMOTE_ADDR'];
                $latitud = $_POST['latitud'] ?? null;
                $longitud = $_POST['longitud'] ?? null;

            // Crear una instancia del modelo de registro de acceso.
                $registroAccesoModel = new RegistroAccesoModel();
                $registroAccesoModel->registrarAcceso($user['codalumno'], $ip, $latitud, $longitud);

            //respondemos con JSON                
                echo json_encode(["status" => "success"]);
    exit;
            } else {
                echo json_encode(["status" => "error", "message" => "Credenciales incorrectas"]);
    exit;
            }
        }
    }
}
?>