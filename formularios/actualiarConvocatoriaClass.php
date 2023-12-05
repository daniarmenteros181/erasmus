<?php

require_once '../repositorio/convocatoriaRepo.php'; 
require_once '../repositorio/db.php'; 


class actualiarConvocatoriaClass {

// borrar_convocatoria.php
public static function comenzar(){



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Obtener datos existentes de la convocatoria
    $convocatoria = ConvocatoriaRepo::leerConvocatoriaPorId($id);

    // Mostrar formulario con datos existentes para permitir la actualización
    self::mostrarFormulario($convocatoria);


    // Llamar a la función para actualizar la convocatoria
 
} 


}
private static function mostrarFormulario($convocatoria) {
    // Aquí debes mostrar el formulario con los datos existentes
    // Puedes utilizar $convocatoria para obtener los valores actuales

    echo "<form method='post' action='../formularios/guardarActualizacion.php'>";
    echo "<input type='hidden' name='id' value='" . $convocatoria['id'] . "'>";

    // Añade más campos para los datos existentes, por ejemplo:
    echo "Movilidades: <input type='text' name='movilidades' value='" . $convocatoria['movilidades'] . "'>";
    echo "Tipo: <input type='text' name='tipo' value='" . $convocatoria['tipo'] . "'>";
    echo "Fecha Inicio: <input type='text' name='fechaInicio' value='" . $convocatoria['fechaInicio'] . "'>";
    // Repite esto para otros campos

    echo "<input type='submit' value='Guardar'>";
    echo "</form>";
}

}

actualiarConvocatoriaClass::comenzar();


?>
