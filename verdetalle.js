


function obtenerDatosDelServidor(idProblema) {
    // Utiliza jQuery para realizar la solicitud AJAX
    $.ajax({
        url: 'cargardatos.php',
        method: 'POST',
        contentType: 'application/json',
        data: JSON.stringify({ id_problema: idProblema }),
        dataType: 'json',
        success: function (data) {
            // Aquí puedes procesar los datos recibidos
            console.log(data);

            // Ejemplo: Mostrar información de la tabla 'problema'
            if (data.problema) {
                console.log('Datos de problema:', data.problema);
            }

            // Ejemplo: Mostrar información de la tabla 'fabrica'
            if (data.fabrica) {
                console.log('Datos de fabrica:', data.fabrica);
            }

            // Repite este bloque para cada tabla que necesites
            // ...
        },
        error: function (error) {
            console.error('Error al obtener datos del servidor:', error);
        }
    });
}

// Llama a la función con un ID específico (puedes obtener este ID dinámicamente)
obtenerDatosDelServidor(81);
