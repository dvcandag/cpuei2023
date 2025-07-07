<?php
require_once 'config/database.php';

class PeriodosFinalizadosModel {
    public function obtenerPeriodosFinalizados() {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        try {
            $stmt = $conn->prepare("
                SELECT codPeriodo, NombrePeriodo 
                FROM periodo
                WHERE fechaFin <= CURDATE()
                ORDER BY fechaFin DESC
            ");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en obtenerPeriodosFinalizados: " . $e->getMessage());
            return [];
        }
    }
}
?>

