<?php

require_once('../repositorio/db.php');
require_once('../repositorio/convocatoriaBaremoRepo.php');

// Verificar el método de solicitud
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    try {
        // Obtener la conexión a la base de datos utilizando la clase db
        $conexion = db::entrar();

        // Verificar si se proporcionó el parámetro id_convocatoria
        if (isset($_GET['id_convocatoria'])) {
            $id_convocatoria = $_GET['id_convocatoria'];

            // Obtener convocatoria baremo por id_convocatoria
            $convocatoriaBaremo = convocatoriaBaremoRepo::leerConvocatoriaBaremoPorId($id_convocatoria);

            // Verificar si se encontró el convocatoriaBaremo
            if ($convocatoriaBaremo) {
                // Convertir a JSON y enviar la respuesta
                header('Content-type: application/json');
                echo json_encode(['convocatoriaBaremo' => $convocatoriaBaremo]);
            } else {
                // Manejar el caso cuando no se encuentra el convocatoriaBaremo
                header('HTTP/1.0 404 Not Found');
                echo json_encode(['error' => 'No se encontró convocatoriaBaremo para id_convocatoria ' . $id_convocatoria]);
            }
        } else {
            // Manejar el caso cuando no se proporciona el parámetro id_convocatoria
            header('HTTP/1.0 400 Bad Request');
            echo json_encode(['error' => 'Parámetro "id_convocatoria" no proporcionado']);
        }

        
    } catch (PDOException $e) {
        // Manejar errores de la base de datos según tus necesidades
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
} 
