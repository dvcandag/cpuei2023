<?php
require_once 'config/database.php';

class HorarioAlumnoModel {
    public function getHorarioByCodalumno($codalumno) {
        $db = Database::getInstance();
        $conn = $db->getConnection(); // Obtener la conexión PDO

        $stmt = $conn->prepare("
            SELECT ah.codalumno, h.dia_semana, DATE_FORMAT(h.hora_inicio, '%H:%i') AS hora_inicio, 
                   DATE_FORMAT(h.hora_fin, '%H:%i') AS hora_fin, c.nombrecurso, c.modalidad, c.codcurso 
            FROM alumno_horario ah 
            JOIN horarios_disponibles h ON ah.codhorario = h.codhorario 
            JOIN curso c ON h.codcurso = c.codcurso 
            WHERE ah.codalumno = ?
        ");
        $stmt->execute([$codalumno]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener la duración del período del curso
    public function getDuracionPeriodo($codcurso) {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("
            SELECT p.fechaInicio, p.fechaFin 
            FROM periodo p
            JOIN curso c ON p.codPeriodo = c.codPeriodo
            WHERE c.codcurso = ?
        ");
        $stmt->execute([$codcurso]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>