<?php
// Recibir el ID del problema desde JavaScript
$data = json_decode(file_get_contents('php://input'), true);
$id_problema = $data['id_problema'];



// Verificar si se recibió el ID del problema correctamente
if (isset($id_problema)) {
    // Variables para almacenar resultados
// Variables para almacenar resultados
$resultados = array();

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

// Obtener datos de la tabla 'problema'
$sqlProblema = "SELECT * FROM problema WHERE id_problema = $id_problema";
$resultProblema = $conn->query($sqlProblema);

if ($resultProblema->num_rows > 0) {
    $rowProblema = $resultProblema->fetch_assoc();
    $resultados['problema'][] = $rowProblema;
} else {
    $resultados['problema'][] = "No se encontraron datos en la tabla 'problema'.";
}

// Obtener datos de la tabla 'fabrica'
$sqlFabrica = "SELECT * FROM fabrica WHERE id_problema = $id_problema";
$resultFabrica = $conn->query($sqlFabrica);

if ($resultFabrica->num_rows > 0) {
    while ($rowFabrica = $resultFabrica->fetch_assoc()) {
        $resultados['fabrica'][] = $rowFabrica;
    }
} else {
    $resultados['fabrica'][] = "No se encontraron datos en la tabla 'fabrica'.";
}

// Obtener datos de la tabla 'asignacion'
$sqlAsignacion = "SELECT * FROM asignacion WHERE id_problema = $id_problema";
$resultAsignacion = $conn->query($sqlAsignacion);

if ($resultAsignacion->num_rows > 0) {
    while ($rowAsignacion = $resultAsignacion->fetch_assoc()) {
        $resultados['asignacion'][] = $rowAsignacion;
    }
} else {
    $resultados['asignacion'][] = "No se encontraron datos en la tabla 'asignacion'.";
}

// Obtener datos de la tabla 'bodega'
$sqlBodega = "SELECT * FROM bodega WHERE id_problema = $id_problema";
$resultBodega = $conn->query($sqlBodega);

if ($resultBodega->num_rows > 0) {
    while ($rowBodega = $resultBodega->fetch_assoc()) {
        $resultados['bodega'][] = $rowBodega;
    }
} else {
    $resultados['bodega'][] = "No se encontraron datos en la tabla 'bodega'.";
}

// Obtener datos de la tabla 'costo'
$sqlCosto = "SELECT * FROM costo WHERE id_problema = $id_problema";
$resultCosto = $conn->query($sqlCosto);

if ($resultCosto->num_rows > 0) {
    while ($rowCosto = $resultCosto->fetch_assoc()) {
        $resultados['costo'][] = $rowCosto;
    }
} else {
    $resultados['costo'][] = "No se encontraron datos en la tabla 'costo'.";
}

// Obtener datos de la tabla 'metodo'
$sqlMetodo = "SELECT * FROM metodo";
$resultMetodo = $conn->query($sqlMetodo);

if ($resultMetodo->num_rows > 0) {
    while ($rowMetodo = $resultMetodo->fetch_assoc()) {
        $resultados['metodo'][] = $rowMetodo;
    }
} else {
    $resultados['metodo'][] = "No se encontraron datos en la tabla 'metodo'.";
}

// Obtener datos de la tabla 'solucion'
$sqlSolucion = "SELECT * FROM solucion WHERE id_problema = $id_problema";
$resultSolucion = $conn->query($sqlSolucion);

if ($resultSolucion->num_rows > 0) {
    while ($rowSolucion = $resultSolucion->fetch_assoc()) {
        $resultados['solucion'][] = $rowSolucion;
    }
} else {
    $resultados['solucion'][] = "No se encontraron datos en la tabla 'solucion'.";
}

// Cerrar la conexión
$conn->close();

// Convertir el array a formato JSON
$jsonResultados = json_encode($resultados);

// Mostrar resultados en formato JSON
echo $jsonResultados;
} else {
    // Si no se recibió el ID del problema, muestra un mensaje de error
    echo json_encode(['error' => 'No se recibió el ID del problema correctamente desde JavaScript.']);
}
?>
