<?php


require_once('../repositorio/db.php'); 
require_once('../repositorio/tutorRepo.php'); 


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

elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    try {
        // Obtener la conexión a la base de datos utilizando la clase db
        $conexion = db::entrar();

        // Obtener el ID del tutor a eliminar
        $idTutor = $_GET['id']; // Ajusta esto según cómo manejas los parámetros

        // Eliminar el tutor
        $resultado = TutorRepo::borrarTutor($idTutor);

        // Enviar la respuesta
        header('Content-type: application/json');
        echo json_encode(['resultado' => $resultado]);
    } catch (PDOException $e) {
        // Manejar errores de la base de datos según tus necesidades
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
}

elseif ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    try {
        // Obtener la conexión a la base de datos utilizando la clase db
        $conexion = db::entrar();

        // Obtener datos del cuerpo de la solicitud
        $datos = json_decode(file_get_contents("php://input"));

        // Validar los datos según tus necesidades

        // Actualizar el tutor
        $resultado = TutorRepo::actualizarTutor($datos);

        // Enviar la respuesta
        header('Content-type: application/json');
        echo json_encode(['resultado' => $resultado]);
    } catch (PDOException $e) {
        // Manejar errores de la base de datos según tus necesidades
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
}
elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        // Obtener la conexión a la base de datos utilizando la clase db
        $conexion = db::entrar();

        // Obtener datos del cuerpo de la solicitud
        $datos = json_decode(file_get_contents("php://input"));

        // Validar los datos según tus necesidades

        // Crear un nuevo tutor
        $nuevoTutor = TutorRepo::crearTutor($datos);

        // Enviar la respuesta
        header('Content-type: application/json');
        echo json_encode(['tutor' => $nuevoTutor]);
    } catch (PDOException $e) {
        // Manejar errores de la base de datos según tus necesidades
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
}


