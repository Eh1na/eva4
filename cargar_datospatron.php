<?php
class DatabaseConnection {
    private static $instance;
    private $conn;

    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "mariadb";

    private function __construct() {
        // Construye la conexión a la base de datos
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        // Manejar posibles errores de conexión
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public static function getInstance() {
        // Crea la instancia si no existe
        if (self::$instance === null) {
            self::$instance = new self();
        }

        // Devuelve la instancia existente
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }
}

// Uso del patrón Singleton
$databaseConnection = DatabaseConnection::getInstance();
$conn = $databaseConnection->getConnection();

// Ahora, puedes usar $conn para realizar operaciones en la base de datos


// Consulta para obtener datos de las tablas 'problema', 'solucion' y 'metodo'
$sql = "SELECT p.id_problema, p.total_fabrica, p.total_bodega, p.fecha_hora, m.nombre AS nombre_metodo, s.costo_total
        FROM problema p
        INNER JOIN solucion s ON p.id_problema = s.id_problema
        INNER JOIN metodo m ON s.id_metodo = m.id_metodo";
$result = $conn->query($sql);

// Crear un array para almacenar los resultados
$rows = array();

if ($result->num_rows > 0) {
    // Almacenar cada fila como un objeto en el array
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
}

// Devolver los datos como JSON
echo json_encode($rows);

// Cerrar la conexión
$conn->close();
?>


