<?php
require_once('../repositorio/db.php');
require_once('../repositorio/NivelesIdiomasRepo.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    try {
        // Obtener la conexión a la base de datos utilizando la clase db
        $conexion = db::entrar();

        $nivelesIdiomas = NivelesIdiomasRepo::leerTodosLosNivelesIdiomas();

        // Verificar si se encontraron niveles de idiomas
        if ($nivelesIdiomas) {
            // Convertir a JSON y enviar la respuesta
            header('Content-type: application/json');
            echo json_encode(['nivelesIdiomas' => $nivelesIdiomas]);
        } else {
            // Si no se encuentran niveles de idiomas, puedes manejarlo según tus necesidades
            header('HTTP/1.0 404 Not Found');
            echo json_encode(['error' => 'No se encontraron niveles de idiomas']);
        }
    } catch (PDOException $e) {
        // Manejar errores de la base de datos según tus necesidades
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        // Obtener la conexión a la base de datos utilizando la clase db
        $conexion = db::entrar();

        // Obtener datos del cuerpo de la solicitud
        $datos = json_decode(file_get_contents("php://input"));

        // Validar los datos según tus necesidades

        // Crear un nuevo nivel de idioma
        $nuevoNivelIdioma = NivelesIdiomasRepo::crearNivelIdioma($datos);

        // Enviar la respuesta
        header('Content-type: application/json');
        echo json_encode(['nivelIdioma' => $nuevoNivelIdioma]);
    } catch (PDOException $e) {
        // Manejar errores de la base de datos según tus necesidades
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    try {
        // Obtener la conexión a la base de datos utilizando la clase db
        $conexion = db::entrar();

        // Obtener el ID del nivel de idioma a eliminar
        $idNivelIdioma = $_GET['id']; // Ajusta esto según cómo manejas los parámetros

        // Eliminar el nivel de idioma
        $resultado = NivelesIdiomasRepo::borrarNivelIdioma($idNivelIdioma);

        // Enviar la respuesta
        header('Content-type: application/json');
        echo json_encode(['resultado' => $resultado]);
    } catch (PDOException $e) {
        // Manejar errores de la base de datos según tus necesidades
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    try {
        // Obtener la conexión a la base de datos utilizando la clase db
        $conexion = db::entrar();

        // Obtener datos del cuerpo de la solicitud
        $datos = json_decode(file_get_contents("php://input"));

        // Validar los datos según tus necesidades

        // Actualizar el nivel de idioma
        $resultado = NivelesIdiomasRepo::actualizarNivelIdioma($datos);

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
