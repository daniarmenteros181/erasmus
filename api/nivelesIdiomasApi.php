<?php
require_once('../repositorio/db.php');
require_once('../repositorio/NivelesIdiomasRepo.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    try {
        $conexion = db::entrar();

        $nivelesIdiomas = NivelesIdiomasRepo::leerTodosLosNivelesIdiomas();

        if ($nivelesIdiomas) {
            header('Content-type: application/json');
            echo json_encode(['nivelesIdiomas' => $nivelesIdiomas]);
        } else {
            header('HTTP/1.0 404 Not Found');
            echo json_encode(['error' => 'No se encontraron niveles de idiomas']);
        }
    } catch (PDOException $e) {
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $conexion = db::entrar();

        $datos = json_decode(file_get_contents("php://input"));


        $nuevoNivelIdioma = NivelesIdiomasRepo::crearNivelIdioma($datos);

        header('Content-type: application/json');
        echo json_encode(['nivelIdioma' => $nuevoNivelIdioma]);
    } catch (PDOException $e) {
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    try {
        $conexion = db::entrar();

        $idNivelIdioma = $_GET['id']; 

        $resultado = NivelesIdiomasRepo::borrarNivelIdioma($idNivelIdioma);

        header('Content-type: application/json');
        echo json_encode(['resultado' => $resultado]);
    } catch (PDOException $e) {
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    try {
        $conexion = db::entrar();

        $datos = json_decode(file_get_contents("php://input"));


        $resultado = NivelesIdiomasRepo::actualizarNivelIdioma($datos);

        header('Content-type: application/json');
        echo json_encode(['resultado' => $resultado]);
    } catch (PDOException $e) {
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
}
?>
