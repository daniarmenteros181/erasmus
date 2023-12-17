<?php

class administrarSolicitudes {

    public static function comienzo() {
        mostrarMenu::mostrarMenuAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $id = $_POST['id'];

            // Obtener datos actualizados del formulario
            $fk_candidatos_baremacion = $_POST['fk_candidatos_baremacion']; // Ajusta según los campos que tengas en tu formulario
            $tipo = $_POST['tipo'];
            $fk_convocatorias_baremacion = $_POST['fk_convocatorias_baremacion'];
            $fk_item_baremo = $_POST['fk_item_baremo'];
            $notas = $_POST['notas'];
            $url = $_POST['url'];

            // Llamar a la función para actualizar la convocatoria
            baremacionRepo::actualizarBaremacion($id, $fk_candidatos_baremacion, $fk_convocatorias_baremacion, $fk_item_baremo, $notas, $url);


            // Redirigir a la página principal o a donde desees después de actualizar
            header('Location: ?menu=administrarSolicitudes');  // Ajusta el nombre de tu página principal
            exit();
        }

        // Leer todos los registros de baremacion
       baremacionRepo::mostrarBaremacionCrud();
        

       
    }
}

administrarSolicitudes::comienzo();

?>
