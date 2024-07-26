<?php
require_once 'config/database.php';

class CarnetAlumnoModel {

    public function obtenerAlumnos() {
        try {
            $conn = Database::getInstance()->getConnection();

            // Consulta para obtener todos los datos de los alumnos, incluyendo la ruta del QR si está disponible
            $query = "SELECT alumno.codalumno, alumno.nombrealumno, alumno.apaterno, alumno.amaterno,
                             alumno.escuela, usuario.qr_alumno AS qr_nombre, alumno.fotoalumno
                      FROM alumno
                      LEFT JOIN usuario ON alumno.codalumno = usuario.codalumno";

            $stmt = $conn->prepare($query);
            $stmt->execute();

            // Obtener todos los resultados como un arreglo asociativo
            $alumnos = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $alumnos;

        } catch (PDOException $e) {
            return "Error al obtener datos de los alumnos: " . $e->getMessage();
        }
    }
}
?>
