<!-- Incluye Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<link rel="stylesheet" type="text/css" href="../public/assets/css/styles_global.css">

<link rel="stylesheet" type="text/css" href="../public/assets/css/styles_periodos_finalizados.css">

<?php
// Esta línea captura el periodo seleccionado, ya sea por GET o POST
$codPeriodoSeleccionado = $_GET['codPeriodo'] ?? $_POST['codPeriodo'] ?? null;
?>


<div class="container-notas">
     <div class="palabra-atras">
    <a href="dashboard.php" class="enlace-retroceso">
        <i class="fas fa-arrow-left"></i>
        <span class="text">Atrás</span>
    </a>
</div>


<!-- Formulario para seleccionar el periodo -->
<div class="mis-cursos"></div>
        <h5>Mis cursos</h5>
        <p>Periodo:</p>
   <div class="contenedor-seleccion">
    <form method="POST" id="form-periodo">
        <div class="container-periodo">
            <select id="seleccion-periodo" name="codPeriodo" class="seleccion-periodo">
                <option value="" disabled <?= !$codPeriodoSeleccionado ? 'selected' : '' ?> hidden>Seleccione periodo</option>
                <?php foreach ($periodos as $periodo): ?>
                    <option value="<?= htmlspecialchars($periodo['codPeriodo']) ?>"
                        <?= ($codPeriodoSeleccionado == $periodo['codPeriodo']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($periodo['NombrePeriodo']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </form>
</div>

     
<!-- Resumen General Completo -->
<div id="contenedor-resumen" class="resumen-general">
    <header class="resumen-header">
        <span>Resumen general del ciclo</span>
    </header>
    <div class="resumen-contenido">
        <div class="resumen-indicador">
            <div class="resumen-etiqueta">Campus:</div>
            <div class="resumen-dato"><?= htmlspecialchars($datosResumen['campus'] ?? 'No disponible') ?></div>
        </div>
        <div class="resumen-indicador">
            <div class="resumen-etiqueta">Cursos matriculados:</div>
            <div class="resumen-dato"><?= htmlspecialchars($datosResumen['cursos_matriculados'] ?? '0') ?></div>
        </div>
        <div class="resumen-indicador">
            <div class="resumen-etiqueta">Ciclo relativo:</div>
            <div class="resumen-dato"><?= htmlspecialchars($datosResumen['ciclo_relativo'] ?? 'No disponible') ?></div>
        </div>
        <div class="resumen-indicador">
            <div class="resumen-etiqueta">Horas semanales:</div>
            <div class="resumen-dato"><?= htmlspecialchars($datosResumen['horas_semanales'] ?? '0') ?></div>
        </div>
        <div class="resumen-indicador">
            <div class="resumen-etiqueta">Créditos:</div>
            <div class="resumen-dato"><?= htmlspecialchars($datosResumen['cantidad_creditos'] ?? '0') ?></div>
        </div>
        <div class="resumen-indicador">
            <div class="resumen-etiqueta">Orden de mérito:</div>
            <div class="resumen-dato">
                <?php if(isset($datosResumen['orden_merito']) && $datosResumen['orden_merito'] !== 'No disponible'): ?>
                    Top <?= htmlspecialchars($datosResumen['orden_merito']) ?> 
                    <small>(según promedio ponderado)</small>
                <?php else: ?>
                    No disponible
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- toggle-button para visualizar detalless del curso -->
   <?php if (!empty($cursos)): ?>
    <?php foreach ($cursos as $curso): ?>
        <div class="curso-detalle">
            <div class="curso-header" onclick="AlternarContenido(this)">
                <h3><?= htmlspecialchars($curso['nombrecurso']); ?> (<?= htmlspecialchars($curso['codcurso']); ?>)</h3>
                

                <p class="estado-curso">Promedio: <?= isset($evaluaciones[$curso['codcurso']]['promedio']) ? htmlspecialchars($evaluaciones[$curso['codcurso']]['promedio']) : 'No disponible'; ?></p>


                <button type="button" class="toggle-button">
                    <i class="fas fa-chevron-down"></i>
                </button>
            </div>
            
            <div class="curso-content">
                <!-- Docente Info -->
                <div class="docente-info">
                    <h4>Docente:</h4>
                    <div class="docente-nombres">
                        <p><?= htmlspecialchars($curso['nombre_completo']); ?></p>
                    </div>
                </div>
                
                <!-- Modalidad de curso -->
                <div class="modalidad-curso">
                    <h4>Modalidad de curso:</h4>
                    <p><?= htmlspecialchars($curso['modalidad']); ?></p>
                </div>
                
                <!-- Horarios -->
                <div class="horario">
                    <h4>Horario:</h4>
                    <?php if (isset($horarios[$curso['codcurso']])): ?>
                        <?php foreach ($horarios[$curso['codcurso']] as $horario): ?>
                            <p><?= htmlspecialchars($horario['dia_semana']); ?>: <?= htmlspecialchars($horario['hora_inicio']); ?> - <?= htmlspecialchars($horario['hora_fin']); ?></p>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Debe seleccionar un periodo para ver historial.</p>
                    <?php endif; ?>
                </div>
                
                <!-- Créditos y Aula -->
                <div class="creditos">
                    <p>Hora semanal: <?= htmlspecialchars($curso['hora_semanal']); ?></p>
                    <p>Créditos: <?= htmlspecialchars($curso['creditos']); ?></p>
<p>Aula: <?= isset($aulaAlumno['nombreAula']) ? htmlspecialchars($aulaAlumno['nombreAula']) : 'No asignada' ?></p>
<p>Sede: <?= isset($aulaAlumno['nombreSede']) ? htmlspecialchars($aulaAlumno['nombreSede']) : 'No disponible' ?></p> <!-- Mostramos el nombre de la sede -->
                </div>

                <!-- Evaluaciones -->
                <div class="evaluaciones">
                    <h4>Evaluaciones:</h4>
                    <?php if (isset($evaluaciones[$curso['codcurso']])): ?>
                        <div class="evaluacion">
                            <span>Avance de proyecto final 1 (APF1):</span>
                            <span class="valor-notas"><?= isset($evaluaciones[$curso['codcurso']]['nota1']) ? htmlspecialchars($evaluaciones[$curso['codcurso']]['nota1']) : 'No disponible'; ?></span>
                        </div>
                        <div class="evaluacion">
                            <span>Avance de proyecto final 2 (APF2):</span>
                            <span class="valor-notas"><?= isset($evaluaciones[$curso['codcurso']]['nota2']) ? htmlspecialchars($evaluaciones[$curso['codcurso']]['nota2']) : 'No disponible'; ?></span>
                        </div>
                        <div class="evaluacion">
                            <span>Avance de proyecto final 3 (APF3):</span>
                            <span class="valor-notas"><?= isset($evaluaciones[$curso['codcurso']]['nota3']) ? htmlspecialchars($evaluaciones[$curso['codcurso']]['nota3']) : 'No disponible'; ?></span>
                        </div>
                        
                        <div class="evaluacion">
                            <span>Proyecto final (PROY):</span>
                            <span class="valor-notas"><?= isset($evaluaciones[$curso['codcurso']]['nota_proyecto']) ? htmlspecialchars($evaluaciones[$curso['codcurso']]['nota_proyecto']) : 'NP'; ?></span>
                        </div>

                        <div class="evaluacion">
                            <span>Participación en clase (PA):</span>
                            <span class="valor-notas"><?= isset($evaluaciones[$curso['codcurso']]['nota4']) ? htmlspecialchars($evaluaciones[$curso['codcurso']]['nota4']) : 'No disponible'; ?></span>
                        </div>

                        <div class="evaluacion">
                            <span>Promedio Final (PROFINAL):</span>
                            <span class="valor-notas"><?= isset($evaluaciones[$curso['codcurso']]['promedio']) ? htmlspecialchars($evaluaciones[$curso['codcurso']]['promedio']) : 'No disponible'; ?></span>
                        </div>
                    <?php else: ?>
                        <p>No hay evaluaciones disponibles para este curso.</p>
                    <?php endif; ?>
                </div>

                <!-- Fórmula para calcular el promedio -->
                <div class="formula">
                    <h4>Fórmula de Calificación:</h4>
                    <p>5%*[APF1] + 20%*[APF2] + 20%*[APF3] + 15%*[PA] + 40%*[PROY]</p>

                </div>
                
                <!-- Calificación final -->
                <div class="calificacion-final">
                    <p><strong>Promedio:</strong> <?= isset($evaluaciones[$curso['codcurso']]['promedio']) ? htmlspecialchars($evaluaciones[$curso['codcurso']]['promedio']) : 'No disponible'; ?></p>
                    <p class="estado-final"><?= isset($evaluaciones[$curso['codcurso']]['promedio']) && $evaluaciones[$curso['codcurso']]['promedio'] >= 13 ? 'Aprobado' : 'Desaprobado'; ?></p>
                </div>
            </div>
        </div>

    <?php endforeach; ?>

<?php else: ?>
        <div class="alert alert-info">Debes seleccionar periodo culminado para ver historial.</div>
    <?php endif; ?>




    <script src="../public/assets/js/script_AlternarContenido.js"></script>

        <script src="../public/assets/js/script_mostrar_periodos_finalizados.js"></script>



