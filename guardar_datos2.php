<?php
// Recibir los datos del formulario
$dato1 = $_POST['dato1'];
$dato2 = $_POST['dato2'];
// Agrega más variables según sea necesario

// Realizar la conexión a la base de datos (reemplaza con tus propios datos)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mariadb";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Escapar datos para evitar inyección SQL (usa consultas preparadas para mayor seguridad)
$dato1 = $conn->real_escape_string($dato1);
$dato2 = $conn->real_escape_string($dato2);
// Agrega más variables y escapa según sea necesario

$sql = "INSERT INTO problema (total_fabrica, total_bodega) VALUES ('$dato1', '$dato2')";

if ($conn->query($sql) === TRUE) {
    $idProblemaInsertado = $conn->insert_id;
    echo json_encode(['success' => "Datos guardados correctamente. ID del último registro insertado en 'problema': $idProblemaInsertado"]);
} else {
    echo json_encode(['error' => "Error al guardar datos: " . $conn->error]);
}

// Cerrar la conexión
$conn->close();
?>
