<?php
require_once '../config/database.php';
require_once '../public/PHPQRCode/qrlib.php'; // Importa la librería PHPQRCode

class New_PasswordModel {
    public function actualizarPassword($codalumno, $password) {
        try {
            $conn = Database::getInstance()->getConnection();

            // Usar LEFT JOINs para combinar datos de alumno, aula y periodo en una sola consulta
            $query = "
                SELECT
                    a.codalumno,
                    a.nombrealumno,
                    a.apaterno,
                    a.amaterno,
                    a.dni,
                    a.escuela_nombre,
                    au.nombreAula,
                    p.NombrePeriodo
                FROM
                    alumno a
                LEFT JOIN
                    aula_laboratorio au ON a.codAula = au.codAula
                LEFT JOIN
                    periodo p ON p.codPeriodo
                WHERE
                    a.codalumno = :codalumno
            ";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':codalumno', $codalumno);
            $stmt->execute();

            $alumnoData = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$alumnoData) {
                return "El código de alumno no existe. Por favor, regístrese como alumno antes de actualizar la contraseña.";
            }

            // Validar y asignar valores predeterminados si los datos están vacíos
            $dni = $alumnoData['dni'] ?? 'DNI no registrado';
            $nombreCompleto = trim($alumnoData['nombrealumno'] . ' ' . $alumnoData['apaterno'] . ' ' . $alumnoData['amaterno']);
            $escuelaNombre = $alumnoData['escuela_nombre'] ?? 'No asignada';
            $nombreAula = $alumnoData['nombreAula'] ?? 'No asignada';
            $nombrePeriodo = $alumnoData['NombrePeriodo'] ?? 'No disponible';

            // Generar contenido para el código QR
            $qrContent = "Código: " . $alumnoData['codalumno'] . "\n";
            $qrContent .= "DNI: " . $dni . "\n";
            $qrContent .= "Nombre: " . $nombreCompleto . "\n";
            $qrContent .= "Escuela: " . $escuelaNombre . "\n";
            $qrContent .= "Aula: " . $nombreAula . "\n";
            $qrContent .= "Periodo: " . $nombrePeriodo;

            // Directorio para los códigos QR
            $qrDirectory = '../database/qr-alumno/';

            // Verificar y crear el directorio si no existe
            if (!is_dir($qrDirectory)) {
                mkdir($qrDirectory, 0755, true);
            }

            // Nombre de archivo para el código QR
            $qrFileName = "qr-" . $alumnoData['codalumno'] . '.png';
            $qrFilePath = $qrDirectory . $qrFileName;

            // Generar y guardar el código QR
            QRcode::png($qrContent, $qrFilePath);

            // Actualizar la base de datos del usuario
            $updateUsuarioQuery = "UPDATE usuario SET password = :password, qr_alumno = :qr_alumno WHERE codalumno = :codalumno";
            $stmtUsuario = $conn->prepare($updateUsuarioQuery);
            $stmtUsuario->bindParam(':codalumno', $alumnoData['codalumno']);
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