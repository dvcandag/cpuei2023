<?php 
if (!isset($_SESSION['username'])) {
    header("Location: index.php?action=showLoginForm");
    exit;
}

$cursosParaMatricula = $_SESSION['cursosParaMatricula'] ?? [];
$cursosDesaprobados = $_SESSION['cursosDesaprobados'] ?? [];
$codPeriodo = $_SESSION['codPeriodo'] ?? null;
$periodos = $_SESSION['periodos'] ?? [];
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

        <?php if (isset($_SESSION['success'])): ?>
<script>
    alert("<?= addslashes($_SESSION['success']) ?>");
    window.location.href = "index.php";
</script>
<?php unset($_SESSION['success']); ?>
<?php elseif (isset($_SESSION['error'])): ?>
<script>
    alert("<?= addslashes($_SESSION['error']) ?>");
    window.location.href = "index.php";
</script>
<?php unset($_SESSION['error']); ?>
<?php endif; ?>


        <form method="POST" action="index.php?action=seleccionarPeriodo">
            <div class="container-periodo">
                <select id="seleccionar-lista-periodo" name="codPeriodo" onchange="cargarCursos(this.value)">
                    <option value="" disabled selected>Seleccione periodo</option>
                    <?php foreach ($periodos as $periodo): ?>
                        <option value="<?= $periodo['codPeriodo'] ?>" <?= ($codPeriodo == $periodo['codPeriodo']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($periodo['NombrePeriodo']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </form> 

        <form action="<?= URL ?>index.php?action=guardarMatricula" method="post">
            <input type="hidden" name="codPeriodo" value="<?= htmlspecialchars($codPeriodo ?? '') ?>">

            <div class="container-curso-disponible">
                <div class="container-header-curso-disponible" onclick="AlternarContenido(this)">
                    <h2>Despliega para ver cursos</h2>
                    <i class="fas fa-chevron-down"></i>
                </div>
                
                <div class="curso-disponible">
                    <div id="cursos-periodo">
                    <div id="cursos-desaprobados" class="seccion-cursos">
                        <h3>Cursos desaprobados o no cursado y terminados</h3>
                        <div class="container-listado-curso curso-desaprobado">
                            </div>
                    </div>
                    <br>
                    <div id="cursos-disponibles" class="container-listado-curso">
                        <h3>Cursos disponibles del periodo a matricularse</h3>
                        <div class="container-listado-curso">
                            </div>
                    </div>
                    </div>
                </div>
            </div>

            <div class="container-curso-seleccionado">
                <header class="header-container-listado">
                    <span>Resumen de selección</span>
                </header>
                <div id="resumen-seleccion" class="container-listado">
                    <p>No hay cursos seleccionados</p>
                </div>
            </div>

            <div class="registrar-matricula">
                <button type="submit">Registra tu matrícula</button>
            </div>
        </form>
    </div>

    <script src="../public/assets/js/script_mostrar_formulario_matricula.js"></script>
    <script src="../public/assets/js/script_matricula.js"></script>
</body>
</html>