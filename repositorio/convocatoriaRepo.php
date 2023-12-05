<?php


class convocatoriaRepo {


    /* // Crear una nueva convocatoria y tengo que coger la ultima id, insertada,  y ya desde ahi vamos haciendo datos
    public static function crearConvocatoria($movilidades, $tipo, $fechaInicio, $fechaFin, $fechaInicioPrueba, $fechaFinPrueba, $fechaInicioDefinitiva, $fk_proyecto) {
        $conexion = db::entrar();

        $conexion->beginTransaction();


        $sql = "INSERT INTO convocatoria (movilidades, tipo, fechaInicio, fechaFin, fechaInicioPrueba, fechaFinPrueba, fechaInicioDefinitiva, fk_proyecto) VALUES (:movilidades, :tipo, :fechaInicio, :fechaFin, :fechaInicioPrueba, :fechaFinPrueba, :fechaInicioDefinitiva, :fk_proyecto)";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':movilidades', $movilidades);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':fechaInicio', $fechaInicio);
        $stmt->bindParam(':fechaFin', $fechaFin);
        $stmt->bindParam(':fechaInicioPrueba', $fechaInicioPrueba);
        $stmt->bindParam(':fechaFinPrueba', $fechaFinPrueba);
        $stmt->bindParam(':fechaInicioDefinitiva', $fechaInicioDefinitiva);
        $stmt->bindParam(':fk_proyecto', $fk_proyecto, PDO::PARAM_INT);
        $stmt->execute();
        $conexion->commit();

        $stmt->closeCursor();
    } */














   /*  public static function crearConvocatoria($movilidades, $tipo, $fechaInicio, $fechaFin, $fechaInicioPrueba, $fechaFinPrueba, $fechaInicioDefinitiva, $fk_proyecto) {
    $conexion = db::entrar();

    try {
        $conexion->beginTransaction();

        // Paso 1: Insertar en la tabla convocatoria
        $sql = "INSERT INTO convocatoria (movilidades, tipo, fechaInicio, fechaFin, fechaInicioPrueba, fechaFinPrueba, fechaInicioDefinitiva, fk_proyecto) VALUES (:movilidades, :tipo, :fechaInicio, :fechaFin, :fechaInicioPrueba, :fechaFinPrueba, :fechaInicioDefinitiva, :fk_proyecto)";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':movilidades', $movilidades);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':fechaInicio', $fechaInicio);
        $stmt->bindParam(':fechaFin', $fechaFin);
        $stmt->bindParam(':fechaInicioPrueba', $fechaInicioPrueba);
        $stmt->bindParam(':fechaFinPrueba', $fechaFinPrueba);
        $stmt->bindParam(':fechaInicioDefinitiva', $fechaInicioDefinitiva);
        $stmt->bindParam(':fk_proyecto', $fk_proyecto, PDO::PARAM_INT);
        $stmt->execute();

        // Paso 2: Obtener la última ID insertada
        $idConvocatoria = $conexion->lastInsertId();

        // Paso 3: Insertar en la tabla destinatarioconvocatoria
        $sqlDestinatario = "INSERT INTO destinatarioconvocatoria (id_convocatoria) VALUES (:id_convocatoria)";
        $stmtDestinatario = $conexion->prepare($sqlDestinatario);
        $id_destinatario = "valor";  // Sustituye esto con el valor real que deseas insertar en otro_campo
        $stmtDestinatario->bindParam(':id_convocatoria', $idConvocatoria, PDO::PARAM_INT);
        $stmtDestinatario->bindParam(':id_destinatario', $id_destinatario);
        $stmtDestinatario->execute();

        // Paso 4: Confirmar la transacción
        $conexion->commit();
    } catch (Exception $e) {
        // Paso 5: Manejar cualquier excepción y realizar un rollback si es necesario
        $conexion->rollBack();
        echo "Error: " . $e->getMessage();
    } finally {
        // Paso 6: Cerrar los cursores
        $stmt->closeCursor();
        $stmtDestinatario->closeCursor();
    }
}
 */




 public static function crearConvocatoria($movilidades, $tipo, $fechaInicio, $fechaFin, $fechaInicioPrueba, $fechaFinPrueba, $fechaInicioDefinitiva, $fk_proyecto,$id_destinatario) {
    $conexion = db::entrar();

    try {
        $conexion->beginTransaction();

        // Paso 1: Insertar en la tabla convocatoria
        $sql = "INSERT INTO convocatoria (movilidades, tipo, fechaInicio, fechaFin, fechaInicioPrueba, fechaFinPrueba, fechaInicioDefinitiva, fk_proyecto) VALUES (:movilidades, :tipo, :fechaInicio, :fechaFin, :fechaInicioPrueba, :fechaFinPrueba, :fechaInicioDefinitiva, :fk_proyecto)";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':movilidades', $movilidades);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':fechaInicio', $fechaInicio);
        $stmt->bindParam(':fechaFin', $fechaFin);
        $stmt->bindParam(':fechaInicioPrueba', $fechaInicioPrueba);
        $stmt->bindParam(':fechaFinPrueba', $fechaFinPrueba);
        $stmt->bindParam(':fechaInicioDefinitiva', $fechaInicioDefinitiva);
        $stmt->bindParam(':fk_proyecto', $fk_proyecto, PDO::PARAM_INT);


        $stmt->execute();

        // Paso 2: Obtener la última ID insertada
        $idConvocatoria = $conexion->lastInsertId();

        // Insertar en la tabla destinatarioconvocatoria
        $sqlDestinatario = "INSERT INTO destinatarioconvocatoria (id_convocatoria, id_destinatario) VALUES (:id_convocatoria, :id_destinatario)";
        $stmtDestinatario = $conexion->prepare($sqlDestinatario);
        
      
        $stmtDestinatario->bindParam(':id_convocatoria', $idConvocatoria, PDO::PARAM_INT);
        $stmtDestinatario->bindParam(':id_destinatario', $id_destinatario);
        $stmtDestinatario->execute();




        // Insertar en la tabla convocatoriabaremo
        $sqlConvoBaremo = "INSERT INTO convocatoriabaremo (id_convocatoria) VALUES (:id_convocatoria)";
        $stmtConvoBaremo = $conexion->prepare($sqlConvoBaremo);
        
      
        $stmtConvoBaremo->bindParam(':id_convocatoria', $idConvocatoria, PDO::PARAM_INT);
        $stmtConvoBaremo->execute();

        // Paso 4: Confirmar la transacción
        $conexion->commit();
    } catch (Exception $e) {
        // Paso 5: Manejar cualquier excepción y realizar un rollback si es necesario
        $conexion->rollBack();
        echo "Error: " . $e->getMessage();
    } finally {
        // Paso 6: Cerrar los cursores
        $stmt->closeCursor();
        $stmtDestinatario->closeCursor();
    }
}







    /*  // Actualizar una convocatoria existente por ID
    public static function actualizarConvocatoria($id, $movilidades, $tipo, $fechaInicio, $fechaFin, $fechaInicioPrueba, $fechaFinPrueba, $fechaInicioDefinitiva, $fk_proyecto) {
        $conexion = db::entrar();

        $sql = "UPDATE convocatoria SET movilidades=:movilidades, tipo=:tipo, fechaInicio=:fechaInicio, fechaFin=:fechaFin, fechaInicioPrueba=:fechaInicioPrueba, fechaFinPrueba=:fechaFinPrueba, fechaInicioDefinitiva=:fechaInicioDefinitiva, fk_proyecto=:fk_proyecto WHERE id=:id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':movilidades', $movilidades);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':fechaInicio', $fechaInicio);
        $stmt->bindParam(':fechaFin', $fechaFin);
        $stmt->bindParam(':fechaInicioPrueba', $fechaInicioPrueba);
        $stmt->bindParam(':fechaFinPrueba', $fechaFinPrueba);
        $stmt->bindParam(':fechaInicioDefinitiva', $fechaInicioDefinitiva);
        $stmt->bindParam(':fk_proyecto', $fk_proyecto, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
    }  */

     // Actualizar una convocatoria existente por ID
     public static function actualizarConvocatoria($id, $movilidades, $tipo, $fechaInicio) {
        $conexion = db::entrar();

        $sql = "UPDATE convocatoria SET movilidades=:movilidades, tipo=:tipo, fechaInicio=:fechaInicio WHERE id=:id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':movilidades', $movilidades);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':fechaInicio', $fechaInicio);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
    }

    /* // Borrar una convocatoria por ID
    public static function borrarConvocatoria($id) {
        $conexion = db::entrar();

        $sql = "DELETE FROM convocatoria WHERE id=:id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
    } */


    public static function borrarConvocatoria($id) {
        $conexion = db::entrar();
    
        try {
            $conexion->beginTransaction();
    
             //  Eliminar la entrada correspondiente en la tabla destinatarioconvocatoria
             $sqlBorrarDestinatario = "DELETE FROM destinatarioconvocatoria WHERE id_convocatoria = :id_convocatoria";
             $stmtBorrarDestinatario = $conexion->prepare($sqlBorrarDestinatario);
             $stmtBorrarDestinatario->bindParam(':id_convocatoria', $id, PDO::PARAM_INT);
             $stmtBorrarDestinatario->execute();

              //  Eliminar la entrada correspondiente en la tabla convocatoriabaremo
            $sqlBorrarBaremo = "DELETE FROM convocatoriabaremo WHERE id_convocatoria = :id_convocatoria";
            $stmtBorrarBaremo = $conexion->prepare($sqlBorrarBaremo);
            $stmtBorrarBaremo->bindParam(':id_convocatoria', $id, PDO::PARAM_INT);
            $stmtBorrarBaremo->execute();
    
            //  Eliminar la convocatoria de la tabla convocatoria
            $sqlBorrarConvocatoria = "DELETE FROM convocatoria WHERE id=:id";
            $stmtBorrarConvocatoria = $conexion->prepare($sqlBorrarConvocatoria);
            $stmtBorrarConvocatoria->bindParam(':id', $id, PDO::PARAM_INT);
            $stmtBorrarConvocatoria->execute();
    
            // Confirmar la transacción
            $conexion->commit();
        } catch (Exception $e) {
            // Paso 6: Manejar cualquier excepción y realizar un rollback si es necesario
            $conexion->rollBack();
            echo "Error: " . $e->getMessage();
        }
    }
    

    // Leer una convocatoria por ID
    public static function leerConvocatoriaPorId($id) {
        $conexion = db::entrar();

        $sql = "SELECT * FROM convocatoria WHERE id=:id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

     // Leer todas las convocatorias
    public static function leerTodasLasConvocatorias() {
        $conexion = db::entrar();

        $sql = "SELECT * FROM convocatoria";
        $stmt = $conexion->prepare($sql);
        $stmt->execute();
        $convocatorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $convocatorias  ;
    } 

    //Funcion que llama al metodo que trae las convocatorias, y la muestra en una tabla 
    public static  function mostrarConvocatoriasEnTablaSolo() {
        $convocatorias = self::leerTodasLasConvocatorias();

        // Comenzar la tabla
        echo "<table border='1'>";

        // Encabezados de la tabla
        echo "<tr><th>ID</th><th>Movilidades</th><th>Tipo</th><th>Fecha Inicio</th><th>Fecha Fin</th><th>Fecha Inicio Prueba</th><th>Fecha Fin Prueba</th><th>Fecha Inicio Definitiva</th><th>FK Proyecto</th></tr>";

        // Mostrar resultados en la tabla
        foreach ($convocatorias as $fila) {
            echo "<tr>";
            echo "<td>" . $fila['id'] . "</td>";
            echo "<td>" . $fila['movilidades'] . "</td>";
            echo "<td>" . $fila['tipo'] . "</td>";
            echo "<td>" . $fila['fechaInicio'] . "</td>";
            echo "<td>" . $fila['fechaFin'] . "</td>";
            echo "<td>" . $fila['fechaInicioPrueba'] . "</td>";
            echo "<td>" . $fila['fechaFinPrueba'] . "</td>";
            echo "<td>" . $fila['fechaInicioDefinitiva'] . "</td>";
            echo "<td>" . $fila['fk_proyecto'] . "</td>";

            // Botón de borrar con un formulario para evitar enlaces directos
        echo "<td>";
            echo "<form method='post' action='../formularios/seleccionConvocatoria.php'>";  
            echo "<input type='hidden' name='id' value='" . $fila['id'] . "'>";
            echo "<input type='submit' value='Elegir'>";
            echo "</form>";
        echo "</td>";

        
        echo "</tr>";
            
        }

        // Finalizar la tabla
        echo "</table>";
    }

    
    public static function obtenerIdDestinatario() {
        // Supongamos que tienes una función en tu clase db (db::entrar()) que inicia la conexión a la base de datos
        $conexion = db::entrar();

        // Lógica para obtener el ID del destinatario desde la base de datos
        $id = self::obtenerIdCandidatoDesdeBaseDeDatos($conexion);

        // Imprime o devuelve el ID del destinatario (puedes comentar o eliminar la línea de echo si no necesitas imprimirlo)
        echo $id;

        return $id;
    }

    private static function obtenerIdCandidatoDesdeBaseDeDatos($conexion) {
        // Aquí implementa la lógica para obtener el ID del candidato desde la base de datos
        // Ajusta esto según la estructura real de tu base de datos y lógica de la aplicación
    
        // Supongamos que la tabla candidato tiene un campo id_candidato y un campo nombre_usuario
        $sql = "SELECT dni FROM candidatos WHERE nombre = :nombreUsuario"; // Ajusta la consulta según tu estructura
        $stmt = $conexion->prepare($sql);
    
        // Aquí vinculamos parámetros si es necesario
        $stmt->bindParam(':nombreUsuario', $_SESSION['nombreUsuario']); // Ajusta según la variable de sesión que contiene el nombre de usuario
    
        $stmt->execute();
    
        // Obtener el resultado
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Retornar el ID del candidato o null si no se encuentra
        return $resultado['dni'] ?? null;
    }
    



    public static function obtenerConvocatoriasDichas($id) {
        $conexion = db::entrar();
    
        $sql = "SELECT convocatoria.*
                FROM convocatoria
                INNER JOIN candidatosconvocatoria ON convocatoria.id = candidatosconvocatoria.id_convocatoria
                WHERE candidatosconvocatoria.id_candidatos = :id_candidatos";
    
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id_candidatos', $id, PDO::PARAM_INT);
        $stmt->execute();
    
        $convocatorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
    
        // Devuelve el array de convocatorias
        return $convocatorias;
    }


    //Funcion que llama al metodo que trae las convocatorias, y la muestra en una tabla 
    public static  function mostrarConvocatoriasEnTabla() {
        $convocatorias = self::leerTodasLasConvocatorias();

        // Comenzar la tabla
        echo "<table border='1'>";

        // Encabezados de la tabla
        echo "<tr><th>ID</th><th>Movilidades</th><th>Tipo</th><th>Fecha Inicio</th><th>Fecha Fin</th><th>Fecha Inicio Prueba</th><th>Fecha Fin Prueba</th><th>Fecha Inicio Definitiva</th><th>FK Proyecto</th></tr>";

        // Mostrar resultados en la tabla
        foreach ($convocatorias as $fila) {
            echo "<tr>";
            echo "<td>" . $fila['id'] . "</td>";
            echo "<td>" . $fila['movilidades'] . "</td>";
            echo "<td>" . $fila['tipo'] . "</td>";
            echo "<td>" . $fila['fechaInicio'] . "</td>";
            echo "<td>" . $fila['fechaFin'] . "</td>";
            echo "<td>" . $fila['fechaInicioPrueba'] . "</td>";
            echo "<td>" . $fila['fechaFinPrueba'] . "</td>";
            echo "<td>" . $fila['fechaInicioDefinitiva'] . "</td>";
            echo "<td>" . $fila['fk_proyecto'] . "</td>";

            // Botón de borrar con un formulario para evitar enlaces directos
        echo "<td>";
            echo "<form method='post' action='../formularios/borrarConvocatoriaClass.php'>";  
            echo "<input type='hidden' name='id' value='" . $fila['id'] . "'>";
            echo "<input type='submit' value='Borrar'>";
            echo "</form>";
        echo "</td>";

        echo "<td>";
            echo "<form method='post' action='../formularios/actualiarConvocatoriaClass.php'>";  
            echo "<input type='hidden' name='id' value='" . $fila['id'] . "'>";
            echo "<input type='submit' value='Actualizar'>";
            echo "</form>";
        echo "</td>";

        
        echo "</tr>";
            
        }

        // Finalizar la tabla
        echo "</table>";
    }

    
    
}

?>
