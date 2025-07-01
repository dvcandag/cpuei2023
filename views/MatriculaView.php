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
                        <option value="<?= $periodo['codPeriodo'] ?>">
                            <?= htmlspecialchars($periodo['NombrePeriodo']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </form>

        <!-- FORMULARIO PRINCIPAL DE MATRÍCULA -->
        
<form action="../index.php?action=guardarMatricula" method="post">
    

            <!--contenidor para desplegar cursos del periodo seleccionado-->
            <div class="container-curso-disponible">
                <div class="container-header-curso-disponible" onclick="AlternarContenido(this)">
                    <h2>Despliega para ver cursos</h2>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <!-- Div para mostrar los cursos del período seleccionado -->
                <div class="curso-disponible">
                    <div id="cursos-periodo">
                        <!-- Cursos desaprobados -->
                        <div id="cursos-desaprobados" class="seccion-cursos">
                            <h3>Cursos Desaprobados</h3>
                            <div class="container-listado-curso">
                                <!-- Aquí se mostrarán los cursos desaprobados dinámicamente -->
                            </div>
                        </div>
                        <br>
                        <!-- Cursos disponibles -->
                        <div id="cursos-disponibles" class="container-listado-curso">
                            <h3>Cursos Disponibles</h3>
                            <div class="container-listado-curso">
                                <!-- Aquí se mostrarán los cursos disponibles dinámicamente -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Listado de cursos seleccionados --> 
            <div class="container-curso-seleccionado">
                <header class="header-container-listado">
                    <span>Resumen de selección</span>
                </header>
                <div id="resumen-seleccion" class="container-listado">
                    <!-- Aquí se mostrarán los cursos seleccionados con el checkbox desde el div de cursos desaprobardo y cursos disponibles -->
                </div>
            </div>

            <!-- Botón para guardar selección-->
            <div class="registrar-matricula">
                <button type="submit">Registra tu matrícula</button>
            </div>


        </form> <!-- fin form-matricula -->

    </div>

    <script src="../public/assets/js/script_mostrar_formulario_matricula.js"></script>

</body>
</html>
