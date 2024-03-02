
<?php
require_once '../config/database.php';

class New_PasswordModel {
    public function actualizarPassword($codalumno, $password) {
        try {
            $conn = Database::getInstance()->getConnection();

            $query = "SELECT codalumno FROM alumno WHERE codalumno = :codalumno";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':codalumno', $codalumno);
            $stmt->execute();

            if ($stmt->rowCount() == 0) {
                return "El código de alumno no existe. Por favor, regístrese como alumno antes de actualizar la contraseña.";
            }

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $updateUsuarioQuery = "UPDATE usuario SET password = :password WHERE codalumno = :codalumno";
            $stmtUsuario = $conn->prepare($updateUsuarioQuery);
            $stmtUsuario->bindParam(':codalumno', $codalumno);
            $stmtUsuario->bindParam(':password', $hashedPassword);
            $stmtUsuario->execute();

            //return "Contraseña actualizada correctamente.";

 // Redirigir al usuario de vuelta al formulario de inicio de sesión
          //  header("Location: ../views/login.php");
           // exit();

        header("Location: ../index.php");
            exit();


        } catch (PDOException $e) {
            return "Error al actualizar la contraseña: " . $e->getMessage();
        }
    }
}
?>