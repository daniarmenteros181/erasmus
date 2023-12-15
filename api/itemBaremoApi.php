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
} else {
    // Método no permitido
    header('HTTP/1.0 405 Method Not Allowed');
    echo json_encode(['error' => 'Método no permitido']);
}
