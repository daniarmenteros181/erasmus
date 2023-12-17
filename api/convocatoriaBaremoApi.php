<?php

require_once('../repositorio/db.php');
require_once('../repositorio/convocatoriaBaremoRepo.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    try {
        $conexion = db::entrar();

        // Verificar si se proporcionó el parámetro id_convocatoria
        if (isset($_GET['id_convocatoria'])) {
            $id_convocatoria = $_GET['id_convocatoria'];

            // Obtener convocatoria baremo por id_convocatoria
            $convocatoriaBaremo = convocatoriaBaremoRepo::leerConvocatoriaBaremoPorId($id_convocatoria);

            if ($convocatoriaBaremo) {
                // Convertir a JSON y enviar la respuesta
                header('Content-type: application/json');
                echo json_encode(['convocatoriaBaremo' => $convocatoriaBaremo]);
            } else {
                header('HTTP/1.0 404 Not Found');
                echo json_encode(['error' => 'No se encontró convocatoriaBaremo para id_convocatoria ' . $id_convocatoria]);
            }
        } else {
            header('HTTP/1.0 400 Bad Request');
            echo json_encode(['error' => 'Parámetro "id_convocatoria" no proporcionado']);
        }

        
    } catch (PDOException $e) {
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
} 
