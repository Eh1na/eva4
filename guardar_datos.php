<?php
// Recibir los datos JSON desde la solicitud POST
$jsonData = $_POST['data'];
$data = json_decode($jsonData, true);

// Acceder a las propiedades y arreglos de 'data'
$total_fabrica = $data['total_fabrica'];
$total_bodega = $data['total_bodega'];
$id_metodo = $data['id_metodo'];
$costo_total = $data['costo_total'];

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

// Insertar datos en la tabla 'problema'
$sqlProblema = "INSERT INTO problema (total_fabrica, total_bodega) VALUES ('$total_fabrica', '$total_bodega')";

if ($conn->query($sqlProblema) === TRUE) {
    // Obtener el ID autogenerado después de la inserción
    $idProblemaInsertado = $conn->insert_id;

    // Insertar datos en otra tabla usando el ID del problema insertado
    $sqlOtraTabla = "INSERT INTO solucion (id_problema, id_metodo, costo_total) VALUES ('$idProblemaInsertado', '$id_metodo', '$costo_total')";

    if ($conn->query($sqlOtraTabla) === TRUE) {
        // Puedes realizar más operaciones aquí si es necesario

        // Enviar una respuesta de vuelta si es necesario, incluyendo el ID del problema insertado
        echo json_encode(['success' => 'Datos recibidos y procesados correctamente.', 'id_problema_insertado' => $idProblemaInsertado]);
    } else {
        echo json_encode(['error' => 'Error al realizar la inserción en \'otra_tabla\': ' . $conn->error]);
    }
} else {
    echo json_encode(['error' => 'Error al realizar la inserción en \'problema\': ' . $conn->error]);
}

// Cerrar la conexión
$conn->close();
?>
