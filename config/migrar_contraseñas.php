// este archivo es solo para migrar las contraseñas a password_hash() es decir cifrar
y trabajar la seguridad de registros y desde los controller para manejar el password_verify()



<?php

require_once 'database.php';
try {
    $conn = Database::getInstance()->getConnection();
    $query = "SELECT * FROM usuario";
    $stmt = $conn->query($query);
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $hashedPassword = password_hash($row['password'], PASSWORD_DEFAULT);
        $updateQuery = "UPDATE usuario SET password = :hashedPassword WHERE codalumno = :codalumno";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bindParam(':hashedPassword', $hashedPassword);
        $updateStmt->bindParam(':codalumno', $row['codalumno']);
        $updateStmt->execute();
    }
    echo "Las contraseñas se han hasheado correctamente.";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
