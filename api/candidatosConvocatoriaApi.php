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



        header('Content-type: application/json');
        echo json_encode(['mensaje' => 'Candidato insertado en la convocatoria correctamente']);
    } else {
        header('HTTP/1.0 400 Bad Request');
        echo json_encode(['error' => 'Datos no válidos']);
    }
} catch (PDOException $e) {
    header('HTTP/1.1 500 Internal Server Error');
    echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
}
    
}
