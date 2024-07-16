<?php
require_once '../config/database.php';
require_once '../public/PHPQRCode/qrlib.php'; // Importa la librería PHPQRCode

class New_PasswordModel {
    public function actualizarPassword($codalumno, $password) {
        try {
            $conn = Database::getInstance()->getConnection();

            $query = "SELECT codalumno, nombrealumno, apaterno, amaterno, escuela, aula FROM alumno WHERE codalumno = :codalumno";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':codalumno', $codalumno);
            $stmt->execute();

            if ($stmt->rowCount() == 0) {
                return "El código de alumno no existe. Por favor, regístrese como alumno antes de actualizar la contraseña.";
            }

            // Obtener datos del alumno
            $alumnoData = $stmt->fetch(PDO::FETCH_ASSOC);
            $nombreCompleto = $alumnoData['nombrealumno'] . ' ' . $alumnoData['apaterno'] . ' ' . $alumnoData['amaterno'];

            // Generar contenido para el código QR
            $qrContent = "Código: " . $codalumno . "\n";
            $qrContent .= "Nombre: " . $nombreCompleto . "\n";
            $qrContent .= "Escuela: " . $alumnoData['escuela'] . "\n";
            $qrContent .= "Aula: " . $alumnoData['aula'];

            // Directorio donde se guardarán los códigos QR (cambia la ruta a tu nueva carpeta)
            $qrDirectory = '../database/qr-alumno/';

            // Nombre de archivo para el código QR con prefijo "qr-" y código de alumno
            $qrFileName = "qr-" . $codalumno . '.png';

            // Generar el código QR y guardarlo
            QRcode::png($qrContent, $qrDirectory . $qrFileName);

            // Actualizar la base de datos con la ruta del archivo del código QR generado
            $qrFilePath = $qrDirectory . $qrFileName;
            $updateUsuarioQuery = "UPDATE usuario SET password = :password, qr_alumno = :qr_alumno WHERE codalumno = :codalumno";
            $stmtUsuario = $conn->prepare($updateUsuarioQuery);
            $stmtUsuario->bindParam(':codalumno', $codalumno);
            $stmtUsuario->bindParam(':password', password_hash($password, PASSWORD_DEFAULT));
            $stmtUsuario->bindParam(':qr_alumno', $qrFilePath);
            $stmtUsuario->execute();

            // Redirigir al usuario
            header("Location: ../index.php");
            exit();

        } catch (PDOException $e) {
            return "Error al actualizar la contraseña: " . $e->getMessage();
        }
    }
}
?>
