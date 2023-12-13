<?php


require_once('../repositorio/db.php'); // Asegúrate de proporcionar la ruta correcta
require_once('../repositorio/candidatosConvocatoriaRepo.php'); // Asegúrate de proporcionar la ruta correcta


if ($_SERVER['REQUEST_METHOD']=='POST')	{
try {
    $conexion = db::entrar();

    $datos_post = json_decode(file_get_contents("php://input"));


    $id_convocatoria = $datos['id_convocatoria'];
    $id_candidatos = $datos['id_candidatos'];


     // Verificar si se proporcionaron datos válidos
     if (isset($datos_post->id_candidatos) && isset($datos_post->id_convocatoria)) {
        // Llamar a la función para insertar candidato en la convocatoria
        candidatosConvocatoriaRepo::insertarCandidatoConvocatoria($datos_post->id_candidatos, $datos_post->id_convocatoria);

        // Enviar respuesta de éxito
        header('Content-type: application/json');
        echo json_encode(['mensaje' => 'Candidato insertado en la convocatoria correctamente']);
    } else {
        // Enviar respuesta de error si los datos no son válidos
        header('HTTP/1.0 400 Bad Request');
        echo json_encode(['error' => 'Datos no válidos']);
    }
} catch (PDOException $e) {
    // Manejar errores de la base de datos según tus necesidades
    header('HTTP/1.1 500 Internal Server Error');
    echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
}
    
}
