<?php
require_once 'models/HorarioAlumnoModel.php';
require_once 'models/PeriodosFinalizadosModel.php';  // Asegúrate de incluir este archivo

class HorarioAlumnoController {

    // Muestra el horario del alumno
    public function mostrarHorario() {
        // Verificar si el usuario está logueado, de lo contrario redirigir al login
        if (!isset($_SESSION["username"])) {
            header("Location: index.php?action=showLoginForm");
            exit;
        }

        // Obtener el código de alumno desde la sesión
        $codalumno = $_SESSION["codalumno"];
        
        // Instanciar el modelo para trabajar con los periodos finalizados
        $periodosModel = new PeriodosFinalizadosModel();

        // Obtener los periodos finalizados desde el modelo
        $periodos = $periodosModel->obtenerPeriodosFinalizados();

        // Obtener el periodo seleccionado si se pasa en la URL o POST
        $codPeriodo = $_GET['codPeriodo'] ?? $_POST['codPeriodo'] ?? null;

        // Crear instancia del modelo HorarioAlumno
        $horarioModel = new HorarioAlumnoModel();

        // Obtener el horario del alumno
        $horario = $horarioModel->getHorarioByCodalumno($codalumno, $codPeriodo);

        // Si no hay horarios, se puede devolver un mensaje o redirigir
        if (!$horario) {
            $_SESSION['error'] = "No se encontraron horarios para este alumno.";
            header("Location: index.php?action=showError");
            exit;
        }

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

        // Calcular progreso del periodo (si existe)
        $progresoPeriodo = [];
        foreach ($horario as $clase) {
            if (isset($clase['codcurso'])) {
                $codcurso = $clase['codcurso'];
                
                if (!isset($progresoPeriodo[$codcurso])) {
                    // Obtener la duración del curso para calcular el progreso
                    $duracion = $horarioModel->getDuracionPeriodo($codcurso);
                    
                    if (!$duracion) {
                        continue;
                    }

                    $fechaInicio = new DateTime($duracion['fechaInicio']);
                    $fechaFin = new DateTime($duracion['fechaFin']);
                    $fechaActual = new DateTime();

                    $diasTotales = $fechaInicio->diff($fechaFin)->days;

                    // Verificar el progreso
                    if ($fechaActual > $fechaFin) {
                        $diasTranscurridos = $diasTotales;
                        $porcentajeProgreso = 100;
                    } elseif ($fechaActual < $fechaInicio) {
                        $diasTranscurridos = 0;
                        $porcentajeProgreso = 0;
                    } else {
                        $diasTranscurridos = $fechaInicio->diff($fechaActual)->days;
                        $porcentajeProgreso = ($diasTranscurridos / $diasTotales) * 100;
                        $porcentajeProgreso = min($porcentajeProgreso, 100);
                    }

                    $progresoPeriodo[$codcurso] = [
                        'porcentaje' => $porcentajeProgreso,
                        'diasTranscurridos' => $diasTranscurridos,
                        'diasTotales' => $diasTotales
                    ];
                }
            }
        }

        // Pasar los datos a la sesión para ser usados en la vista
        $_SESSION['horario'] = $diasSemana;
        $_SESSION['progresoPeriodo'] = $progresoPeriodo;
        $_SESSION['periodos'] = $periodos;  // Guardamos los periodos en la sesión

        // Incluir la vista del horario del alumno
        include "views/HorarioAlumnoView.php";
    }
}
