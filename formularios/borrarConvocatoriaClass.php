<?php




class borrarConvocatoriaClass {

public static function comenzar(){



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];


    // Llamar a la función para borrar la convocatoria
    ConvocatoriaRepo::borrarConvocatoria($id);


 
    // Redirigir a la página 
     header("Location: ?menu=administrarConvocatorias");
     exit();
} 

}

}

borrarConvocatoriaClass::comenzar();


?>
