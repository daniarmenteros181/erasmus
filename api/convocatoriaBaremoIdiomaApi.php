<?php
require_once('../repositorio/db.php');
require_once('../repositorio/ConvocatoriaBaremoIdiomaRepo.php');

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!empty($_GET['id'])) {
        $id = intval($_GET['id']);
        $convocatoriaBaremoIdioma = ConvocatoriaBaremoIdiomaRepo::leerConvocatoriaBaremoIdiomaPorId($id);
        echo json_encode(['convocatoriaBaremoIdioma' => $convocatoriaBaremoIdioma]);
    }
    else {
        $todasLasConvocatoriasBaremoIdioma = ConvocatoriaBaremoIdiomaRepo::leerTodasLasConvocatoriasBaremoIdioma();
        echo json_encode(['todasLasConvocatoriasBaremoIdioma' => $todasLasConvocatoriasBaremoIdioma]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $datos = json_decode(file_get_contents("php://input"));


        $nuevaAsociacion = ConvocatoriaBaremoIdiomaRepo::crearConvocatoriaBaremoIdioma(
            $datos->fkNivelesIdiomas,
            $datos->fkConvocatoriaBaremo,
            $datos->valor
        );

        // Enviar la respuesta
        echo json_encode(['convocatoriaBaremoIdioma' => $nuevaAsociacion]);
    } catch (Exception $e) {
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(['error' => 'Error en la aplicación: ' . $e->getMessage()]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    try {
        $idAsociacion = $_GET['id']; 

        $resultado = ConvocatoriaBaremoIdiomaRepo::borrarConvocatoriaBaremoIdioma($idAsociacion);

        echo json_encode(['resultado' => $resultado]);
    } catch (Exception $e) {
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(['error' => 'Error en la aplicación: ' . $e->getMessage()]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    try {
        $datos = json_decode(file_get_contents("php://input"));


        $resultado = ConvocatoriaBaremoIdiomaRepo::actualizarConvocatoriaBaremoIdioma(
            $datos->id,
            $datos->fkNivelesIdiomas,
            $datos->fkConvocatoriaBaremo,
            $datos->valor
        );

        echo json_encode(['resultado' => $resultado]);
    } catch (Exception $e) {
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(['error' => 'Error en la aplicación: ' . $e->getMessage()]);
    }
} else {
    header('HTTP/1.0 405 Method Not Allowed');
    echo json_encode(['error' => 'Método no permitido']);
}
?>
