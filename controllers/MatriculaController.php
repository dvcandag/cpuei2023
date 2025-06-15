<?php
require_once 'models/MatriculaModel.php';

class MatriculaController {

    public function mostrarFormularioMatricula() {
        if (!isset($_SESSION["username"])) {
            header("Location: index.php?action=showLoginForm");
            exit;
        }

        if (!isset($_SESSION["codalumno"])) {
            echo "Error: No se ha identificado al alumno correctamente.";
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
            echo "Error: No se ha seleccionado un período válido.";
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

        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['cursos']) || !isset($_SESSION['codPeriodo'])) {
            $_SESSION['error'] = "Datos de matrícula incompletos";
            header("Location: index.php?action=mostrarMatricula");
            exit;
        }

        $cursos = $_POST['cursos'];
        $codPeriodo = $_SESSION['codPeriodo'];
        $codalumno = $_SESSION["codalumno"];
        $matriculaModel = new MatriculaModel();

        if (!$matriculaModel->isMatriculaActiva($codPeriodo)) {
            $_SESSION['error'] = "El período de matrícula no está activo";
            header("Location: index.php?action=mostrarMatricula");
            exit;
        }

        if ($matriculaModel->registrarVariosCursos($cursos, $codalumno, $codPeriodo)) {
            $_SESSION['success'] = "Matrícula registrada exitosamente";
        } else {
            $_SESSION['error'] = "Error al registrar la matrícula";
        }

        header("Location: index.php");
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
?>
