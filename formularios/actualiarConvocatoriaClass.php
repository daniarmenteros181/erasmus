<?php


class actualiarConvocatoriaClass {

public static function comenzar(){

    mostrarMenu::mostrarMenuAdmin();



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Obtener datos existentes de la convocatoria
    $convocatoria = ConvocatoriaRepo::leerConvocatoriaPorId($id);

    // Mostrar formulario con datos existentes para permitir la actualización
    self::mostrarFormulario($convocatoria);

    


 
} 


}
private static function mostrarFormulario($convocatoria) {
    // formulario con los datos existentes

    echo "<div id='form-container'>";
    echo "<form method='post' id='deAct' action='../formularios/guardarActualizacion.php'>";
    echo "<input type='hidden' name='id' value='" . $convocatoria['id'] . "'>";

    echo "<link rel='stylesheet' href='../estilos/actualizacionConvocatoria.css'>";

    echo("<h1>Formulario de Actualiacion</h1>");

    echo"<div class='form-group'>";
    echo "Movilidades: <input type='text' name='movilidades' value='" . $convocatoria['movilidades'] . "'>";
    echo" </div>";
    
    echo"<div class='form-group'>";
    echo "Tipo: <input type='text' name='tipo' value='" . $convocatoria['tipo'] . "'>";
    echo" </div>";
    
    echo"<div class='form-group'>";
    echo "Fecha Inicio: <input type='text' name='fechaInicio' value='" . $convocatoria['fechaInicio'] . "'>";
    echo" </div>";
    
    echo"<div class='form-group'>";
    echo "Fecha Fin: <input type='text' name='fechaFin' value='" . $convocatoria['fechaFin'] . "'>";
    echo" </div>";
    
    echo"<div class='form-group'>";
    echo "Fecha Inicio Prueba: <input type='text' name='fechaInicioPrueba' value='" . $convocatoria['fechaInicioPrueba'] . "'>";
    echo" </div>";
    
    echo"<div class='form-group'>";
    echo "Fecha Fin Prueba: <input type='text' name='fechaFinPrueba' value='" . $convocatoria['fechaFinPrueba'] . "'>";
    echo" </div>";
   
    echo"<div class='form-group'>";
    echo "Fecha Inicio Definitiva: <input type='text' name='fechaInicioDefinitiva' value='" . $convocatoria['fechaInicioDefinitiva'] . "'>";
    echo" </div>";
   

    echo "<input type='submit' value='Guardar'>";
    echo "</form>";
    echo "</div>";

}

}

actualiarConvocatoriaClass::comenzar();


?>
