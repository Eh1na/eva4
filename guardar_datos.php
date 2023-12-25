<?php
// Recibir los datos JSON desde la solicitud POST
$jsonData = $_POST['data'];
$data = json_decode($jsonData, true);


// Acceder a las propiedades y arreglos de 'data'
$totalFabrica = $data['total_fabrica'];
$totalBodega = $data['total_bodega'];
$idMetodo = $data['id_metodo'];
$costoTotal = $data['costo_total'];
// $bodegas = $data['bodegas'];
// $fabricas = $data['fabricas'];
// $asignaciones = $data['asignacion'];
// $costos = $data['costo'];

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
$sqlProblema = "INSERT INTO problema (total_fabrica, total_bodega) VALUES ('$totalFabrica', '$totalBodega')";

if ($conn->query($sqlProblema) === TRUE) {
    // Obtener el ID autogenerado después de la inserción
    $idProblemaInsertado = $conn->insert_id;

    // Puedes continuar realizando más operaciones aquí si es necesario
    

    // Enviar una respuesta de vuelta si es necesario
    echo json_encode(['success' => 'Datos recibidos y procesados correctamente. ID del último registro insertado en \'problema\': ' . $idProblemaInsertado]);
} else {
    echo json_encode(['error' => 'Error al realizar la inserción en \'problema\': ' . $conn->error]);
}

// Cerrar la conexión
$conn->close();
?>