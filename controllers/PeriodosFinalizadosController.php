<?php 
require_once 'models/PeriodosFinalizadosModel.php';

class PeriodosFinalizadosController {

    public function mostrarVistaPeriodosFinalizados() {
    session_start();
    if (!isset($_SESSION["username"]) || !isset($_SESSION['codalumno'])) {
        header("Location: index.php?action=showLoginForm");
        exit;
    }

    $model = new PeriodosFinalizadosModel();
    $periodos = $model->obtenerPeriodosFinalizados();
    $codPeriodo = $_GET['codPeriodo'] ?? null;
    
    $cursos = [];
    $evaluaciones = [];
    $horarios = [];
    $datosResumen = [];
    $aulaAlumno = []; // Variable para almacenar los datos del aula

    if ($codPeriodo) {
        $codalumno = $_SESSION['codalumno'];
        $cursos = $model->obtenerCursosPorPeriodo($codPeriodo, $codalumno);
        
        // Obtener información del aula del alumno
        $aulaAlumno = $model->obtenerAulaAlumno($codalumno);
        
        // Agrupar cursos por código para evitar duplicados
        $cursosUnicos = [];
        foreach ($cursos as $curso) {
            if (!isset($cursosUnicos[$curso['codcurso']])) {
                $cursosUnicos[$curso['codcurso']] = $curso;
                $evaluaciones[$curso['codcurso']] = $model->obtenerEvaluacionesPorCurso(
                    $curso['codcurso'], 
                    $codalumno
                );
                $horarios[$curso['codcurso']] = $model->obtenerHorariosPorCurso($curso['codcurso']);
            }
        }
        $cursos = array_values($cursosUnicos);
        
        $datosResumen = $model->obtenerResumenCiclo($codPeriodo, $codalumno);
    }

    include "views/PeriodosFinalizadosView.php";
}
}


?>