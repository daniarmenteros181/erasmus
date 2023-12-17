<?php


class edicionBaremacion {

public static function comenzar(){

    mostrarMenu::mostrarMenuAdmin();



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Obtener datos existentes de la convocatoria
    $baremacion = baremacionRepo::leerBaremacionPorId($id);

    // Mostrar formulario con datos existentes para permitir la actualización
    self::mostrarFormulario($baremacion);

    


 
} 


}
private static function mostrarFormulario($baremacion) {
    // formulario con los datos existentes

    echo "<div id='form-container'>";
    echo "<form method='post' id='deAct' action='?menu=administrarSolicitudes'>";
    echo "<input type='hidden' name='id' value='" . $baremacion['id'] . "'>";

    echo "<link rel='stylesheet' href='../estilos/actualizacionConvocatoria.css'>";

    echo("<h1>Formulario de Actualiacion</h1>");

    echo"<div class='form-group'>";
    echo "fk_candidatos_baremacion: <input type='text' name='fk_candidatos_baremacion' value='" . $baremacion['fk_candidatos_baremacion'] . "'>";
    echo" </div>";
    
    echo"<div class='form-group'>";
    echo "fk_convocatorias_baremacion: <input type='text' name='fk_convocatorias_baremacion' value='" . $baremacion['fk_convocatorias_baremacion'] . "'>";
    echo" </div>";
    
    echo"<div class='form-group'>";
    echo "fk_item_baremo: <input type='text' name='fk_item_baremo' value='" . $baremacion['fk_item_baremo'] . "'>";
    echo" </div>";
    
    echo"<div class='form-group'>";
    echo "notas: <input type='text' name='notas' value='" . $baremacion['notas'] . "'>";
    echo" </div>";
    
    echo"<div class='form-group'>";
    echo "url: <input type='text' name='url' value='" . $baremacion['url'] . "'>";
    echo" </div>";
   

    echo "<input type='submit' value='Guardar'>";
    echo "</form>";
    echo "</div>";

}

}

edicionBaremacion::comenzar();


?>
