<?php


class convocatoriaRepo {


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
        $stmt->bindParam(':fk_proyecto', $fk_proyecto);

/*         $stmt->bindParam(':fk_proyecto', $fk_proyecto, PDO::PARAM_INT);
 */


        $stmt->execute();

        //  Obtener la última ID insertada
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

        // Confirmar la transacción
        $conexion->commit();
    } catch (Exception $e) {
        // Manejar cualquier excepción y realizar un rollback si es necesario
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

    


     public static function borrarConvocatoria($id) {
        $conexion = db::entrar();
    
        try {
            $conexion->beginTransaction();
    
             // Eliminar la entrada correspondiente en la tabla destinatarioconvocatoria
             $sqlBorrarDestinatario = "DELETE FROM destinatarioconvocatoria WHERE id_convocatoria = :id_convocatoria";
             $stmtBorrarDestinatario = $conexion->prepare($sqlBorrarDestinatario);
             $stmtBorrarDestinatario->bindParam(':id_convocatoria', $id, PDO::PARAM_INT);
             $stmtBorrarDestinatario->execute();

            // Eliminar la entrada correspondiente en la tabla convocatoriabaremo
            $sqlBorrarBaremo = "DELETE FROM convocatoriabaremo WHERE id_convocatoria = :id_convocatoria";
            $stmtBorrarBaremo = $conexion->prepare($sqlBorrarBaremo);
            $stmtBorrarBaremo->bindParam(':id_convocatoria', $id, PDO::PARAM_INT);
            $stmtBorrarBaremo->execute();
    
            // Eliminar la entrada correspondiente en la tabla candidatosconvocatoria
            $sqlBorrarCandiConv = "DELETE FROM candidatosconvocatoria WHERE id_convocatoria = :id_convocatoria";
            $stmtBorrarCandiConv = $conexion->prepare($sqlBorrarCandiConv);
            $stmtBorrarCandiConv->bindParam(':id_convocatoria', $id, PDO::PARAM_INT);
            $stmtBorrarCandiConv->execute();


            // Eliminar la convocatoria de la tabla convocatoria
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

    
    public static function obtenerIdCandidato() {
        $conexion = db::entrar();
    
        // Lógica para obtener el ID del destinatario desde la base de datos
        $sql = "SELECT id FROM candidatos WHERE nombre = :nombreUsuario";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':nombreUsuario', $_SESSION['nombreUsuario']);
    
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Si se encontró el candidato, obtenemos el ID, de lo contrario, dejamos $id como null
        if ($resultado) {
            $id = $resultado['id'];
            echo "id de candidato: $id";
        }
    
        return $id;
    }
    
    


    //Funcion que obtinene las convocatorias de un cierto candidatos y las pinta
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

        // Muestra las convocatorias en una tabla
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Movilidades</th><th>Tipo</th><th>Fecha Inicio</th><th>Fecha Fin</th><th>Fecha Inicio Prueba</th><th>Fecha Fin Prueba</th><th>Fecha Inicio Definitiva</th><th>FK Proyecto</th></tr>";

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
            // ... Muestra otras columnas
            echo "</tr>";
        }

        echo "</table>";
    
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
