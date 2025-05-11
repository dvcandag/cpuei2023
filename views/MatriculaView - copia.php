<?php
if (!isset($_SESSION['username'])) {
    header("Location: index.php?action=showLoginForm");
    exit;
}

// Verificar si los datos de cursos están disponibles
if (!isset($_SESSION['cursosParaMatricula'])) {
    echo "<script>alert('Error cargando cursos'); window.history.back();</script>";
    exit;
}

$cursosParaMatricula = $_SESSION['cursosParaMatricula'];
$cursosDesaprobados = $_SESSION['cursosDesaprobados'];
$codPeriodo = $_SESSION['codPeriodo'] ?? null;

// Separar cursos desaprobados y cursos disponibles
$cursosDisponibles = array_filter($cursosParaMatricula, function($curso) use ($cursosDesaprobados) {
    return !in_array($curso, $cursosDesaprobados);
});
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matrícula del Alumno</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../public/assets/css/styles_global.css">
    <link rel="stylesheet" href="../public/assets/css/styles_matricula.css">
</head>
<body>
    <div class="container-matricula"> 
        <h1>Matrículate</h1>

        <!-- Formulario para seleccionar el periodo -->
        <form method="POST" action="index.php?action=seleccionarPeriodo">
            <div class="container-periodo">
                <select id="seleccionar-lista-periodo" name="codPeriodo" onchange="cargarCursos(this.value)">
                    <option value="" disabled selected>Seleccione periodo</option>
                    <?php foreach ($_SESSION['periodos'] as $periodo): ?>
                        <option value="<?= $periodo['codPeriodo'] ?>" <?= ($codPeriodo == $periodo['codPeriodo']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($periodo['NombrePeriodo']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </form>

        <!-- Div para mostrar los cursos del período seleccionado -->
        <div id="cursos-periodo" class="container-cursos-periodo">
            <!-- Aquí se mostrarán los cursos dinámicamente -->
        </div>

        <!-- Sección de cursos -->
        <div class="container-curso-disponible">
            <div class="container-header-curso-disponible" onclick="AlternarContenido(this)">
                <h2>Despliega para ver cursos</h2>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="curso-disponible">
                <!-- Cursos desaprobados -->
                <h3>Cursos desaprobados o no matriculados</h3>
                <div class="container-listado-curso">
                    <?php if (!empty($cursosDesaprobados)): ?>
                        <?php foreach ($cursosDesaprobados as $curso): ?>
                            <div class="listado-curso curso-desaprobado">
                                <label>
                                    <input type="checkbox" name="cursos[]" value="<?= $curso['codcurso'] ?>">
                                    <?= htmlspecialchars($curso['nombrecurso']) ?>
                                    <span>(Debes matricularte en este curso)</span>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No tienes cursos desaprobados.</p>
                    <?php endif; ?>
                </div>
                <br>
                <!-- Cursos disponibles -->
                <h3>Cursos disponibles del periodo seleccionado</h3>
                <div class="container-listado-curso" id="contenido-dinamico">
                    <?php if (!empty($cursosDisponibles)): ?>
                        <?php foreach ($cursosDisponibles as $curso): ?>
                            <div class="listado-curso">
                                <label>
                                    <input type="checkbox" name="cursos[]" value="<?= $curso['codcurso'] ?>">
                                    <?= htmlspecialchars($curso['nombrecurso']) ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="mensaje-error">No hay cursos disponibles para matrícula o el período de matrícula ha terminado.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Listado de cursos seleccionados --> 
        <div class="container-curso-seleccionado">
            <header class="header-container-listado">
                <span>Resumen de selección</span>
            </header>
            <div class="container-listado">
                <!-- Aquí se mostrarán los cursos seleccionados -->
            </div>
        </div>

        <!-- Botón para guardar selección -->
        <div class="registrar-matricula">
            <button type="submit">Registra tu matricula</button>
        </div>
    </div>

            <script src="../public/assets/js/script_mostrar_formulario_matricula.js"></script>
        <script src="../public/assets/js/script_matricula.js"></script>

</body>
</html>
