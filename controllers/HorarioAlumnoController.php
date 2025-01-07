<?php

require_once 'models/HorarioAlumnoModel.php';

class HorarioAlumnoController {
    public function mostrarHorario() {
        if (!isset($_SESSION["username"])) {
            header("Location: index.php?action=showLoginForm");
            exit;
        }

        $codalumno = $_SESSION["codalumno"];
        $horarioModel = new HorarioAlumnoModel();
        $horario = $horarioModel->getHorarioByCodalumno($codalumno);

        // Días de la semana predefinidos
        $diasSemana = [
            'Lunes' => [],
            'Martes' => [],
            'Miércoles' => [],
            'Jueves' => [],
            'Viernes' => [],
            'Sábado' => [],
            'Domingo' => []
        ];

        // Agrupar las clases por día de la semana
        foreach ($horario as $clase) {
            $diasSemana[$clase['dia_semana']][] = $clase;
        }

        // Pasar el horario agrupado a la vista
        $_SESSION['horario'] = $diasSemana;

        include "views/HorarioAlumnoView.php";
    }
}
?>
