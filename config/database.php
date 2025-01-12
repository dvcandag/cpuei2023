<?php
require_once 'config.php';


// Clase para gestionar la base de datos con el patrón Singleton
class Database {
    private static ?Database $instance = null; // Declaración de tipo para la instancia única
    private PDO $conn; // Tipado de la conexión PDO

    // Constructor privado para evitar la creación directa
    private function __construct() {
        $dsn = "mysql:host=" . HOST . ";dbname=" . DB . ";charset=" . CHARSET;
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            // Establecer la conexión
            $this->conn = new PDO($dsn, USER, PASSWORD, $options);
        } catch (PDOException $e) {
            // Lanzar una excepción si falla la conexión
            throw new PDOException("Error al conectar a la base de datos: " . $e->getMessage(), (int)$e->getCode());
        }
    }

    // Método para obtener la instancia única
    public static function getInstance(): Database {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    // Método para obtener la conexión PDO
    public function getConnection(): PDO {
        return $this->conn;
    }
}

// Creación de prueba de conexión

try {
    // Obtener la conexión utilizando el patrón Singleton
    $db = Database::getInstance();
    $conn = $db->getConnection();

    // Realizar una consulta de prueba
    $query = "SELECT 1";
    $stmt = $conn->query($query);

    // Verificar si la consulta fue exitosa
    if ($stmt) {
        //echo "¡Conexión exitosa a la base de datos!";
    } else {
        //echo "Error al ejecutar la consulta.";
    }
} catch (PDOException $e) {
    // Manejo de excepciones
    //echo "Error al conectar a la base de datos: " . $e->getMessage();
}
?>
