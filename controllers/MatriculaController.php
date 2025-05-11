<?php
require_once 'models/MatriculaModel.php';

class MatriculaController {
    public function mostrarFormularioMatricula() {
        // Verificar si el usuario está autenticado
        if (!isset($_SESSION["username"])) {
            header("Location: index.php?action=showLoginForm");
            exit;
        }

        // Verificar si 'codalumno' está definido en la sesión
        if (!isset($_SESSION["codalumno"])) {
            echo "Error: No se ha identificado al alumno correctamente.";
            exit;
        }

        // Obtener el código del período desde el formulario
        $codPeriodo = $_POST["codPeriodo"] ?? $_GET["codPeriodo"] ?? null;

        $codalumno = $_SESSION["codalumno"];
        $matriculaModel = new MatriculaModel();

        // Obtener cursos disponibles para el período seleccionado
        $cursosDisponibles = $codPeriodo ? $matriculaModel->getCursosDisponibles($codPeriodo) : [];

        // Obtener cursos desaprobados
        $cursosDesaprobados = $matriculaModel->getCursosDesaprobados($codalumno);

        // Combinar cursos disponibles y desaprobados
        $cursosParaMatricula = array_merge($cursosDisponibles, $cursosDesaprobados);

        // Obtener todos los períodos disponibles
        $periodos = $matriculaModel->obtenerPeriodos();

        // Pasar datos a la vista
        $_SESSION['cursosParaMatricula'] = $cursosParaMatricula;
        $_SESSION['cursosDesaprobados'] = $cursosDesaprobados;
        $_SESSION['codPeriodo'] = $codPeriodo;
        $_SESSION['periodos'] = $periodos;

        include "views/MatriculaView.php";
    }

    public function seleccionarPeriodo() {
        // Verificar si el usuario está autenticado
        if (!isset($_SESSION["username"])) {
            header("Location: index.php?action=showLoginForm");
            exit;
        }

        // Obtener el código del período desde el formulario
        $codPeriodo = $_POST["codPeriodo"] ?? $_GET["codPeriodo"] ?? null;

        if (!$codPeriodo) {
            echo "Error: No se ha seleccionado un período válido.";
            exit;
        }

        // Redirigir a la acción mostrarMatricula con el período seleccionado
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
        echo json_encode([]); // Devuelve un array vacío si no hay código de período
        exit;
    }

    $codalumno = $_SESSION["codalumno"];
    $matriculaModel = new MatriculaModel();

    // Obtener cursos desaprobados
    $cursosDesaprobados = $matriculaModel->getCursosDesaprobados($codalumno);

    // Obtener cursos disponibles para el período seleccionado
    $cursosDisponibles = $matriculaModel->getCursosDisponibles($codPeriodo);

    // Combinar los resultados y agregar un campo "estado"
    $cursos = [];
    foreach ($cursosDesaprobados as $curso) {
        $curso['estado'] = 'desaprobado';
        $cursos[] = $curso;
    }
    foreach ($cursosDisponibles as $curso) {
        $curso['estado'] = 'disponible';
        $cursos[] = $curso;
    }

    header('Content-Type: application/json'); // Establece el tipo de contenido como JSON
    echo json_encode($cursos); // Devuelve los cursos en formato JSON
    exit;
}
}
?>