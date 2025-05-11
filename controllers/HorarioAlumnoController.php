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
            if (isset($clase['codcurso'])) {
                $diasSemana[$clase['dia_semana']][] = $clase;
            }
        }

        // Obtener la duración del período y calcular el progreso
        $progresoPeriodo = [];
        foreach ($horario as $clase) {
            if (isset($clase['codcurso'])) {
                $codcurso = $clase['codcurso'];
                if (!isset($progresoPeriodo[$codcurso])) {
                    $duracion = $horarioModel->getDuracionPeriodo($codcurso);
                    if ($duracion) {
                        $fechaInicio = new DateTime($duracion['fechaInicio']);
                        $fechaFin = new DateTime($duracion['fechaFin']);
                        $fechaActual = new DateTime();

                        // Calcular el progreso del período
                        $diasTotales = $fechaInicio->diff($fechaFin)->days;

                        // Verificar si la fecha actual es posterior a la fecha de fin
                        if ($fechaActual > $fechaFin) {
                            $diasTranscurridos = $diasTotales; // El período ya terminó
                            $porcentajeProgreso = 100; // Progreso completo
                        }
                        // Verificar si la fecha actual es anterior a la fecha de inicio
                        elseif ($fechaActual < $fechaInicio) {
                            $diasTranscurridos = 0; // El período no ha comenzado
                            $porcentajeProgreso = 0; // Progreso en 0%
                        }
                        // Calcular el progreso normal
                        else {
                            $diasTranscurridos = $fechaInicio->diff($fechaActual)->days;
                            $porcentajeProgreso = ($diasTranscurridos / $diasTotales) * 100;
                            $porcentajeProgreso = min($porcentajeProgreso, 100); // No superar el 100%
                        }

                        $progresoPeriodo[$codcurso] = [
                            'porcentaje' => $porcentajeProgreso,
                            'diasTranscurridos' => $diasTranscurridos,
                            'diasTotales' => $diasTotales
                        ];
                    }
                }
            }
        }

        // Pasar el horario y el progreso a la vista
        $_SESSION['horario'] = $diasSemana;
        $_SESSION['progresoPeriodo'] = $progresoPeriodo;

        include "views/HorarioAlumnoView.php";
    }
}
?>