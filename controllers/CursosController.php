<?php
require_once 'models/CursosModel.php';

class CursosController {
    public function mostrarCursosMatriculados($codalumno) {
        // Crear una instancia del modelo CursosModel
        $cursosModel = new CursosModel();

        // Obtener los cursos matriculados del alumno utilizando el modelo
        $cursosMatriculados = $cursosModel->obtenerCursosMatriculados($codalumno);

        // Retornar los cursos matriculados
        return $cursosMatriculados;
    }
}
?>
