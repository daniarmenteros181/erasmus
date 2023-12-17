<?php

class administrarConvocatorias{

    public static function comienzo(){
        mostrarMenu::mostrarMenuAdmin();


        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $id = $_POST['id'];

            // Obtener datos actualizados del formulario
            $movilidades = $_POST['movilidades']; 
            $tipo = $_POST['tipo'];
            $fechaInicio = $_POST['fechaInicio'];
            $fechaFin = $_POST['fechaFin'];
            $fechaInicioPrueba = $_POST['fechaInicioPrueba'];
            $fechaFinPrueba = $_POST['fechaFinPrueba'];
            $fechaInicioDefinitiva = $_POST['fechaInicioDefinitiva'];

            // Llamar a la función para actualizar la convocatoria
           ConvocatoriaRepo::actualizarConvocatoria($id, $movilidades, $tipo, $fechaInicio, $fechaFin, $fechaInicioPrueba, $fechaFinPrueba, $fechaInicioDefinitiva);


            // Redirigir a la página 
            header('Location: ?menu=administrarConvocatorias');  
            exit();
        }


        convocatoriaRepo::mostrarConvocatoriasCrud(); 


    }

}


administrarConvocatorias::comienzo();


?>
