

<!-- Incluye Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<link rel="stylesheet" type="text/css" href="../public/assets/css/styles_global.css">

<link rel="stylesheet" type="text/css" href="../public/assets/css/styles_periodos_finalizados.css">



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
            <select id="seleccion-curso" name="codPeriodo">
                <option value="" disabled <?= !isset($_POST['codPeriodo']) ? 'selected' : '' ?> hidden>Seleccione periodo</option>
                <?php foreach ($periodos as $periodo): ?>
                    <option value="<?= htmlspecialchars($periodo['codPeriodo']) ?>" 
                        <?= (isset($_POST['codPeriodo']) && $_POST['codPeriodo'] == $periodo['codPeriodo']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($periodo['NombrePeriodo']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </form>
</div>
    




    <div class="resumen-general">
    <header class="resumen-header">
        <span>Resumen general del ciclo</span>
    </header>
    <div class="resumen-contenido">
        <div class="resumen-indicador">
            <div class="resumen-etiqueta">Campus:</div>
            <div class="resumen-dato">Lima Norte</div>
        </div>
        <div class="resumen-indicador">
            <div class="resumen-etiqueta">Cursos matriculados:</div>
            <div class="resumen-dato">01</div>
        </div>
        <div class="resumen-indicador">
            <div class="resumen-etiqueta">Ciclo relativo:</div>
            <div class="resumen-dato">10</div>
        </div>
        
        <div class="resumen-indicador">
            <div class="resumen-etiqueta">Horas semanales:</div>
            <div class="resumen-dato">4</div>
        </div>
        <div class="resumen-indicador">
            <div class="resumen-etiqueta">Cantidad de créditos:</div>
            <div class="resumen-dato">21</div>
        </div>
        <div class="resumen-indicador">
            <div class="resumen-etiqueta">Orden de mérito:</div>
            <div class="resumen-dato">10</div>
        </div>
        
    </div>
</div>



<div class="curso-detalle">
    <div class="curso-header" onclick="AlternarContenido(this)">
        <h3>Taller de investigación - sistemas (1SI95)</h3>
        <p class="estado-curso">Aprobado | Promedio: 17</p>
        <button type="button" class="toggle-button">
            <i class="fas fa-chevron-down"></i>
        </button>
    </div>
    
    <div class="curso-content">
        <div class="docente-info">
    <h4>Docente:</h4>
    <div class="docente-nombres">
        <p>Alejandria Vallejos, Patricia Abigail</p>
    </div>
</div>


        
        <div class="modalidad-curso">
            <h4>Modalidad de curso:</h4>
            <p>Virtual en vivo</p>
        </div>
        
        <div class="horario">
            <h4>Horario:</h4>
            <p>Lunes: 18:30 - 20:00</p>
            <p>Miércoles: 18:30 - 20:00</p>
        </div>
        
        <div class="creditos">
            <p>Horas semanales: 4.0</p>
            <p>Créditos: 4.00</p>
            <p>Nro vez: 1</p>
            <p>Sección: 50404</p>
        </div>
        
        <div class="evaluaciones">
    <h4>Evaluaciones:</h4>
    <div class="evaluacion">
        <span>Avance de proyecto final 1 (APF1):</span>
        <span class="valor-notas">15</span>
    </div>
    <div class="evaluacion">
        <span>Avance de proyecto final 2 (APF2):</span>
        <span class="valor-notas">15</span>
    </div>
    <div class="evaluacion">
        <span>Avance de proyecto final 3 (APF3):</span>
        <span class="valor-notas">15</span>
    </div>
    <div class="evaluacion">
        <span>Participación en clase (PA):</span>
        <span class="valor-notas">18</span>
    </div>
    <div class="evaluacion">
        <span>Proyecto final (PROY):</span>
        <span class="valor-notas">20</span>
    </div>
</div>

        
        <div class="formula">
            <h4>Fórmula:</h4>
            <p>10%*[APF1] + 20%*[APF2] + 20%*[APF3] + 10%*[PA] + 40%*[PROY]</p>
        </div>
        
        <div class="calificaion-final">
            <p><strong>Promedio:</strong> 17</p>
            <p class="estado-final">Aprobado</p>
        </div>
    </div>
</div>


    <script src="../public/assets/js/script_AlternarContenido.js"></script>

        <script src="../public/assets/js/script_mostrar_periodos_finalizados.js"></script>

