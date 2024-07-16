<?php
require_once '../models/New_PasswordModel.php';

class New_PasswordController {
    public function actualizarPassword() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $codalumno = $_POST["codalumno"];
            $password = $_POST["password"];

            // Validación de los datos de entrada
            if (empty($codalumno) || empty($password)) {
                echo "Ingrese el código de alumno y la nueva contraseña.";
                return;
            }

            $alumnoModel = new New_PasswordModel();
            $mensaje = $alumnoModel->actualizarPassword($codalumno, $password);

            echo $mensaje;
        }
    }
}

// Manejar la solicitud POST
$newPasswordController = new New_PasswordController();
$newPasswordController->actualizarPassword();
?>
