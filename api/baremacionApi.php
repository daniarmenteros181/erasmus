<?php


require_once('../repositorio/db.php');
require_once('../repositorio/convocatoriaBaremoRepo.php');
require_once('../repositorio/itemBaremoRepo.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $conexion = db::entrar();
        $conexion->beginTransaction(); // Iniciar transacción

        // Obtener los datos del formulario, incluyendo los archivos
        $datos_post = $_POST;
        $archivos = $_FILES;

        // Verificar si se proporcionaron datos válidos
        if (isset($datos_post['id_candidatos'], $datos_post['id_convocatoria']) &&
            $datos_post['id_candidatos'] !== null && $datos_post['id_convocatoria'] !== null) {

            // Obtener fk_item_baremo de la tabla convocatoriabaremo
            $convocatoriaBaremos = convocatoriaBaremoRepo::obtenerConvocatoriaBaremoPorConvocatoria($datos_post['id_convocatoria']);

            // Verificar si la consulta fue exitosa
            if ($convocatoriaBaremos) {
                foreach ($convocatoriaBaremos as $convocatoriaBaremo) {
                    // Obtener el ítem de baremo actual
                    $itemBaremo = itemBaremoRepo::obtenerItemPorId($convocatoriaBaremo['fk_item_baremo']);

                    // Verificar si la consulta fue exitosa
                    if ($itemBaremo) {
                        // Verificar si es un campo de archivo o de URL
                        $campoNombre = 'archivo_' . $itemBaremo['id'];
                        $campoValor = isset($archivos[$campoNombre]) ? subirArchivo($archivos[$campoNombre]) : $_POST['url_' . $itemBaremo['id']];

                        // Insertar información en la tabla baremacion
                        $queryBaremacion = "INSERT INTO baremacion (fk_candidatos_baremacion, fk_convocatorias_baremacion, fk_item_baremo, url) 
                               VALUES (:id_candidatos, :id_convocatoria, :fk_item_baremo, :url)";
                        $statementBaremacion = $conexion->prepare($queryBaremacion);
                        $statementBaremacion->bindParam(':id_candidatos', $datos_post['id_candidatos'], PDO::PARAM_INT);
                        $statementBaremacion->bindParam(':id_convocatoria', $datos_post['id_convocatoria'], PDO::PARAM_INT);
                        $statementBaremacion->bindParam(':fk_item_baremo', $itemBaremo['id'], PDO::PARAM_INT);
                        $statementBaremacion->bindParam(':url', $campoValor, PDO::PARAM_STR);

                        // Verificar si la ejecución de la consulta fue exitosa
                        if ($statementBaremacion->execute()) {
                            // Puedes hacer algo aquí si es necesario después de cada inserción
                        } else {
                            // Enviar respuesta de error si la ejecución de la consulta falló
                            $conexion->rollBack();
                            header('HTTP/1.0 500 Internal Server Error');
                            echo json_encode(['error' => 'Error al insertar datos en la tabla baremacion']);
                            exit; // Salir del script si hay un error
                        }
                    } else {
                        // Enviar respuesta de error si no se encontró el ítem de baremo
                        $conexion->rollBack();
                        header('HTTP/1.0 404 Not Found');
                        echo json_encode(['error' => 'No se encontró el ítem de baremo para la convocatoria proporcionada']);
                        exit; // Salir del script si hay un error
                    }
                }

                // Commit de la transacción si todo es exitoso
                $conexion->commit();
                header('Content-type: application/json');
                echo json_encode(['mensaje' => 'Datos insertados correctamente']);
            } else {
                // Enviar respuesta de error si no se encontró la convocatoriaBaremo
                $conexion->rollBack();
                header('HTTP/1.0 404 Not Found');
                echo json_encode(['error' => 'No se encontró convocatoriaBaremo para la convocatoria proporcionada']);
            }

        } else {
            // Enviar respuesta de error si los datos no son válidos
            $conexion->rollBack();
            header('HTTP/1.0 400 Bad Request');
            echo json_encode(['error' => 'Datos no válidos']);
        }
    } catch (PDOException $e) {
        // Manejar errores de la base de datos y hacer rollback en caso de error
        $conexion->rollBack();
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
}

// Función para subir un archivo al servidor y devolver la ruta del archivo
function subirArchivo($archivo) {
    // Directorio donde se almacenarán los archivos (ajústalo según tus necesidades)
    $directorioDestino = '../almacen/';

    // Nombre del archivo
    $nombreArchivo = basename($archivo['name']);

    // Ruta completa del archivo en el servidor
    $rutaCompleta = $directorioDestino . $nombreArchivo;

    // Mueve el archivo al directorio de destino
    if (move_uploaded_file($archivo['tmp_name'], $rutaCompleta)) {
        return $rutaCompleta;
    } else {
        return null; // Puedes manejar el error de otra manera si lo deseas
    }
}
