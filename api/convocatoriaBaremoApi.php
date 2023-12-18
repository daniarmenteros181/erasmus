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
                echo json_encode(['convocatoriaBaremo' => $convocatoriaBaremo]);
            } else {
                echo json_encode(['error' => 'No se encontró convocatoriaBaremo para id_convocatoria ' . $id_convocatoria]);
            }
        } else {
            echo json_encode(['error' => 'Parámetro "id_convocatoria" no proporcionado']);
        }

        
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
} 
