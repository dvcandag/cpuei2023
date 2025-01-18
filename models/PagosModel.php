<?php
require_once 'config/database.php'; // Asegúrate de que el archivo de base de datos se incluya

class PagosModel {
    public function obtenerPagos($codalumno) {
        $conn = Database::getInstance()->getConnection();
        $query = "SELECT * FROM pagos WHERE codalumno = :codalumno";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':codalumno', $codalumno);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retorna todos los pagos del alumno
    }
}
?>
