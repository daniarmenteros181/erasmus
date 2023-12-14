<?php
require_once '../repositorio/convocatoriaRepo.php';
require_once '../repositorio/db.php';

class guardarActualizacion {

    public static function guardar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $id = $_POST['id'];

            // Obtener datos actualizados del formulario
            $movilidades = $_POST['movilidades']; // Ajusta según los campos que tengas en tu formulario
            $tipo = $_POST['tipo'];
            $fechaInicio = $_POST['fechaInicio'];
            $fechaFin = $_POST['fechaFin'];
            $fechaInicioPrueba = $_POST['fechaInicioPrueba'];
            $fechaFinPrueba = $_POST['fechaFinPrueba'];
            $fechaInicioDefinitiva = $_POST['fechaInicioDefinitiva'];

            // Llamar a la función para actualizar la convocatoria
           ConvocatoriaRepo::actualizarConvocatoria($id, $movilidades, $tipo, $fechaInicio, $fechaFin, $fechaInicioPrueba, $fechaFinPrueba, $fechaInicioDefinitiva);


            // Redirigir a la página principal o a donde desees después de actualizar
            header('Location: ?menu:administrarConvocatorias');  // Ajusta el nombre de tu página principal
            exit();
        }
    }
}


guardarActualizacion::guardar();
?>
