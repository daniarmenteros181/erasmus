<?php
require_once('../repositorio/db.php');
require_once('../repositorio/DestinatarioConvocatoriaRepo.php');

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!empty($_GET['idDestinatario']) && !empty($_GET['idConvocatoria'])) {
        $idDestinatario = intval($_GET['idDestinatario']);
        $idConvocatoria = intval($_GET['idConvocatoria']);
        $asociaciones = DestinatarioConvocatoriaRepo::obtenerAsociacionesPorDestinatarioYConvocatoria($idDestinatario, $idConvocatoria);
        echo json_encode(['asociaciones' => $asociaciones]);
    }
    elseif (!empty($_GET['id'])) {
        $id = intval($_GET['id']);
        $asociacion = DestinatarioConvocatoriaRepo::leerDestinatarioConvocatoriaPorId($id);
        echo json_encode(['asociacion' => $asociacion]);
    }
    else {
        $todasLasAsociaciones = DestinatarioConvocatoriaRepo::leerTodasLasDestinatarioConvocatorias();
        echo json_encode(['todasLasAsociaciones' => $todasLasAsociaciones]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $datos = json_decode(file_get_contents("php://input"));


        $nuevaAsociacion = DestinatarioConvocatoriaRepo::crearDestinatarioConvocatoria($datos);

        echo json_encode(['asociacion' => $nuevaAsociacion]);
    } catch (PDOException $e) {
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    try {
        $idAsociacion = $_GET['id']; 

        $resultado = DestinatarioConvocatoriaRepo::borrarDestinatarioConvocatoria($idAsociacion);

        echo json_encode(['resultado' => $resultado]);
    } catch (PDOException $e) {
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    try {
        $datos = json_decode(file_get_contents("php://input"));


        $resultado = DestinatarioConvocatoriaRepo::actualizarDestinatarioConvocatoria($datos);

        echo json_encode(['resultado' => $resultado]);
    } catch (PDOException $e) {
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
} else {
    header('HTTP/1.0 405 Method Not Allowed');
    echo json_encode(['error' => 'Método no permitido']);
}
?>
