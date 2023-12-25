<?php

// Verificar si se recibieron datos POST
if (isset($_POST['datos'])) {
    // Obtener y decodificar los datos JSON
    $jsonData = $_POST['datos'];
    $objeto = json_decode($jsonData, true);

    // Acceder a las propiedades del objeto
    $nombre = $objeto['nombre'];
    $valor = $objeto['valor'];

    // Realizar la operación que desees con los datos
    // Aquí puedes realizar una inserción en la base de datos, por ejemplo
    // ...

    // Imprimir algún mensaje de respuesta (puede ser útil para la confirmación)
    echo "Inserción exitosa para Nombre: $nombre, Valor: $valor";
} else {
    // Si no se recibieron datos, muestra un mensaje de error
    echo "No se recibieron datos correctamente desde JavaScript.";
}

?>