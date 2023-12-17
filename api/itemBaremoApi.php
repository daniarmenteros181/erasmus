<?php

require_once('../repositorio/db.php');
require_once('../repositorio/itemBaremoRepo.php');

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!empty($_GET['idConvocatoriaBaremo'])) {
        $idConvocatoriaBaremo = intval($_GET['idConvocatoriaBaremo']);
        $itemsBaremo = ItemBaremoRepo::obtenerItemsPorConvocatoriaBaremo($idConvocatoriaBaremo);
        echo json_encode(['itemsBaremo' => $itemsBaremo]);
    }
    elseif (!empty($_GET['id'])) {
        $id = intval($_GET['id']);
        $itemBaremo = ItemBaremoRepo::obtenerItemPorId($id);
        echo json_encode(['itemBaremo' => $itemBaremo]);
    }
    else {
        $todosLosItems = ItemBaremoRepo::obtenerTodosLosItems();
        echo json_encode(['todosLosItems' => $todosLosItems]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $datos = json_decode(file_get_contents("php://input"));


        $nuevoItemBaremo = ItemBaremoRepo::crearItemBaremo($datos);

        echo json_encode(['itemBaremo' => $nuevoItemBaremo]);
    } catch (PDOException $e) {
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    try {
        $idItemBaremo = $_GET['id'];

        $resultado = ItemBaremoRepo::eliminarItemBaremo($idItemBaremo);

        echo json_encode(['resultado' => $resultado]);
    } catch (PDOException $e) {
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    try {
        $datos = json_decode(file_get_contents("php://input"));


        $resultado = ItemBaremoRepo::actualizarItemBaremo($datos);

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