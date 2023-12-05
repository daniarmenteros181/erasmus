<?php


require_once('../repositorio/db.php'); // Asegúrate de proporcionar la ruta correcta
require_once('../repositorio/tutorRepo.php'); // Asegúrate de proporcionar la ruta correcta


if ($_SERVER['REQUEST_METHOD']=='GET')	{
try {
    // Obtener la conexión a la base de datos utilizando la clase db
    $conexion = db::entrar();

    
    $tutor = TutorRepo::leerTodosLosTutores();



 
    // Verificar si se encontraron tutores
    if ($tutor) {
        // Convertir a JSON y enviar la respuesta
        header('Content-type: application/json');
        echo json_encode(['tutor' => $tutor]);
    } else {
        // Si no se encuentran categorías, puedes manejarlo según tus necesidades
        header('HTTP/1.0 404 Not Found');
        echo json_encode(array('error' => 'No se encontraron categorías'));
    }
} catch (PDOException $e) {
    // Manejar errores de la base de datos según tus necesidades
    header('HTTP/1.1 500 Internal Server Error');
    echo json_encode(array('error' => 'Error en la base de datos: ' . $e->getMessage()));
}
}