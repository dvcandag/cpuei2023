<?php
require_once 'models/CarnetAlumnoModel.php';

class CarnetAlumnoController {

    public function mostrarCarnetAlumno($codalumno) {
        $model = new CarnetAlumnoModel();
        $alumno = $model->obtenerAlumnoPorCodigo($codalumno);

        // Incluir la vista para mostrar el carnet del alumno
        include 'views/carnet-alumno.php';
    }
}
?>
