<?php
require_once('../repositorio/db.php');
require_once('../repositorio/convocatoriaRepo.php');

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!empty($_GET['id'])) {
        $id = intval($_GET['id']);
        $convocatoriaBaremoIdioma = convocatoriaRepo::leerConvocatoriaPorId($id);
        echo json_encode(['convocatoriaBaremoIdioma' => $convocatoriaBaremoIdioma]);
    }
    else {
        $todasLasConvocatoriasBaremoIdioma = convocatoriaRepo::leerTodasLasConvocatorias();
        echo json_encode(['todasLasConvocatoriasBaremoIdioma' => $todasLasConvocatoriasBaremoIdioma]);
    }
}