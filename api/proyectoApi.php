<?php
require_once('../repositorio/db.php'); 
require_once('../repositorio/proyectoRepo.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    try {
        $conexion = db::entrar();

        $proyectos = ProyectoRepo::leerTodosLosProyectos();

        if ($proyectos) {
            header('Content-type: application/json');
            echo json_encode(['proyectos' => $proyectos]);
        } else {
            header('HTTP/1.0 404 Not Found');
            echo json_encode(['error' => 'No se encontraron proyectos']);
        }
    } catch (PDOException $e) {
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
}

elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $conexion = db::entrar();

        $datos = json_decode(file_get_contents("php://input"));


        $nuevoProyecto = ProyectoRepo::crearProyecto($datos);

        header('Content-type: application/json');
        echo json_encode(['proyecto' => $nuevoProyecto]);
    } catch (PDOException $e) {
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
}

elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    try {
        $conexion = db::entrar();

        $idProyecto = $_GET['id']; 

        $resultado = ProyectoRepo::eliminarProyecto($idProyecto);

        header('Content-type: application/json');
        echo json_encode(['resultado' => $resultado]);
    } catch (PDOException $e) {
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
}

elseif ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    try {
        $conexion = db::entrar();

        $datos = json_decode(file_get_contents("php://input"));


        $resultado = ProyectoRepo::actualizarProyecto($datos);

        header('Content-type: application/json');
        echo json_encode(['resultado' => $resultado]);
    } catch (PDOException $e) {
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
}
?>
