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
    try {
        $datos = json_decode(file_get_contents("php://input"));


        $nuevoDestinatario = DestinatarioRepo::crearDestinatario($datos->cod_grupo, $datos->nombre);

        echo json_encode(['destinatario' => $nuevoDestinatario]);
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    // Eliminar un destinatario por ID
    try {
        $idDestinatario = $_GET['id']; 

        // Eliminar el destinatario
        $resultado = DestinatarioRepo::borrarDestinatario($idDestinatario);

        // Enviar la respuesta
        echo json_encode(['resultado' => $resultado]);
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Método no permitido']);
}
?>
