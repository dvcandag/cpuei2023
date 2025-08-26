<?php
require_once 'config/database.php';

class LoginModel {
    public function getUserByUsername($username) {
        $conn = Database::getInstance()->getConnection();
        $query = "SELECT u.*, a.nombrealumno, a.apaterno, a.amaterno 
                  FROM usuario u
                  JOIN alumno a ON u.codalumno = a.codalumno
                  WHERE u.codalumno = :username";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user;
    }
}

?>
