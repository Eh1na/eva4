<?php

// Tu arreglo de objetos JSON
$jsonString = '[{"nombre": "json-php", "valor": 10},{"nombre": "Objeto2", "valor": 20},{"nombre": "Objeto3", "valor": 30}]';

// Decodificar el JSON a un arreglo de objetos PHP
$arregloObjetos = json_decode($jsonString, true);

// Conectar a tu base de datos (debes configurar tus propias credenciales)
$conexion = new mysqli("localhost", "root", "", "mariadb");

// Verificar la conexión
if ($conexion->connect_error) {
    die("La conexión falló: " . $conexion->connect_error);
}

// Iterar sobre el arreglo de objetos PHP
foreach ($arregloObjetos as $objeto) {
    // Acceder a las propiedades del objeto
    $nombre = $conexion->real_escape_string($objeto['nombre']);
    $valor = $conexion->real_escape_string($objeto['valor']);

    // Realizar la inserción en tu tabla (debes tener una tabla con campos correspondientes)
    $sql = "INSERT INTO tu_tabla (nombre, valor) VALUES ('$nombre', '$valor')";

    if ($conexion->query($sql) !== TRUE) {
        echo "Error al insertar en la base de datos: " . $conexion->error;
    } else {
        echo "Inserción exitosa para Nombre: $nombre, Valor: $valor<br>";
    }
}

// Cerrar la conexión
$conexion->close();

?>