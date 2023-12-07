<?php

require_once '../repositorio/convocatoriaRepo.php'; 
require_once '../repositorio/candidatosConvocatoriaRepo.php'; 
require_once '../repositorio/db.php'; 
require_once '../helpers/sesion.php'; 

sesion::iniciaSesion();

class seleccionConvocatoria {

    public static function comenzar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['crear'])) {
            // Obtener los valores necesarios del formulario
            $idConvo = $_POST['id_convo'];  // Asegúrate de que estos nombres coincidan con los utilizados en el formulario
            $idCandidatos = $_POST['id_candidato'];  // Asegúrate de que estos nombres coincidan con los utilizados en el formulario

            // Insertar en la tabla candidatosconvocatoria
            candidatosConvocatoriaRepo::insertarCandidatoConvocatoria($idCandidatos, $idConvo);
            echo "Solicitud creada correctamente.";
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $idConvo = $_POST['id'];

            // Obtener datos existentes de la convocatoria
            echo("convocatoria:  ,$idConvo        ");

            $id = convocatoriaRepo::obtenerIdDestinatario();

            echo "Crear una solicitud para la convocatoria $idConvo con dni de candidato $id";

            echo "<td>";
            echo "<form method='post' action=''>";  
            echo "<input type='hidden' name='id_convo' value='$idConvo'>";
            echo "<input type='hidden' name='id_candidato' value='$id'>";
            echo "<input type='submit' name='crear' value='Crear'>";
            echo "</form>";
            echo "</td>";
        } 
    }
}

seleccionConvocatoria::comenzar();

?>
