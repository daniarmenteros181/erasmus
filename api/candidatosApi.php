<?php


require_once('../repositorio/db.php'); 
require_once('../repositorio/candidatosRepo.php'); 


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
                echo json_encode(['candidato' => $candidato]);
            } else {
                echo json_encode(['error' => 'No se encontró el candidato con el ID proporcionado']);
            }
        } else {
            echo json_encode(['error' => 'ID no válido proporcionado']);
        }
    } catch (PDOException $e) {
        // Manejar errores de la base de datos
        echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
} 




elseif ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    try {
        // Obtener datos del cuerpo de la solicitud
        $datos = json_decode(file_get_contents("php://input"), true);

   

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
        echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
}

