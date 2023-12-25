function enviararray(){
    // Arreglo de objetos
    
    var arregloObjetos = [
        { nombre: 'Objeto1', valor: 10 },
        { nombre: 'Objeto2', valor: 20 },
        { nombre: 'Objeto3', valor: 30 }
    ];
    
    // Iterar sobre el arreglo de objetos
    arregloObjetos.forEach(function(objeto) {
        // Crear un objeto FormData
        var formData = new FormData();
        formData.append('datos', JSON.stringify(objeto));
    
        // Realizar la solicitud AJAX (POST) para cada objeto
        fetch('ver.php', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.text())
        .then(data => {
            // Manejar la respuesta del servidor para cada iteración
            console.log(data);
        })
        .catch(error => {
            console.error('Error en la solicitud:', error);
        });
    });
    
    
    
    }
    
    enviararray();