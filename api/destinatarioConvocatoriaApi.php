<?php
require_once('../repositorio/db.php');
require_once('../repositorio/DestinatarioConvocatoriaRepo.php');

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Obtener asociaciones por ID de destinatario y/o ID de convocatoria
    if (!empty($_GET['idDestinatario']) && !empty($_GET['idConvocatoria'])) {
        $idDestinatario = intval($_GET['idDestinatario']);
        $idConvocatoria = intval($_GET['idConvocatoria']);
        $asociaciones = DestinatarioConvocatoriaRepo::obtenerAsociacionesPorDestinatarioYConvocatoria($idDestinatario, $idConvocatoria);
        echo json_encode(['asociaciones' => $asociaciones]);
    }
    // Obtener asociación por ID
    elseif (!empty($_GET['id'])) {
        $id = intval($_GET['id']);
        $asociacion = DestinatarioConvocatoriaRepo::leerDestinatarioConvocatoriaPorId($id);
        echo json_encode(['asociacion' => $asociacion]);
    }
    // Obtener todas las asociaciones
    else {
        $todasLasAsociaciones = DestinatarioConvocatoriaRepo::leerTodasLasDestinatarioConvocatorias();
        echo json_encode(['todasLasAsociaciones' => $todasLasAsociaciones]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Crear una nueva asociación entre destinatario y convocatoria
    try {
        // Obtener datos del cuerpo de la solicitud
        $datos = json_decode(file_get_contents("php://input"));

        // Validar los datos según tus necesidades

        // Crear una nueva asociación
        $nuevaAsociacion = DestinatarioConvocatoriaRepo::crearDestinatarioConvocatoria($datos);

        // Enviar la respuesta
        echo json_encode(['asociacion' => $nuevaAsociacion]);
    } catch (PDOException $e) {
        // Manejar errores de la base de datos según tus necesidades
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    // Eliminar una asociación por ID
    try {
        // Obtener el ID de la asociación a eliminar
        $idAsociacion = $_GET['id']; // Ajusta esto según cómo manejas los parámetros

        // Eliminar la asociación
        $resultado = DestinatarioConvocatoriaRepo::borrarDestinatarioConvocatoria($idAsociacion);

        // Enviar la respuesta
        echo json_encode(['resultado' => $resultado]);
    } catch (PDOException $e) {
        // Manejar errores de la base de datos según tus necesidades
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    // Actualizar una asociación por ID
    try {
        // Obtener datos del cuerpo de la solicitud
        $datos = json_decode(file_get_contents("php://input"));

        // Validar los datos según tus necesidades

        // Actualizar la asociación
        $resultado = DestinatarioConvocatoriaRepo::actualizarDestinatarioConvocatoria($datos);

        // Enviar la respuesta
        echo json_encode(['resultado' => $resultado]);
    } catch (PDOException $e) {
        // Manejar errores de la base de datos según tus necesidades
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
} else {
    // Método no permitido
    header('HTTP/1.0 405 Method Not Allowed');
    echo json_encode(['error' => 'Método no permitido']);
}
?>
