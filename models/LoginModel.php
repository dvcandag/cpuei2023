<?php

require_once 'config/database.php';

class LoginModel {
    public function getUserByUsername($username) {
        $conn = Database::getInstance()->getConnection();
        $query = "SELECT * FROM usuario WHERE codalumno = :username";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user;
    }
}
?>

