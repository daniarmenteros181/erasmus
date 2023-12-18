<?php


require_once('../repositorio/db.php'); 
require_once('../repositorio/tutorRepo.php'); 


if ($_SERVER['REQUEST_METHOD']=='GET')	{
try {
    $conexion = db::entrar();

    
    $tutor = TutorRepo::leerTodosLosTutores();



 
    if ($tutor) {
        header('Content-type: application/json');
        echo json_encode(['tutor' => $tutor]);
    } else {
        echo json_encode(array('error' => 'No se encontraron categorías'));
    }
} catch (PDOException $e) {
    echo json_encode(array('error' => 'Error en la base de datos: ' . $e->getMessage()));
}
}

elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    try {
        $conexion = db::entrar();

        $idTutor = $_GET['id']; 

        $resultado = TutorRepo::borrarTutor($idTutor);

        header('Content-type: application/json');
        echo json_encode(['resultado' => $resultado]);
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
}

elseif ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    try {
        $conexion = db::entrar();

        $datos = json_decode(file_get_contents("php://input"));


        $resultado = TutorRepo::actualizarTutor($datos);

        header('Content-type: application/json');
        echo json_encode(['resultado' => $resultado]);
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
}
elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $conexion = db::entrar();

        $datos = json_decode(file_get_contents("php://input"));


        $nuevoTutor = TutorRepo::crearTutor($datos);

        header('Content-type: application/json');
        echo json_encode(['tutor' => $nuevoTutor]);
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
}


