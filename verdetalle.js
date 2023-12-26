
const btnid = document.getElementById("id_buscar");


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

           const obj = data;
    
           const container=document.getElementById('containertable')
           const table=document.getElementById('table')
           const containerFull=document.getElementById('containerFull')
           
           function createTableView(){
                containerFull.innerHTML=""
                table.innerHTML=''
               const headInfo=document.createElement('div')
               const headH1=document.createElement('h1')
               headH1.innerText="ID PROBLEMA "+obj.problema[0].id_problema
               const headTFabricas=document.createElement('h3')
               headTFabricas.innerText="Cantidad de fabricas: "+obj.problema[0].total_fabrica
           
               const headTBodegas=document.createElement('h3')
               headTBodegas.innerText="Cantidad de bodegas: "+obj.problema[0].total_bodega
           
               const fecha=document.createElement('h4')
               fecha.innerText=obj.problema[0].fecha_hora
           
           
               headInfo.appendChild(headH1)
               headInfo.appendChild(headTFabricas)
               headInfo.appendChild(headTBodegas)
               containerFull.appendChild(headInfo)
               const headsFabricas=document.createElement('tr')
               const number=document.createElement('th')
               headsFabricas.appendChild(number)
               table.appendChild(headsFabricas)
               const dataFabricas=document.createElement('tr')
           
               for(let i=1;i<Number(obj.fabrica.length)+1;i++){
                   const headFab=document.createElement('th');
                   headFab.innerText='Fábrica '+(obj.fabrica[i-1].letra_fabrica)
                   headsFabricas.appendChild(headFab)
               }
               const almacen=document.createElement('th')
               almacen.innerText="Almacenamiento"
               headsFabricas.appendChild(almacen)
               //ok
           
               const d=document.createElement('td')
               const str=document.createElement('strong')
               str.innerText="Producción"
               d.appendChild(str)
               dataFabricas.appendChild(d)
           
               var amount=1;
               for(let i=1;i<Number(obj.fabrica.length)+1;i++){
                   const data=document.createElement('td')
                   data.innerText=(obj.fabrica[i-1].produccion)
                   dataFabricas.appendChild(data)
               }
               table.appendChild(headsFabricas)
           
               for (let i=1;i<Number(obj.bodega.length)+1;i++){
                   const bod=document.createElement('tr');
                   const strong=document.createElement('strong')
                   strong.innerText='Bodega '+(obj.bodega[i-1].num_bodega)
                   bod.appendChild(strong)
                   for(let u=0;u<Number(obj.fabrica.length);u++){
           
                       const td=document.createElement('td')
                       td.id='td'+amount
                       td.className='tdInput'
                       const textCosto=document.createElement('p')
                       textCosto.innerText='Costo:'+obj.costo[i-1].monto
                       textCosto.id='inputCost'+amount
                       const textCantidad=document.createElement('p')
                      textCantidad.innerText="Cantidad"+obj.asignacion[i-1].cantidad 
                      td.appendChild(textCosto)
                       td.appendChild(textCantidad)
                       bod.appendChild(td)
                      // cantInput=cantInput+1
                       amount=amount+1
           
                   }
                   const prod=document.createElement('td')
                   prod.innerText=(obj.bodega[i-1].capacidad)
                   bod.appendChild(prod)
                   table.appendChild(bod)
               }
               table.appendChild(dataFabricas)
           
           }
           
           
           container.appendChild(table)
           
           createTableView()

        },
        error: function (error) {
            console.error('Error al obtener datos del servidor:', error);
        }
    });
}

// Llama a la función con un ID específico (puedes obtener este ID dinámicamente)




btnid.addEventListener('click',()=>{
    const id = document.getElementById("id").value;
    console.log(id);
    obtenerDatosDelServidor(id);});




//objeto de respuesta
// const obj={problema: 
//     [{  id_problema: 82,
//         total_fabrica: 3,
//         total_bodega: 3,
//         fecha_hora: "2023-12-25 20:02:26"}],
//     fabrica: 
//     [{  id_problema: 82,
//         letra_fabrica: "A",
//         produccion: "2"},
//         {id_problema:82,
//         letra_fabrica: "B",
//         produccion: "2"},
//         {id_problema: 82,
//         letra_fabrica: "C",
//         produccion: "2"
//     }],
//     asignacion:
//     [{  id_problema:82,
//         letra_fabrica: "A",
//         num_bodega: "0",
//         cantidad: 2},
//         {id_problema: 82,
//         letra_fabrica: "A",
//         num_bodega: "1",
//         cantidad: "2"},
//         {id_problema: "82",
//         letra_fabrica: "A",
//         num_bodega: "2",
//         cantidad: "2"},
//         {id_problema: "82",
//         letra_fabrica: "B",
//         num_bodega: "0",
//         cantidad: "2"},
//         {id_problema:82,
//         letra_fabrica: "B",
//         num_bodega: "1",
//         cantidad: "2"},
//         {id_problema: "82",
//         letra_fabrica: "B",
//         num_bodega: "2",
//         cantidad: "2"},
//         {id_problema: "82",
//         letra_fabrica: "C",
//         num_bodega: "0",
//         cantidad: "2"},
//         {id_problema: "82",
//         letra_fabrica: "C",
//         num_bodega: "1",
//         cantidad: "2"},
//         {id_problema: "82",
//         letra_fabrica: "C",
//         num_bodega: "2",
//         cantidad: "2"}
//     ],
//     bodega: 
//     [{id_problema: "82",
//     num_bodega: "0",
//     capacidad: "2"},
//     {id_problema: "82",
//     num_bodega: "1",
//     capacidad: "2"},
//     {id_problema: "82",
//     num_bodega: "2",
//     capacidad: "2"}
//     ],
//     costo: 
//     [{monto: "2",
//     id_problema: "82",
//     letra_fabrica: "A",
//     num_bodega: "0"},
//     {monto: "2",
//     id_problema: "82",
//     letra_fabrica: "A",
//     num_bodega: "1"},
//     {monto: "2",
//     id_problema: "82",
//     letra_fabrica: "A",
//     num_bodega: "2"},
//     {monto: "2",
//     id_problema: "82",
//     letra_fabrica: "B",
//     num_bodega: "0"},
//     {monto: "2",
//     id_problema: "82",
//     letra_fabrica: "B",
//     num_bodega: "1"},
//     {monto: "2",
//     id_problema: "82",
//     letra_fabrica: "B",
//     num_bodega: "2"},
//     {monto: "2",
//     id_problema: "82",
//     letra_fabrica: "C",
//     num_bodega: "0"},
//     {monto: "2",
//     id_problema: "82",
//     letra_fabrica: "C",
//     num_bodega: "1"},
//     {monto: "2",
//     id_problema: "82",
//     letra_fabrica: "C",
//     num_bodega: "2"}
//     ],
//     solucion: [{id_problema: "82",
//     id_metodo: "1",
//     costo_total: "18"}]}
