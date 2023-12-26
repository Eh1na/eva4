


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


//objeto de respuesta

{"problema": [{      "id_problema": "82",      "total_fabrica": "3",      "total_bodega": "3",      "fecha_hora": "2023-12-25 20:02:26"    }  ],
"fabrica": [    {      "id_problema": "82",      "letra_fabrica": "A",      "produccion": "2"    },    {      "id_problema": "82",      "letra_fabrica": "B",      "produccion": "2"    },    {      "id_problema": "82",      "letra_fabrica": "C",      "produccion": "2"    }  ],
"asignacion": [    {      "id_problema": "82",      "letra_fabrica": "A",      "num_bodega": "0",      "cantidad": "2"    },    {      "id_problema": "82",      "letra_fabrica": "A",      "num_bodega": "1",      "cantidad": "2"    },    {      "id_problema": "82",      "letra_fabrica": "A",      "num_bodega": "2",      "cantidad": "2"    },    {      "id_problema": "82",      "letra_fabrica": "B",      "num_bodega": "0",      "cantidad": "2"    },    {      "id_problema": "82",      "letra_fabrica": "B",      "num_bodega": "1",      "cantidad": "2"    },    {      "id_problema": "82",      "letra_fabrica": "B",      "num_bodega": "2",      "cantidad": "2"    },    {      "id_problema": "82",      "letra_fabrica": "C",      "num_bodega": "0",      "cantidad": "2"    },    {      "id_problema": "82",      "letra_fabrica": "C",      "num_bodega": "1",      "cantidad": "2"    },    {      "id_problema": "82",      "letra_fabrica": "C",      "num_bodega": "2",      "cantidad": "2"    }  ],
"bodega": [    {      "id_problema": "82",      "num_bodega": "0",      "capacidad": "2"    },    {      "id_problema": "82",      "num_bodega": "1",      "capacidad": "2"    },    {      "id_problema": "82",      "num_bodega": "2",      "capacidad": "2"    }  ],
"costo": [    {      "monto": "2",      "id_problema": "82",      "letra_fabrica": "A",      "num_bodega": "0"    },    {      "monto": "2",      "id_problema": "82",      "letra_fabrica": "A",      "num_bodega": "1"    },    {      "monto": "2",      "id_problema": "82",      "letra_fabrica": "A",      "num_bodega": "2"    },    {      "monto": "2",      "id_problema": "82",      "letra_fabrica": "B",      "num_bodega": "0"    },    {      "monto": "2",      "id_problema": "82",      "letra_fabrica": "B",      "num_bodega": "1"    },    {      "monto": "2",      "id_problema": "82",      "letra_fabrica": "B",      "num_bodega": "2"    },    {      "monto": "2",      "id_problema": "82",      "letra_fabrica": "C",      "num_bodega": "0"    },    {      "monto": "2",      "id_problema": "82",      "letra_fabrica": "C",      "num_bodega": "1"    },    {      "monto": "2",      "id_problema": "82",      "letra_fabrica": "C",      "num_bodega": "2"    }  ],
"metodo": [    {      "id_metodo": "1",      "nombre": "Bogel"    },    {      "id_metodo": "2",      "nombre": "NWC"    },    {      "id_metodo": "3",      "nombre": "Minimos Costos"    }  ],
"solucion": [    {      "id_problema": "82",      "id_metodo": "1",      "costo_total": "18"    }  ]}