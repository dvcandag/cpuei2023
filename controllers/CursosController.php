<?php
require_once 'models/CursosModel.php';

class CursosController {
    private $model;

    public function __construct() {
        $this->model = new CursosModel();
    }

    public function mostrarCursosMatriculados() {
        if (isset($_SESSION['codalumno'])) {
            $codalumno = $_SESSION['codalumno'];
            $cursos = $this->model->obtenerCursosMatriculados($codalumno);
            require_once 'views/CursosMatriculadosView.php';
        } else {
            echo "Por favor, inicia sesión para ver tus cursos matriculados.";
        }
    }
}
?>
