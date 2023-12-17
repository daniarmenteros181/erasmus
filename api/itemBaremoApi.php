<?php

require_once('../repositorio/db.php');
require_once('../repositorio/itemBaremoRepo.php');

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Obtener ítems del baremo por ID de convocatoria
    if (!empty($_GET['idConvocatoriaBaremo'])) {
        $idConvocatoriaBaremo = intval($_GET['idConvocatoriaBaremo']);
        $itemsBaremo = ItemBaremoRepo::obtenerItemsPorConvocatoriaBaremo($idConvocatoriaBaremo);
        echo json_encode(['itemsBaremo' => $itemsBaremo]);
    }
    // Obtener ítem del baremo por ID
    elseif (!empty($_GET['id'])) {
        $id = intval($_GET['id']);
        $itemBaremo = ItemBaremoRepo::obtenerItemPorId($id);
        echo json_encode(['itemBaremo' => $itemBaremo]);
    }
    // Obtener todos los ítems del baremo
    else {
        $todosLosItems = ItemBaremoRepo::obtenerTodosLosItems();
        echo json_encode(['todosLosItems' => $todosLosItems]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Crear un nuevo ítem del baremo
    try {
        // Obtener datos del cuerpo de la solicitud
        $datos = json_decode(file_get_contents("php://input"));

        // Validar los datos según tus necesidades

        // Crear un nuevo ítem del baremo
        $nuevoItemBaremo = ItemBaremoRepo::crearItemBaremo($datos);

        // Enviar la respuesta
        echo json_encode(['itemBaremo' => $nuevoItemBaremo]);
    } catch (PDOException $e) {
        // Manejar errores de la base de datos según tus necesidades
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    // Eliminar un ítem del baremo por ID
    try {
        // Obtener el ID del ítem del baremo a eliminar
        $idItemBaremo = $_GET['id']; // Ajusta esto según cómo manejas los parámetros

        // Eliminar el ítem del baremo
        $resultado = ItemBaremoRepo::eliminarItemBaremo($idItemBaremo);

        // Enviar la respuesta
        echo json_encode(['resultado' => $resultado]);
    } catch (PDOException $e) {
        // Manejar errores de la base de datos según tus necesidades
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    // Actualizar un ítem del baremo por ID
    try {
        // Obtener datos del cuerpo de la solicitud
        $datos = json_decode(file_get_contents("php://input"));

        // Validar los datos según tus necesidades

        // Actualizar el ítem del baremo
        $resultado = ItemBaremoRepo::actualizarItemBaremo($datos);

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