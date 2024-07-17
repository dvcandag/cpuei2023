<?php
require_once 'config/database.php';

class CarnetAlumnoModel
{
    public function obtenerDatosAlumno($codAlumno)
    {
        $conn = Database::getInstance()->getConnection();

        try {
            // Realizar una consulta para obtener datos del alumno desde las tablas alumno y usuario
            $query = "SELECT alumno.codalumno, alumno.nombrealumno, alumno.apaterno, alumno.amaterno,
                             alumno.fotoalumno, alumno.escuela, usuario.qr_alumno
                      FROM alumno
                      LEFT JOIN usuario ON alumno.codalumno = usuario.codalumno
                      WHERE alumno.codalumno = :codAlumno";

            $stmt = $conn->prepare($query);
            $stmt->bindParam(':codAlumno', $codAlumno);
            $stmt->execute();
            
            // Obtener el resultado de la consulta
            $alumno = $stmt->fetch(PDO::FETCH_ASSOC);
            return $alumno;
        } catch (PDOException $e) {
            // Si hay un error, devuelve un mensaje de error
            return "Error al obtener datos del alumno: " . $e->getMessage();
        }
    }
}
?>
