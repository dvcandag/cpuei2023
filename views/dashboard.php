<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}
$username = $_SESSION['username'];
$alumno = $_SESSION['alumno']; // Obtener datos del alumno desde la sesión
$notas = $_SESSION['notas']; // Suponiendo que guardaste las notas en la sesión

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>

    <h1>Bienvenido, <?php echo $username; ?></h1>
    <a href="logout.php">Cerrar sesión</a>

    <h1>Datos del Alumno</h1>
    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Escuela</th>
                <th>Aula</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $alumno['codalumno']; ?></td>
                <td><?php echo $alumno['nombrealumno']; ?></td>
                <td><?php echo $alumno['apaterno']; ?></td>
                <td><?php echo $alumno['amaterno']; ?></td>
                <td><?php echo $alumno['escuela']; ?></td>
                <td><?php echo $alumno['aula']; ?></td>
            </tr>
        </tbody>
    </table>


<h1>Notas del Alumno</h1>
<table>
    <thead>
        <tr>
            <th>Nota 1</th>
            <th>Nota 2</th>
            <th>Nota 3</th>
            <th>Nota 4</th>
        </tr>
    </thead>
    <tbody>
        
            <tr>
                <td><?php echo $notas['n1']; ?></td>
                <td><?php echo $notas['n2']; ?></td>
                <td><?php echo $notas['n3']; ?></td>
                <td><?php echo $notas['n4']; ?></td>
            </tr>
       
    </tbody>
</table>

</body>
</html>
