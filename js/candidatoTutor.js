
function mostrarFormularioTutor() {
    // Obtener la fecha seleccionada del input
    var fechaSeleccionada = document.getElementById('fechaNac').value;

    // Calcular la edad en base a la fecha seleccionada
    var hoy = new Date();
    var fechaNacimiento = new Date(fechaSeleccionada);
    var edad = hoy.getFullYear() - fechaNacimiento.getFullYear();

    // Verificar si el usuario tiene menos de 18 años
    if (edad < 18) {
        // Mostrar el formulario del tutor
        document.getElementById('formularioTutor').style.display = 'block';
    } else {
        // Ocultar el formulario del tutor
        document.getElementById('formularioTutor').style.display = 'none';
    }
}
