<?php
require_once 'models/PagosModel.php'; // Asegúrate de incluir el modelo

class PagosController {
    private $pagosModel;

    public function __construct() {
        $this->pagosModel = new PagosModel(); // Instancia del modelo
    }

    public function mostrarPagos($codalumno) {
        $pagos = $this->pagosModel->obtenerPagos($codalumno); // Obtener los pagos desde el modelo

        // Incluir la vista para mostrar los pagos
        require 'views/PagosView.php';
    }
}
?>
