<?php
require_once 'config/database.php';

class DashboardModel {
    public function getAlumnoByCodalumno($codalumno) {
        $conn = Database::getInstance()->getConnection();
        $query = "SELECT * FROM alumno WHERE codalumno = :codalumno";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':codalumno', $codalumno);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }



}
?>