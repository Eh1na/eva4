<?php
// Recibir los datos del formulario
$dato1 = $_POST['total_fabrica'];
$dato2 = $_POST['total_bodega'];
$id_metodo = $_POST['id_metodo'];
$costo_total = $_POST['costo_total'];
//$fabricas = $_POST['fabricas'];
// Recibir los datos JSON desde la solicitud POST
$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true); // El segundo parámetro true convierte a un array asociativo

header('Content-Type: application/json');



// Acceder al arreglo 'fabricas'
$fabricas = json_decode($data['fabricas'], true);

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
$id_metodo = $conn->real_escape_string($id_metodo);
$costo_total = $conn->real_escape_string($costo_total);

$sqlproblema = "INSERT INTO problema (total_fabrica, total_bodega) VALUES ('$dato1', '$dato2')";

if ($conn->query($sqlproblema) === TRUE) {
    $idProblemaInsertado = $conn->insert_id;

    // Insertar en la tabla 'solucion' después de obtener idProblemaInsertado
    $sqlsolucion = "INSERT INTO solucion (id_problema, id_metodo, costo_total) VALUES ('$idProblemaInsertado', '$id_metodo','$costo_total')";

    if ($conn->query($sqlsolucion) === TRUE) {

        //Iterar sobre el array de objetos 'fabricas' y realizar un INSERT por cada objeto
        
        foreach ($fabricas as $fabrica) {
            $letra_fabrica = $conn->real_escape_string($fabrica['id']);
            $produccion = $conn->real_escape_string($fabrica['value']);

            $sqlfabrica = "INSERT INTO fabrica (id_problema,letra_fabrica,produccion) VALUES ('$idProblemaInsertado', '$letra_fabrica', '$produccion')";

            if ($conn->query($sqlfabrica) !== TRUE) {
                echo json_encode(['error' => "Error al guardar datos en 'fabrica': " . $conn->error]);
                // Puedes decidir qué hacer en caso de un error en la inserción de 'fabrica'
            }
        }

        echo json_encode(['success' => "Datos guardados correctamente. ID del último registro insertado en 'problema': $idProblemaInsertado"]);
    } else {
        echo json_encode(['error' => "Error al guardar datos en 'solucion': " . $conn->error]);
    }
} else {
    echo json_encode(['error' => "Error al guardar datos en 'problema': " . $conn->error]);
}

// Cerrar la conexión
$conn->close();
?>

