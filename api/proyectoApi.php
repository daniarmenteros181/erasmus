<?php
require_once('../repositorio/db.php'); 
require_once('../repositorio/proyectoRepo.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    try {
        // Obtener la conexión a la base de datos utilizando la clase db
        $conexion = db::entrar();

        $proyectos = ProyectoRepo::leerTodosLosProyectos();

        // Verificar si se encontraron proyectos
        if ($proyectos) {
            // Convertir a JSON y enviar la respuesta
            header('Content-type: application/json');
            echo json_encode(['proyectos' => $proyectos]);
        } else {
            // Si no se encuentran proyectos, puedes manejarlo según tus necesidades
            header('HTTP/1.0 404 Not Found');
            echo json_encode(['error' => 'No se encontraron proyectos']);
        }
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

        // Crear un nuevo proyecto
        $nuevoProyecto = ProyectoRepo::crearProyecto($datos);

        // Enviar la respuesta
        header('Content-type: application/json');
        echo json_encode(['proyecto' => $nuevoProyecto]);
    } catch (PDOException $e) {
        // Manejar errores de la base de datos según tus necesidades
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
}

elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    try {
        // Obtener la conexión a la base de datos utilizando la clase db
        $conexion = db::entrar();

        // Obtener el ID del proyecto a eliminar
        $idProyecto = $_GET['id']; // Ajusta esto según cómo manejas los parámetros

        // Eliminar el proyecto
        $resultado = ProyectoRepo::eliminarProyecto($idProyecto);

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

        // Actualizar el proyecto
        $resultado = ProyectoRepo::actualizarProyecto($datos);

        // Enviar la respuesta
        header('Content-type: application/json');
        echo json_encode(['resultado' => $resultado]);
    } catch (PDOException $e) {
        // Manejar errores de la base de datos según tus necesidades
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
}
?>
