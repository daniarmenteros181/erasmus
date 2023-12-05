<?php

require_once '../repositorio/convocatoriaRepo.php'; 
require_once '../repositorio/db.php'; 


class seleccionConvocatoria {

// borrar_convocatoria.php
public static function comenzar(){



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Obtener datos existentes de la convocatoria
    echo($id);
    // Mostrar formulario con datos existentes para permitir la actualización
/*     echo "<input type='hidden' name='id' value='" . $fila['id'] . "'>";
 */

    // Llamar a la función para actualizar la convocatoria
 
} 


}


}

seleccionConvocatoria::comenzar();


?>
