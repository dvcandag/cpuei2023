<?php
require_once 'config/database.php';

class CursosModel {
    public function obtenerCursosMatriculados($codalumno) {
    // Obtener la conexión a la base de datos desde el archivo database.php
    $conn = Database::getInstance()->getConnection();
    
    // Preparar la consulta SQL para obtener los cursos matriculados del alumno
    $query = "SELECT curso.codcurso, curso.nombrecurso 
            FROM curso
            INNER JOIN matricula ON curso.codcurso = matricula.codcurso
            WHERE matricula.codalumno = :codalumno";
    
    // Preparar la sentencia SQL
    $stmt = $conn->prepare($query);
    
    // Ejecutar la consulta con el código de alumno como parámetro
    $stmt->execute(['codalumno' => $codalumno]);
    
    // Obtener los resultados de la consulta como un array
    $cursosMatriculados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Retornar los cursos matriculados
    return $cursosMatriculados;
}
}
?>