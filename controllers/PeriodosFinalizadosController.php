<?php
require_once 'models/PeriodosFinalizadosModel.php';

class PeriodosFinalizadosController {

    public function mostrarVistaPeriodosFinalizados() {
        if (!isset($_SESSION["username"])) {
            header("Location: index.php?action=showLoginForm");
            exit;
        }

        $model = new PeriodosFinalizadosModel();
        $periodos = $model->obtenerPeriodosFinalizados();

        // Si se envió un período específico por GET
        $codPeriodo = $_GET['codPeriodo'] ?? null;
        
        if ($codPeriodo) {
            // Aquí puedes cargar datos específicos del período si es necesario
            $datosPeriodo = []; // Obtener datos del modelo
        }

        include "views/PeriodosFinalizadosView.php";
    }
}
?>

