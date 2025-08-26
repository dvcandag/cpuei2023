<?php
require_once 'models/MatriculaModel.php';

class MatriculaController {

    public function mostrarFormularioMatricula() {
        if (!isset($_SESSION["username"])) {
            header("Location: index.php?action=showLoginForm");
            exit;
        }

        if (!isset($_SESSION["codalumno"])) {
            //echo "Error: No se ha identificado al alumno correctamente.";
            exit;
        }

        $codPeriodo = $_POST["codPeriodo"] ?? $_GET["codPeriodo"] ?? null;
        $codalumno = $_SESSION["codalumno"];
        $matriculaModel = new MatriculaModel();

        $cursosDisponibles = $codPeriodo ? $matriculaModel->getCursosDisponibles($codPeriodo) : [];
        $cursosDesaprobados = $matriculaModel->getCursosDesaprobados($codalumno);
        $cursosParaMatricula = array_merge($cursosDisponibles, $cursosDesaprobados);
        $periodos = $matriculaModel->obtenerPeriodos();

        $_SESSION['cursosParaMatricula'] = $cursosParaMatricula;
        $_SESSION['cursosDesaprobados'] = $cursosDesaprobados;
        $_SESSION['codPeriodo'] = $codPeriodo;
        $_SESSION['periodos'] = $periodos;

        include "views/MatriculaView.php";
    }

    public function seleccionarPeriodo() {
        if (!isset($_SESSION["username"])) {
            header("Location: index.php?action=showLoginForm");
            exit;
        }

        $codPeriodo = $_POST["codPeriodo"] ?? $_GET["codPeriodo"] ?? null;

        if (!$codPeriodo) {
            //echo "Error: No se ha seleccionado un período válido.";
            exit;
        }

        header("Location: index.php?action=mostrarMatricula&codPeriodo=$codPeriodo");
        exit;
    }

    public function guardarMatricula() {
    if (!isset($_SESSION["username"])) {
        header("Location: index.php?action=showLoginForm");
        exit;
    }

    if (!isset($_SESSION["codalumno"])) {
        //echo "Error: No se ha identificado al alumno correctamente.";
        exit;
    }

    $codalumno = $_SESSION["codalumno"];
    $codPeriodo = $_POST["codPeriodo"] ?? $_SESSION["codPeriodo"] ?? null;
    $cursosSeleccionados = $_POST["cursos"] ?? [];

    if (!$codPeriodo || empty($cursosSeleccionados)) {
        $_SESSION['error'] = "Debes seleccionar al menos un curso del período a cursar.";
        header("Location: index.php?action=mostrarMatricula&codPeriodo=$codPeriodo");
        exit;
    }

    $matriculaModel = new MatriculaModel();

    // Verificar fechas de matrícula
    $fechasMatricula = $matriculaModel->getFechasMatricula($codPeriodo);
    if (!$fechasMatricula) {
        $_SESSION['error'] = "No se encontró información del período seleccionado.";
        header("Location: index.php?action=mostrarMatricula&codPeriodo=$codPeriodo");
        exit;
    }

    $fechaActual = date('Y-m-d');
    if ($fechaActual < $fechasMatricula['fecha_inicio_matricula']) {
        $_SESSION['error'] = "El período de matrícula comienza el " . date('d/m/Y', strtotime($fechasMatricula['fecha_inicio_matricula']));
        header("Location: index.php?action=mostrarMatricula&codPeriodo=$codPeriodo");
        exit;
    }
    
    // Validar límite de cursos
    if (count($cursosSeleccionados) > 6) { // Ejemplo: máximo 6 cursos
        $_SESSION['error'] = "No puedes matricular más de 6 cursos por período.";
        header("Location: index.php?action=mostrarMatricula&codPeriodo=$codPeriodo");
        exit;
    }

    // Registra los cursos
    $resultado = $matriculaModel->registrarVariosCursos($cursosSeleccionados, $codalumno, $codPeriodo);

    if ($resultado) {
        $_SESSION['success'] = "Matrícula registrada correctamente.";
    } else {
        $_SESSION['error'] = "Error al registrar la matrícula. Por favor, inténtalo nuevamente.";
    }

    header("Location: index.php?action=mostrarMatricula&codPeriodo=$codPeriodo");
    exit;
}

    public function obtenerCursosPorPeriodo() {
        if (!isset($_SESSION["username"])) {
            header("Location: index.php?action=showLoginForm");
            exit;
        }

        $codPeriodo = $_GET['codPeriodo'] ?? null;
        if (!$codPeriodo) {
            echo json_encode([]);
            exit;
        }

        $codalumno = $_SESSION["codalumno"];
        $matriculaModel = new MatriculaModel();

        $cursosDesaprobados = $matriculaModel->getCursosDesaprobados($codalumno);
        $cursosDisponibles = $matriculaModel->getCursosDisponibles($codPeriodo);

        $cursos = [];
        foreach ($cursosDesaprobados as $curso) {
            $curso['estado'] = 'desaprobado';
            $cursos[] = $curso;
        }
        foreach ($cursosDisponibles as $curso) {
            $curso['estado'] = 'disponible';
            $cursos[] = $curso;
        }

        header('Content-Type: application/json');
        echo json_encode($cursos);
        exit;
    }
}