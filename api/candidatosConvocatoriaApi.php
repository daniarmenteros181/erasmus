<?php


require_once('../repositorio/db.php'); 
require_once('../repositorio/candidatosConvocatoriaRepo.php'); 


if ($_SERVER['REQUEST_METHOD']=='POST')	{
try {
    $conexion = db::entrar();

    $datos_post = json_decode(file_get_contents("php://input"));


    $id_convocatoria = $datos['id_convocatoria'];
    $id_candidatos = $datos['id_candidatos'];


     if (isset($datos_post->id_candidatos) && isset($datos_post->id_convocatoria)) {
        
        candidatosConvocatoriaRepo::insertarCandidatoConvocatoria($datos_post->id_candidatos, $datos_post->id_convocatoria);



        echo json_encode(['mensaje' => 'Candidato insertado en la convocatoria correctamente']);
    } else {
        echo json_encode(['error' => 'Datos no válidos']);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
}
    
}
