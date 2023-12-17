<?php
require_once('../repositorio/db.php');
require_once('../repositorio/DestinatarioRepo.php');

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Obtener destinatario por ID
    if (!empty($_GET['id'])) {
        $id = intval($_GET['id']);
        $destinatario = DestinatarioRepo::leerDestinatarioPorId($id);
        echo json_encode(['destinatario' => $destinatario]);
    }
    // Obtener todos los destinatarios
    else {
        $todosLosDestinatarios = DestinatarioRepo::leerTodosLosDestinatarios();
        echo json_encode(['todosLosDestinatarios' => $todosLosDestinatarios]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Crear un nuevo destinatario
    try {
        // Obtener datos del cuerpo de la solicitud
        $datos = json_decode(file_get_contents("php://input"));

        // Validar los datos según tus necesidades

        // Crear un nuevo destinatario
        $nuevoDestinatario = DestinatarioRepo::crearDestinatario($datos->cod_grupo, $datos->nombre);

        // Enviar la respuesta
        echo json_encode(['destinatario' => $nuevoDestinatario]);
    } catch (PDOException $e) {
        // Manejar errores de la base de datos según tus necesidades
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    // Eliminar un destinatario por ID
    try {
        // Obtener el ID del destinatario a eliminar
        $idDestinatario = $_GET['id']; // Ajusta esto según cómo manejas los parámetros

        // Eliminar el destinatario
        $resultado = DestinatarioRepo::borrarDestinatario($idDestinatario);

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
