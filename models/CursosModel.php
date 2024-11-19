<?php
require_once 'config/database.php';

class CursosModel {
    public function obtenerCursosMatriculados($codalumno) {
        $conn = Database::getInstance()->getConnection();
        
        $query = "SELECT curso.codcurso, curso.nombrecurso 
                  FROM curso
                  INNER JOIN matricula ON curso.codcurso = matricula.codcurso
                  WHERE matricula.codalumno = :codalumno";
        
        $stmt = $conn->prepare($query);
        $stmt->execute(['codalumno' => $codalumno]);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
