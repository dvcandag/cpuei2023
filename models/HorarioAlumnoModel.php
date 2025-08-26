<?php
require_once 'config/database.php';

class HorarioAlumnoModel {
    public function getHorarioByCodalumno($codalumno) {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        // Obtenemos el período activo (con margen de 15 días antes/después por si acaso)
        $stmtPeriodo = $conn->prepare("
            SELECT codPeriodo 
            FROM periodo 
            WHERE DATE_SUB(fechaInicio, INTERVAL 15 DAY) <= CURDATE() 
            AND DATE_ADD(fechaFin, INTERVAL 15 DAY) >= CURDATE()
            ORDER BY fechaInicio DESC
            LIMIT 1
        ");
        $stmtPeriodo->execute();
        $periodoActivo = $stmtPeriodo->fetch(PDO::FETCH_ASSOC);
        
        // Si no hay período activo, mostramos todos los horarios del alumno
        $wherePeriodo = "";
        $params = [$codalumno];
        
        if ($periodoActivo) {
            $wherePeriodo = "AND c.codPeriodo = ?";
            $params[] = $periodoActivo['codPeriodo'];
        }

        $sql = "
            SELECT ah.codalumno, h.dia_semana, 
                   DATE_FORMAT(h.hora_inicio, '%H:%i') AS hora_inicio, 
                   DATE_FORMAT(h.hora_fin, '%H:%i') AS hora_fin, 
                   c.nombrecurso, c.modalidad, c.codcurso 
            FROM alumno_horario ah 
            JOIN horarios_disponibles h ON ah.codhorario = h.codhorario 
            JOIN curso c ON h.codcurso = c.codcurso 
            WHERE ah.codalumno = ? $wherePeriodo
            ORDER BY 
                FIELD(h.dia_semana, 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'),
                h.hora_inicio
        ";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

public function obtenerPeriodosFinalizados() {
    $db = Database::getInstance();
    $conn = $db->getConnection();

    try {
        // Consulta optimizada para traer solo los campos necesarios.
        $stmt = $conn->prepare("SELECT codPeriodo, NombrePeriodo FROM periodo WHERE fechaFin <= CURDATE() ORDER BY fechaFin DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Detalle adicional en el mensaje de error para facilitar la depuración.
        error_log("Error en obtenerPeriodosFinalizados: " . $e->getMessage());
        return [];  // Retorna un array vacío en caso de error.
    }
}



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
    
    public function getPeriodoActivo() {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("
            SELECT p.*, c.cicloNombre 
            FROM periodo p
            JOIN ciclo c ON p.codCiclo = c.codCiclo
            WHERE DATE_SUB(fechaInicio, INTERVAL 15 DAY) <= CURDATE() 
            AND DATE_ADD(fechaFin, INTERVAL 15 DAY) >= CURDATE()
            ORDER BY fechaInicio DESC
            LIMIT 1
        ");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>