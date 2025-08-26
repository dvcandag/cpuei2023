<?php
require_once dirname(__DIR__) . '/config/database.php';

class RegistroAccesoModel {
    public function registrarAcceso($codalumno, $ip, $latitud, $longitud) {
        try {
            $conn = Database::getInstance()->getConnection();
            $query = "INSERT INTO registro_acceso (codalumno, fecha, hora_inicio, ip, latitud, longitud)
                      VALUES (:codalumno, CURDATE(), CURTIME(), :ip, :latitud, :longitud)";
            
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':codalumno', $codalumno);
            $stmt->bindParam(':ip', $ip);
            $stmt->bindParam(':latitud', $latitud);
            $stmt->bindParam(':longitud', $longitud);
            $stmt->execute();
            
            return true;
        } catch (PDOException $e) {
            return "Error al registrar el acceso: " . $e->getMessage();
        }
    }

    // Esta es la parte que causa el error. Debe estar DENTRO de la clase.
    public function registrarSalida($codalumno) {
        try {
            $conn = Database::getInstance()->getConnection();

			// Encuentra el ID del último registro de sesión del usuario
            $query_id = "SELECT id FROM registro_acceso WHERE codalumno = :codalumno ORDER BY id DESC LIMIT 1";
            $stmt_id = $conn->prepare($query_id);
            $stmt_id->bindParam(':codalumno', $codalumno);
            $stmt_id->execute();
            $last_id = $stmt_id->fetchColumn();

            if ($last_id) {
			// Actualiza la hora_fin con la hora actual y calcula la duración
                $query_update = "
                    UPDATE registro_acceso
                    SET
                        hora_fin = CURTIME(),
                        duracion_min = TIMESTAMPDIFF(MINUTE, hora_inicio, CURTIME())
                    WHERE id = :id
                ";
                $stmt_update = $conn->prepare($query_update);
                $stmt_update->bindParam(':id', $last_id);
                $stmt_update->execute();
            }
            
            return true;
        } catch (PDOException $e) {
            return "Error al registrar la salida: " . $e->getMessage();
        }
    }
}
?>