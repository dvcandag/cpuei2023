<?php
require_once 'config/database.php';

class MatriculaModel {
    // Obtener las fechas de matrícula desde la base de datos
    public function getFechasMatricula($codPeriodo) {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("
            SELECT fechaInicio, fechaFin 
            FROM periodo 
            WHERE codPeriodo = ?
        ");
        $stmt->execute([$codPeriodo]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Verificar si la matrícula está activa
    public function isMatriculaActiva($codPeriodo) {
        $fechasMatricula = $this->getFechasMatricula($codPeriodo);
        if (!$fechasMatricula) {
            return false; // No hay fechas definidas
        }

        $fechaActual = date('Y-m-d');
        $fechaInicio = $fechasMatricula['fechaInicio'];
        $fechaFin = $fechasMatricula['fechaFin'];

        return ($fechaActual >= $fechaInicio && $fechaActual <= $fechaFin);
    }

    // Obtener cursos disponibles para un período
    public function getCursosDisponibles($codPeriodo) {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("
            SELECT codcurso, nombrecurso 
            FROM curso 
            WHERE codPeriodo = ? AND estado = 'activo'
        ");
        $stmt->execute([$codPeriodo]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener cursos desaprobados por un alumno
    public function getCursosDesaprobados($codAlumno) {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("
            SELECT c.codcurso, c.nombrecurso 
            FROM nota n
            JOIN matricula m ON n.codmatricula = m.codmatricula
            JOIN curso c ON m.codcurso = c.codcurso
            WHERE m.codalumno = ? AND n.promedio < 10.5
        ");
        $stmt->execute([$codAlumno]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Registrar una matrícula
    public function registrarMatricula($codalumno, $codcurso, $codPeriodo, $fechaMatricula) {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("
            INSERT INTO matricula (codalumno, codcurso, codPeriodo, fechamatricula)
            VALUES (?, ?, ?, ?)
        ");
        $stmt->execute([$codalumno, $codcurso, $codPeriodo, $fechaMatricula]);
    }

    // Obtener todos los períodos disponibles
    public function obtenerPeriodos() {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("
            SELECT codPeriodo, NombrePeriodo 
            FROM periodo
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }





    
}
?>