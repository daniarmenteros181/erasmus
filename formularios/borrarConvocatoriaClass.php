<?php

require_once '../repositorio/convocatoriaRepo.php'; // Reemplaza 'ruta_al_archivo_de_ConvocatoriaRepo.php' con la ruta correcta
require_once '../repositorio/db.php'; // Reemplaza 'ruta_al_archivo_de_ConvocatoriaRepo.php' con la ruta correcta


class borrarConvocatoriaClass {

// borrar_convocatoria.php
public static function comenzar(){



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];


    // Llamar a la función para borrar la convocatoria
    ConvocatoriaRepo::borrarConvocatoria($id);
 
    // Redirigir a la página principal o a donde desees después de borrar
} 

}

}

borrarConvocatoriaClass::comenzar();


?>
