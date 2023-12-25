<?php

// Verificar si se recibieron datos POST
if (isset($_POST['datos'])) {
    // Obtener y decodificar los datos JSON
    $jsonData = $_POST['datos'];
    $objeto = json_decode($jsonData, true);

    // Acceder a las propiedades del objeto
    $id_problema = $objeto['id_problema'];
    $num_bodega = $objeto['num_bodega'];
    $letra_fabrica = $objeto['letra_fabrica'];
    $costo = $objeto['monto'];

    // Realizar la operación que desees con los datos
    // Aquí puedes realizar una inserción en la base de datos, por ejemplo

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

    // Construir la consulta SQL para la inserción
    $sqlInsercion = "INSERT INTO costo (id_problema,letra_fabrica, num_bodega, monto) VALUES ('$id_problema','$letra_fabrica', '$num_bodega', '$costo')";

    // Ejecutar la consulta
    if ($conn->query($sqlInsercion) === TRUE) {
        // Imprimir algún mensaje de respuesta (puede ser útil para la confirmación)
        echo "Inserción exitosa para Costo: $id_problema, letra_fabrica : $letra_fabrica, monto: $costo, num_bodega : $num_bodega ";
    } else {
        // Imprimir un mensaje de error si la inserción falla
        echo "Error al realizar la inserción: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
} else {
    // Si no se recibieron datos, muestra un mensaje de error
    echo "No se recibieron datos correctamente desde JavaScript.";
}

?>
