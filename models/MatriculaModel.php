<?php
require_once 'config/database.php';

class MatriculaModel {

    // Obtener las fechas de matrícula desde la tabla periodo
    public function getFechasMatricula($codPeriodo) {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        try {
            $stmt = $conn->prepare("
                SELECT fecha_inicio_matricula, fecha_fin_matricula
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

    // Validar matrícula solo si está dentro del rango permitido
    public function isMatriculaActiva($codPeriodo) {
        $fechasMatricula = $this->getFechasMatricula($codPeriodo);
        if (!$fechasMatricula) {
            error_log("No se encontraron fechas de matrícula para codPeriodo: $codPeriodo");
            return false;
        }

        $fechaActual = date('Y-m-d');
        $inicioMatricula = $fechasMatricula['fecha_inicio_matricula'];
        $finMatricula = $fechasMatricula['fecha_fin_matricula'];

        // Validar que las fechas no estén vacías
        if (empty($inicioMatricula) || empty($finMatricula)) {
            error_log("Fechas de matrícula vacías para codPeriodo: $codPeriodo");
            return false;
        }

        // Convertir a timestamp para comparación
        $fechaActualTs = strtotime($fechaActual);
        $inicioTs = strtotime($inicioMatricula);
        $finTs = strtotime($finMatricula);

        return ($fechaActualTs >= $inicioTs && $fechaActualTs <= $finTs);
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

    // Registra un solo curso (uso interno o individual)
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

            // Obtener horarios disponibles del curso
            $stmtHorarios = $conn->prepare("
                SELECT codhorario 
                FROM horarios_disponibles 
                WHERE codcurso = ?
            ");
            $stmtHorarios->execute([$codcurso]);
            $horarios = $stmtHorarios->fetchAll(PDO::FETCH_ASSOC);

            if (empty($horarios)) {
                throw new Exception("No hay horarios disponibles para este curso");
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

            $codmatricula = $conn->lastInsertId();

            // Asignar horarios al alumno
            foreach ($horarios as $horario) {
                $stmtAlumnoHorario = $conn->prepare("
                    INSERT INTO alumno_horario (codalumno, codhorario) 
                    VALUES (?, ?)
                    ON DUPLICATE KEY UPDATE codhorario = codhorario
                ");
                $stmtAlumnoHorario->execute([$codalumno, $horario['codhorario']]);
            }

            // Insertar en nota
            $stmtNota = $conn->prepare("
                INSERT INTO nota (codmatricula) VALUES (?)
            ");
            $stmtNota->execute([$codmatricula]);

            // Insertar en pagos
            $stmtPago = $conn->prepare("
                INSERT INTO pagos (codmatricula) VALUES (?)
            ");
            $stmtPago->execute([$codmatricula]);

            return true;

        } catch (PDOException $e) {
            error_log("Error en registrarCursoIndividual: " . $e->getMessage());
            return false;
        } catch (Exception $e) {
            error_log("Error general en registrarCursoIndividual: " . $e->getMessage());
            return false;
        }
    }

    // Registra varios cursos (transacción completa)
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

    // Obtener periodos con matrícula activa (fecha_fin_matricula igual o posterior a hoy)
    // Obtener periodos con matrícula activa (dentro del rango de fechas)
public function obtenerPeriodos() {
    $db = Database::getInstance();
    $conn = $db->getConnection();

    try {
        $stmt = $conn->prepare("
            SELECT codPeriodo, NombrePeriodo, fecha_inicio_matricula, fecha_fin_matricula
            FROM periodo
            WHERE CURDATE() BETWEEN fecha_inicio_matricula AND fecha_fin_matricula
            ORDER BY fecha_inicio_matricula ASC
        ");
        $stmt->execute();
        
        // La consulta ya devuelve solo los periodos válidos,
        // por lo que no es necesario un filtro adicional con array_filter.
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    } catch (PDOException $e) {
        error_log("Error en obtenerPeriodos: " . $e->getMessage());
        return [];
    }
}
}