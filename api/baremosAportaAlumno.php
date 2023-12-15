<?php


require_once('../repositorio/db.php'); // Asegúrate de proporcionar la ruta correcta


if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    try {
        $conexion = db::entrar();

        // Obtener el valor del parámetro idConvo de la URL
        $idConvo = isset($_GET['idConvo']) ? intval($_GET['idConvo']) : null;

        if ($idConvo !== null) {
            // Obtener los baremos con aportaAlumno de la convocatoria
            $query = "SELECT b.fk_item_baremo, i.nombre AS nombreItemBaremo
                      FROM convocatoriabaremo b
                      INNER JOIN itembaremo i ON b.fk_item_baremo = i.id
                      WHERE b.id_convocatoria = :idConvo AND b.aportaAlumno = 1";

            $statement = $conexion->prepare($query);
            $statement->bindParam(':idConvo', $idConvo, PDO::PARAM_INT);
            $statement->execute();

            $resultados = $statement->fetchAll(PDO::FETCH_ASSOC);

            // Convertir a JSON y enviar la respuesta
            header('Content-type: application/json');
            echo json_encode(['baremos' => $resultados]);
        } else {
            // Si no se proporcionó un idConvo válido en la URL
            header('HTTP/1.0 400 Bad Request');
            echo json_encode(['error' => 'ID de convocatoria no válido proporcionado']);
        }
    } catch (PDOException $e) {
        // Manejar errores de la base de datos
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
}
