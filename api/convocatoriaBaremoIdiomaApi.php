<?php
require_once('../repositorio/db.php');
require_once('../repositorio/ConvocatoriaBaremoIdiomaRepo.php');

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Obtener asociación por ID
    if (!empty($_GET['id'])) {
        $id = intval($_GET['id']);
        $convocatoriaBaremoIdioma = ConvocatoriaBaremoIdiomaRepo::leerConvocatoriaBaremoIdiomaPorId($id);
        echo json_encode(['convocatoriaBaremoIdioma' => $convocatoriaBaremoIdioma]);
    }
    // Obtener todas las asociaciones
    else {
        $todasLasConvocatoriasBaremoIdioma = ConvocatoriaBaremoIdiomaRepo::leerTodasLasConvocatoriasBaremoIdioma();
        echo json_encode(['todasLasConvocatoriasBaremoIdioma' => $todasLasConvocatoriasBaremoIdioma]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Crear una nueva asociación entre convocatoria, baremo, idioma y nivel
    try {
        // Obtener datos del cuerpo de la solicitud
        $datos = json_decode(file_get_contents("php://input"));

        // Validar los datos según tus necesidades

        // Crear una nueva asociación
        $nuevaAsociacion = ConvocatoriaBaremoIdiomaRepo::crearConvocatoriaBaremoIdioma(
            $datos->fkNivelesIdiomas,
            $datos->fkConvocatoriaBaremo,
            $datos->valor
        );

        // Enviar la respuesta
        echo json_encode(['convocatoriaBaremoIdioma' => $nuevaAsociacion]);
    } catch (Exception $e) {
        // Manejar errores según tus necesidades
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(['error' => 'Error en la aplicación: ' . $e->getMessage()]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    // Eliminar una asociación por ID
    try {
        // Obtener el ID de la asociación a eliminar
        $idAsociacion = $_GET['id']; // Ajusta esto según cómo manejas los parámetros

        // Eliminar la asociación
        $resultado = ConvocatoriaBaremoIdiomaRepo::borrarConvocatoriaBaremoIdioma($idAsociacion);

        // Enviar la respuesta
        echo json_encode(['resultado' => $resultado]);
    } catch (Exception $e) {
        // Manejar errores según tus necesidades
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(['error' => 'Error en la aplicación: ' . $e->getMessage()]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    // Actualizar una asociación por ID
    try {
        // Obtener datos del cuerpo de la solicitud
        $datos = json_decode(file_get_contents("php://input"));

        // Validar los datos según tus necesidades

        // Actualizar la asociación
        $resultado = ConvocatoriaBaremoIdiomaRepo::actualizarConvocatoriaBaremoIdioma(
            $datos->id,
            $datos->fkNivelesIdiomas,
            $datos->fkConvocatoriaBaremo,
            $datos->valor
        );

        // Enviar la respuesta
        echo json_encode(['resultado' => $resultado]);
    } catch (Exception $e) {
        // Manejar errores según tus necesidades
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(['error' => 'Error en la aplicación: ' . $e->getMessage()]);
    }
} else {
    // Método no permitido
    header('HTTP/1.0 405 Method Not Allowed');
    echo json_encode(['error' => 'Método no permitido']);
}
?>
