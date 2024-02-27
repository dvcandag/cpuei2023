<?php
require_once 'config.php';

class Database {
    private static $instance = null;
    private $conn;

    private function __construct() {
        $host = HOST;
        $db   = DB;
        $user = USER;
        $pass = PASSWORD;
        $charset = CHARSET;

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $this->conn = new PDO($dsn, $user, $pass, $options);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }
}



// Creacion de test de conexion 

try {
    // Crear una conexión a la base de datos utilizando las constantes definidas
    $conn = new PDO("mysql:host=" . HOST . ";dbname=" . DB, USER, PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Realizar una consulta de prueba
    $query = "SELECT 1";
    $stmt = $conn->query($query);

    // Verificar si la consulta se ejecutó con éxito
    if ($stmt) {
        //echo "¡Conexión exitosa a la base de datos!";
    } else {
        //echo "Error al ejecutar la consulta.";
    }
} catch (PDOException $e) {
    // Capturar cualquier error al conectar a la base de datos
    //echo "Error al conectar a la base de datos: " . $e->getMessage();
}
// find de test de conexion 





?>

