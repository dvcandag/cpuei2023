<?php
require_once 'models/CarnetAlumnoModel.php';

class CarnetAlumnoController {
    public function mostrarCarnetAlumno($codAlumno) {
        // Crear una instancia del modelo CarnetAlumnoModel
        $carnetAlumnoModel = new CarnetAlumnoModel();

        // Obtener los datos del alumno utilizando el método del modelo
        $alumno = $carnetAlumnoModel->obtenerDatosAlumno($codAlumno);

        // Incluir la vista para mostrar el carnet del alumno
        include 'views/carnet-alumno.php';
    }
}
?>


