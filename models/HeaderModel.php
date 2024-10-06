<?php
require_once 'config/database.php';

class HeaderModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAlumnoDatos($alumno_id) {
        $sql = "SELECT codalumno, CONCAT(nombrealumno, ' ', apaterno, ' ', amaterno) AS nombre_completo, escuela, aula, fotoalumno, dni, fecha_nacimiento, correo FROM alumno WHERE codalumno = :codalumno";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':codalumno', $alumno_id, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>