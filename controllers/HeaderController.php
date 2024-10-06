<?php
require_once 'models/HeaderModel.php';

class HeaderController {
    private $model;

    public function __construct() {
        $this->model = new HeaderModel();
    }

    public function mostrarDatosAlumno() {
        session_start();
        if (isset($_SESSION['alumno'])) {
            $alumno_id = $_SESSION['alumno']['codalumno'];
            $alumno = $this->model->getAlumnoDatos($alumno_id);
            if ($alumno) {
                $_SESSION["nombre_completo"] = $alumno['nombre_completo']; // Nombre completo
                $alumno['foto'] = $this->obtenerRutaFoto($alumno['dni']);
                return $alumno;
            }
        }
        return null;
    }

   
}
?>