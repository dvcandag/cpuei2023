<?php
require_once 'config/database.php';

class PeriodosFinalizadosModel {
    // Método para obtener los periodos finalizados
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

    // Método para obtener resumen
    public function obtenerResumenCiclo($codPeriodo, $codalumno) {
        $conn = Database::getInstance()->getConnection();
        
        // Consulta principal para los datos del resumen
        $sql = "SELECT  
                s.nombreSede AS campus,
                COUNT(DISTINCT m.codcurso) AS cursos_matriculados,
                ci.cicloNombre AS ciclo_relativo,
                IFNULL(SUM(c.hora_semanal), 0) AS horas_semanales,
                IFNULL(SUM(c.creditos), 0) AS cantidad_creditos,
                (
                    SELECT COUNT(*) + 1 
                    FROM (
                        SELECT AVG(n.nota1*0.05 + n.nota2*0.20 + n.nota3*0.20 + n.nota4*0.15 + n.nota_proyecto*0.40) as promedio
                        FROM nota n
                        JOIN matricula m ON n.codmatricula = m.codmatricula
                        WHERE m.codPeriodo = ?
                        GROUP BY m.codalumno
                        HAVING AVG(n.nota1*0.05 + n.nota2*0.20 + n.nota3*0.20 + n.nota4*0.15 + n.nota_proyecto*0.40) > (
                            SELECT AVG(n2.nota1*0.05 + n2.nota2*0.20 + n2.nota3*0.20 + n2.nota4*0.15 + n2.nota_proyecto*0.40)
                            FROM nota n2
                            JOIN matricula m2 ON n2.codmatricula = m2.codmatricula
                            WHERE m2.codPeriodo = ? AND m2.codalumno = ?
                        )
                    ) AS mejores_promedios
                ) AS orden_merito
            FROM matricula m
            INNER JOIN curso c ON m.codcurso = c.codcurso AND m.codPeriodo = c.codPeriodo
            INNER JOIN periodo p ON m.codPeriodo = p.codPeriodo
            INNER JOIN ciclo ci ON p.codCiclo = ci.codCiclo
            INNER JOIN alumno a ON m.codalumno = a.codalumno
            LEFT JOIN sede s ON a.codSede = s.codSede
            WHERE m.codPeriodo = ? AND m.codalumno = ?
            GROUP BY s.nombreSede, ci.cicloNombre";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute([$codPeriodo, $codPeriodo, $codalumno, $codPeriodo, $codalumno]);
        
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: [
            'campus' => 'No disponible',
            'cursos_matriculados' => 0,
            'ciclo_relativo' => 'No disponible',
            'horas_semanales' => 0,
            'cantidad_creditos' => 0,
            'orden_merito' => 'No disponible'
        ];
    }

    // Método para obtener los cursos por periodo (ACTUALIZADO)
    public function obtenerCursosPorPeriodo($codPeriodo, $codalumno) {
    $db = Database::getInstance();
    $conn = $db->getConnection();

    try {
        $stmt = $conn->prepare("
            SELECT 
                c.codcurso, 
                c.nombrecurso, 
                c.creditos, 
                c.hora_semanal, 
                c.modalidad,
                CONCAT(p.nombreprofesor, ' ', p.apaternoprofesor) AS nombre_completo,
                c.estado AS estado_curso
            FROM 
                matricula m
            JOIN 
                curso c ON m.codcurso = c.codcurso AND m.codPeriodo = c.codPeriodo
            JOIN 
                profesor p ON m.codprofesor = p.codprofesor
            WHERE 
                m.codPeriodo = :codPeriodo 
                AND m.codalumno = :codalumno
            ORDER BY 
                c.nombrecurso
        ");
        $stmt->bindParam(':codPeriodo', $codPeriodo, PDO::PARAM_STR);
        $stmt->bindParam(':codalumno', $codalumno, PDO::PARAM_STR);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error en obtenerCursosPorPeriodo: " . $e->getMessage());
        return [];
    }
}

    // Método para obtener los horarios por curso (ACTUALIZADO para incluir aula)
    public function obtenerHorariosPorCurso($codCurso) {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        try {
            $stmt = $conn->prepare("
                SELECT h.dia_semana, h.turno, h.hora_inicio, h.hora_fin,
                       a.nombreAula, a.tipo AS tipoAula
                FROM horarios_disponibles h
                LEFT JOIN aula_laboratorio a ON h.codAula = a.codAula
                WHERE h.codcurso = :codCurso
            ");
            $stmt->bindParam(':codCurso', $codCurso, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en obtenerHorariosPorCurso: " . $e->getMessage());
            return [];
        }
    }

    // Método para obtener las evaluaciones por curso
    public function obtenerEvaluacionesPorCurso($codCurso, $codalumno) {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        try {
            $stmt = $conn->prepare("
                SELECT n.nota1, n.nota2, n.nota3, n.nota4, n.nota_proyecto 
                FROM nota n
                JOIN matricula m ON n.codmatricula = m.codmatricula
                WHERE m.codcurso = :codCurso AND m.codalumno = :codalumno
            ");
            $stmt->bindParam(':codCurso', $codCurso, PDO::PARAM_STR);
            $stmt->bindParam(':codalumno', $codalumno, PDO::PARAM_STR);
            $stmt->execute();

            $notas = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($notas) {
                $promedio = ($notas['nota1'] * 0.05) + 
                           ($notas['nota2'] * 0.20) + 
                           ($notas['nota3'] * 0.20) + 
                           ($notas['nota4'] * 0.15) + 
                           ($notas['nota_proyecto'] * 0.40);
                return array_merge($notas, ['promedio' => $promedio]);
            }

            return [];
        } catch (PDOException $e) {
            error_log("Error en obtenerEvaluacionesPorCurso: " . $e->getMessage());
            return [];
        }
    }

    // Método para obtener el aula del alumno
    public function obtenerAulaAlumno($codalumno) {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        try {
            $stmt = $conn->prepare("
                SELECT al.nombreAula, al.tipo, s.nombreSede
                FROM alumno a
                LEFT JOIN aula_laboratorio al ON a.codAula = al.codAula
                LEFT JOIN sede s ON a.codSede = s.codSede
                WHERE a.codalumno = :codalumno
            ");
            $stmt->bindParam(':codalumno', $codalumno, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en obtenerAulaAlumno: " . $e->getMessage());
            return null;
        }
    }
}
?>