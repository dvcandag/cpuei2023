<?php
require_once 'config/database.php';

class MatriculaModel {

    // Obtener las fechas de matrícula desde la base de datos
    public function getFechasMatricula($codPeriodo) {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        try {
            $stmt = $conn->prepare("
                SELECT fechaInicio, fechaFin 
                FROM periodo 
                WHERE codPeriodo = ?
            ");
            $stmt->execute([$codPeriodo]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en getFechasMatricula: " . $e->getMessage());
            return false;
        }
    }

    // Verificar si la matrícula está activa
    public function isMatriculaActiva($codPeriodo) {
        $fechasMatricula = $this->getFechasMatricula($codPeriodo);
        if (!$fechasMatricula) {
            return false;
        }

        $fechaActual = date('Y-m-d');
        return ($fechaActual >= $fechasMatricula['fechaInicio'] && 
                $fechaActual <= $fechasMatricula['fechaFin']);
    }

    // Obtener cursos disponibles para un período
    public function getCursosDisponibles($codPeriodo) {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        try {
            $stmt = $conn->prepare("
                SELECT codcurso, nombrecurso 
                FROM curso 
                WHERE codPeriodo = ? AND estado = 'activo'
            ");
            $stmt->execute([$codPeriodo]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en getCursosDisponibles: " . $e->getMessage());
            return [];
        }
    }

    // Obtener cursos desaprobados por un alumno
    public function getCursosDesaprobados($codAlumno) {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        try {
            $stmt = $conn->prepare("
                SELECT c.codcurso, c.nombrecurso 
                FROM nota n
                JOIN matricula m ON n.codmatricula = m.codmatricula
                JOIN curso c ON m.codcurso = c.codcurso
                WHERE m.codalumno = ? AND n.promedio < 10.5
            ");
            $stmt->execute([$codAlumno]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en getCursosDesaprobados: " . $e->getMessage());
            return [];
        }
    }

    // ✅ Registra un solo curso (uso interno o individual)
    public function registrarCursoIndividual(string $codalumno, string $codcurso, int $codPeriodo): bool {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        try {
            // Obtener información del curso
            $stmtCurso = $conn->prepare("
                SELECT codprofesor, modalidad 
                FROM curso 
                WHERE codcurso = ?
            ");
            $stmtCurso->execute([$codcurso]);
            $curso = $stmtCurso->fetch(PDO::FETCH_ASSOC);

            if (!$curso) {
                throw new Exception("Curso no encontrado");
            }

            // Verificar si hay horarios disponibles
            $stmtHorarios = $conn->prepare("
                SELECT codhorario 
                FROM horarios_disponibles 
                WHERE codcurso = ?
            ");
            $stmtHorarios->execute([$codcurso]);
            $horarios = $stmtHorarios->fetchAll(PDO::FETCH_ASSOC);

            if (empty($horarios)) {
                return false; // No hay horarios disponibles
            }

            // Insertar en matrícula
            $stmt = $conn->prepare("
                INSERT INTO matricula 
                (codprofesor, codalumno, codcurso, modalidad, fecha_de_matricula, codPeriodo)
                VALUES (?, ?, ?, ?, ?, ?)
            ");
            $stmt->execute([
                $curso['codprofesor'],
                $codalumno,
                $codcurso,
                $curso['modalidad'],
                date('Y-m-d'),
                $codPeriodo
            ]);

            // Insertar horarios del alumno
            foreach ($horarios as $horario) {
                $stmtAlumnoHorario = $conn->prepare("
                    INSERT INTO alumno_horario (codalumno, codhorario) 
                    VALUES (?, ?)
                    ON DUPLICATE KEY UPDATE codhorario = codhorario
                ");
                $stmtAlumnoHorario->execute([$codalumno, $horario['codhorario']]);
            }

            return true;

        } catch (PDOException $e) {
            error_log("Error en registrarCursoIndividual: " . $e->getMessage());
            return false;
        } catch (Exception $e) {
            error_log("Error general en registrarCursoIndividual: " . $e->getMessage());
            return false;
        }
    }

    // ✅ Registra varios cursos (transacción completa)
    public function registrarVariosCursos(array $cursos, string $codalumno, int $codPeriodo): bool {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        try {
            $conn->beginTransaction();

            foreach ($cursos as $codcurso) {
                if (!$this->registrarCursoIndividual($codalumno, $codcurso, $codPeriodo)) {
                    throw new Exception("Error al registrar curso $codcurso");
                }
            }

            $conn->commit();
            return true;

        } catch (Exception $e) {
            if ($conn->inTransaction()) {
                $conn->rollBack();
            }
            error_log("Error en registrarVariosCursos: " . $e->getMessage());
            return false;
        }
    }

    // Obtener todos los períodos disponibles
    public function obtenerPeriodos() {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        try {
            $stmt = $conn->prepare("
                SELECT codPeriodo, NombrePeriodo 
                FROM periodo
            ");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en obtenerPeriodos: " . $e->getMessage());
            return [];
        }
    }
}
?>
