<?php

require_once('../repositorio/db.php');


/* 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $conexion = db::entrar();

        // Obtener los datos del formulario, incluyendo los archivos
        $datos_post = $_POST;
        $archivos = $_FILES;

        // Verificar si se proporcionaron datos válidos
        if (isset($datos_post['id_candidatos']) && isset($datos_post['id_convocatoria'])) { */

            // Subir archivos y almacenar información en la tabla baremacion
           /*  foreach ($archivos as $nombreCampo => $archivo) {
                 $rutaArchivo = subirArchivo($archivo);
 
                // Insertar información en la tabla baremacion
                $query = "INSERT INTO baremacion (fk_candidatos_baremacion, fk_convocatorias_baremacion, fk_item_baremo, url) 
                          VALUES (:id_candidatos, :id_convocatoria, :fk_item_baremo, :url)";
                $statement = $conexion->prepare($query);
                $statement->bindParam(':id_candidatos', $datos_post['id_candidatos'], PDO::PARAM_INT);
                $statement->bindParam(':id_convocatoria', $datos_post['id_convocatoria'], PDO::PARAM_INT);
                $statement->bindParam(':fk_item_baremo', obtenerIdItemBaremoDesdeNombreCampo($nombreCampo), PDO::PARAM_INT);
                $statement->bindParam(':url', $rutaArchivo, PDO::PARAM_STR);
                $statement->execute();
            } */

           
                
                                // Insertar información en la tabla baremacion
                                /* $query = "INSERT INTO baremacion (fk_candidatos_baremacion, fk_convocatorias_baremacion) 
                                          VALUES (:id_candidatos, :id_convocatoria)";
                                $statement = $conexion->prepare($query);
                                $statement->bindParam(':id_candidatos', $datos_post['id_candidatos'], PDO::PARAM_INT);
                                $statement->bindParam(':id_convocatoria', $datos_post['id_convocatoria'], PDO::PARAM_INT);
                                $statement->execute(); */
                            

          /*   // Enviar respuesta de éxito
            header('Content-type: application/json');
            echo json_encode(['mensaje' => 'Datos insertados correctamente']);

        } else {
            // Enviar respuesta de error si los datos no son válidos
            header('HTTP/1.0 400 Bad Request');
            echo json_encode(['error' => 'Datos no válidos']);
        }
    } catch (PDOException $e) {
        // Manejar errores de la base de datos según tus necesidades
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
}
 */

 require_once('../repositorio/db.php');

 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     try {
         $conexion = db::entrar();
 
         // Obtener los datos del formulario, incluyendo los archivos
         $datos_post = $_POST;
         $archivos = $_FILES;
 
         // Verificar si se proporcionaron datos válidos
         if (isset($datos_post['id_candidatos'], $datos_post['id_convocatoria']) &&
             $datos_post['id_candidatos'] !== null && $datos_post['id_convocatoria'] !== null) {
             // Insertar información en la tabla baremacion
             $query = "INSERT INTO baremacion (fk_candidatos_baremacion, fk_convocatorias_baremacion) 
                       VALUES (:id_candidatos, :id_convocatoria)";
             $statement = $conexion->prepare($query);
             $statement->bindParam(':id_candidatos', $datos_post['id_candidatos'], PDO::PARAM_INT);
             $statement->bindParam(':id_convocatoria', $datos_post['id_convocatoria'], PDO::PARAM_INT);
             $statement->execute();
 
             // Enviar respuesta de éxito
             header('Content-type: application/json');
             echo json_encode(['mensaje' => 'Datos insertados correctamente']);
         } else {
             // Enviar respuesta de error si los datos no son válidos
             header('HTTP/1.0 400 Bad Request');
             echo json_encode(['error' => 'Datos no válidos']);
         }
     } catch (PDOException $e) {
         // Manejar errores de la base de datos según tus necesidades
         header('HTTP/1.1 500 Internal Server Error');
         echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
     }
 }
 
 

