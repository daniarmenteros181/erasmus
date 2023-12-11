document.addEventListener('DOMContentLoaded', function () {
    // Obtener el ID del candidato desde la URL o de alguna otra fuente
    var idCandidato = document.getElementById('idCandidato').value;

    // Hacer la solicitud a la API para obtener los datos del candidato
    fetch(`http://erasmus.com/api/candidatosApi.php?id=${idCandidato}`)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                console.error('Error:', data.error);
            } else {
                // Llenar el formulario con los datos del candidato
                llenarFormulario(data.candidato);
                console.log('Datos del candidato:', data.candidato); // Agregado para depurar
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

            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    console.error('Error:', data.error);
                } else {
                    console.log('Datos del candidato actualizado:', data.candidato);
                    alert('Candidato actualizado correctamente');
                }
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
