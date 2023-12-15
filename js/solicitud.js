document.addEventListener('DOMContentLoaded', function () {
    // Obtener el ID del candidato 
    var idCandidato = document.getElementById('idCandidato').value;
    // Obtener la ID de la convocatoria 
    var idConvo = document.getElementById('idConvo').value;


    // Hacer la solicitud a la API para obtener los datos del candidato
     fetch(`http://erasmus.com/api/candidatosApi.php?id=${idCandidato}`)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                console.error('Error:', data.error);
            } else {
                // Llenar el formulario con los datos del candidato
                llenarFormulario(data.candidato);

                 // Obtener información de los baremos con aportaAlumno de la convocatoria
                 obtenerBaremosAportaAlumno(idConvo);
            }
        })
        .catch(error => console.error('Error en la solicitud:', error)); 











    // Agregar evento al formulario para el envío
    document.getElementById('candidatoForm').addEventListener('submit', function (event) {
        event.preventDefault(); // Evitar la acción predeterminada del formulario

        // Obtener los datos del formulario
        var formData = new FormData(document.getElementById('candidatoForm'));

        console.log(formData);

       // Convertir FormData a un objeto JSON
        var jsonData = {};
        formData.forEach((value, key) => {
            jsonData[key] = value;
        });


        // Hacer la solicitud a la API para actualizar los datos del candidato
            fetch('http://erasmus.com/api/candidatosApi.php', {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(jsonData)
        })




            
        // Hacer la solicitud a la API para crear la solicitud
        fetch('http://erasmus.com/api/candidatosConvocatoriaApi.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                id_candidatos: idCandidato,
                id_convocatoria: idConvo
            })
        })





/* mirar esto de aquiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
 *


/// Obtener el ID del candidato
/* var idCandidato = document.getElementById('idCandidato').value;
// Obtener la ID de la convocatoria
var idConvo = document.getElementById('idConvo').value;

// Crear un objeto FormData para enviar datos
var formData = new FormData();
formData.append('id_candidatos', idCandidato);
formData.append('id_convocatoria', idConvo); */

          // Hacer la solicitud a la API
    fetch('http://erasmus.com/api/baremacionApi.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
    })
    .catch(error => console.error('Error en la solicitud:', error));




































            


            });
});


// Función para llenar el formulario con los datos del candidato
function llenarFormulario(candidato) {
    document.getElementById('dni').value = candidato.dni;
    document.getElementById('fechaNac').value = candidato.fechaNac;
    document.getElementById('apellidos').value = candidato.apellidos;
    document.getElementById('nombre').value = candidato.nombre;
    document.getElementById('tlf').value = candidato.tlf;
    document.getElementById('correo').value = candidato.correo;
    document.getElementById('domicilio').value = candidato.domicilio;
    document.getElementById('fk_destinatario').value = candidato.fk_destinatario;
    document.getElementById('contrasenia').value = candidato.contrasenia;
    document.getElementById('rol').value = candidato.rol;
}


 // Función para obtener información de los baremos con aportaAlumno
 function obtenerBaremosAportaAlumno(idConvo) {
    fetch(`http://erasmus.com/api/baremosAportaAlumno.php?idConvo=${idConvo}`)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                console.error('Error:', data.error);
            } else {
                // Generar botones según los baremos con aportaAlumno
                generarBotonesBaremos(data.baremos);
            }
        })
        .catch(error => console.error('Error en la solicitud de baremos:', error));
}

// Función para generar botones según los baremos con aportaAlumno
function generarBotonesBaremos(baremos) {
    // Contenedor donde se agregarán los botones
    var contenedor = document.getElementById('contenedorItemBaremos');

    // Limpiar el contenedor antes de agregar nuevos elementos
    contenedor.innerHTML = '';

    // Iterar sobre los baremos y generar botones
    baremos.forEach(baremo => {
        // Crear un botón para seleccionar fichero
        var boton = document.createElement('input');
        boton.type = 'file';
        boton.name = `archivo_${baremo.fk_item_baremo}`;
        boton.id = `archivo_${baremo.fk_item_baremo}`;
        boton.accept = '.pdf'; // Establecer el tipo de archivo aceptado (puedes ajustarlo según tus necesidades)

        // Crear una etiqueta y un espacio para el nombre del baremo
        var etiqueta = document.createElement('label');
        etiqueta.htmlFor = `archivo_${baremo.fk_item_baremo}`;
        etiqueta.innerHTML = `Seleccione un archivo para ${baremo.nombreItemBaremo}:`;

        // Agregar elementos al contenedor
        contenedor.appendChild(etiqueta);
        contenedor.appendChild(boton);
        contenedor.appendChild(document.createElement('br')); // Añadir un salto de línea para separar los elementos
    });
}





/* // Función para subir archivos
function subirArchivo($archivo)
{
    // Lógica para subir el archivo a la ubicación deseada
    // Aquí puedes usar move_uploaded_file u otra lógica según tus necesidades

    // Ejemplo básico:
    $nombreArchivo = basename($archivo['name']);
    $rutaDestino = 'ruta/donde/quieres/guardar/' . $nombreArchivo;
    move_uploaded_file($archivo['tmp_name'], $rutaDestino);

    return $rutaDestino;
}

// Función para obtener el ID del item baremo desde el nombre del campo en el formulario
function obtenerIdItemBaremoDesdeNombreCampo($nombreCampo)
{
    // Implementa la lógica necesaria para obtener el ID del item baremo según el nombre del campo
    // Puedes realizar una consulta a la base de datos o utilizar una lógica predefinida
    // Retorna el ID del item baremo correspondiente

    // Ejemplo básico:
    // Supongamos que los nombres de los campos son "archivo_1", "archivo_2", etc.
    // Entonces, extraemos el número del nombre del campo
    $numeroCampo = str_replace('archivo_', '', $nombreCampo);
    return intval($numeroCampo);
} */