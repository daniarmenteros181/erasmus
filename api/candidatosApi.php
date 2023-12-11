<?php


require_once('../repositorio/db.php'); // Asegúrate de proporcionar la ruta correcta
require_once('../repositorio/candidatosRepo.php'); // Asegúrate de proporcionar la ruta correcta






if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    try {
        $conexion = db::entrar();

        // Obtener el valor del parámetro id de la URL
        $id = isset($_GET['id']) ? intval($_GET['id']) : null;

        if ($id !== null) {
            // Obtener el candidato por ID
            $candidato = CandidatosRepo::leerCandidatoPorId($id);

            // Verificar si se encontró el candidato
            if ($candidato) {
                // Convertir a JSON y enviar la respuesta
                header('Content-type: application/json');
                echo json_encode(['candidato' => $candidato]);
            } else {
                // Si no se encuentra el candidato
                header('HTTP/1.0 404 Not Found');
                echo json_encode(['error' => 'No se encontró el candidato con el ID proporcionado']);
            }
        } else {
            // Si no se proporcionó un ID válido en la URL
            header('HTTP/1.0 400 Bad Request');
            echo json_encode(['error' => 'ID no válido proporcionado']);
        }
    } catch (PDOException $e) {
        // Manejar errores de la base de datos
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
} 




elseif ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    try {
        // Obtener datos del cuerpo de la solicitud
        $datos = json_decode(file_get_contents("php://input"), true);

        // Validar datos
         if (empty($datos['id']) /* || empty($datos['dni']) || empty($datos['nombre']) */) {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode(['error' => 'Datos incompletos o incorrectos']);
            exit();
        } 

       

        // Obtener los datos del candidato
        $id = $datos['id'];
        $dni = $datos['dni'];
        $fechaNac = $datos['fechaNac'] ?? null;
        $apellidos = $datos['apellidos'] ?? null;
        $nombre = $datos['nombre'];
        $tlf = $datos['tlf'] ?? null;
        $correo = $datos['correo'] ?? null;
        $domicilio = $datos['domicilio'] ?? null;
        $fk_destinatario = $datos['fk_destinatario'] ?? null;
        $contrasenia = $datos['contrasenia'] ?? null;
        $rol = $datos['rol'] ?? null;

        // Actualizar el candidato
        CandidatosRepo::actualizarCandidato($id, $dni, $fechaNac, $apellidos, $nombre, $tlf, $correo, $domicilio, $fk_destinatario, $contrasenia, $rol);

        // Devolver respuesta
        echo json_encode(['success' => true, 'message' => 'Candidato actualizado correctamente']);

    } catch (PDOException $e) {
        // Manejar errores de la base de datos
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
}

