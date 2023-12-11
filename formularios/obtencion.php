<?php


require_once '../repositorio/convocatoriaRepo.php'; 
require_once '../repositorio/candidatosConvocatoriaRepo.php'; 
require_once '../repositorio/candidatosRepo.php'; 
require_once '../repositorio/db.php'; 
require_once '../helpers/sesion.php';

sesion::iniciaSesion();


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $idConvo = $_POST['id'];

    // Obtener datos existentes de la convocatoria
/*     echo("convocatoria:  ,$idConvo");*/

   $idCandidato = convocatoriaRepo::obtenerIdCandidato();



      /* // Obtener los datos del candidato por ID
    $candidato = CandidatosRepo::leerCandidatoPorId($id);

    echo "Crear una solicitud para la convocatoria $idConvo con dni de candidato $id"; */

     // Redirigir a la clase seleccionConvocatoria con los parámetros de ID
     header("Location: seleccionConvocatoria.php?idConvo=$idConvo&idCandidato=$idCandidato");
     exit();

               
} 