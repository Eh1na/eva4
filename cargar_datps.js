document.addEventListener('DOMContentLoaded', function () {
    // Llamada AJAX para obtener datos desde el servidor PHP
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'cargar_datospatron.php', true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Analizar la respuesta JSON
            var data = JSON.parse(xhr.responseText);
            // Llenar la tabla con los datos recibidos
            llenarTabla(data);
        } else if (xhr.readyState == 4 && xhr.status != 200) {
            console.error('Error al cargar datos: ' + xhr.responseText);
        }
    };
    xhr.send();
});

// Función para llenar la tabla con datos
function llenarTabla(datos) {
    var tabla = document.getElementById('tablaDatos').getElementsByTagName('tbody')[0];

    // Limpiar la tabla antes de llenarla
    tabla.innerHTML = '';

    // Iterar sobre los datos y agregar filas a la tabla
    datos.forEach(function (fila) {
        var tr = document.createElement('tr');
        tr.innerHTML += '<td>' + fila.id_problema + '</td>';
        tr.innerHTML += '<td>' + fila.total_fabrica + '</td>';
        tr.innerHTML += '<td>' + fila.total_bodega + '</td>';
        tr.innerHTML += '<td>' + fila.fecha_hora + '</td>';
        tr.innerHTML += '<td>' + fila.nombre_metodo + '</td>';
        tr.innerHTML += '<td>' + fila.costo_total + '</td>';
        tabla.appendChild(tr);
    });
}

