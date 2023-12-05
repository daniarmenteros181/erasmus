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

        // Paso 3: Insertar en la tabla destinatarioconvocatoria
        $sqlDestinatario = "INSERT INTO destinatarioconvocatoria (id_convocatoria, id_destinatario) VALUES (:id_convocatoria, :id_destinatario)";
        $stmtDestinatario = $conexion->prepare($sqlDestinatario);
        
        // Establecer el valor deseado para id_destinatario
/*         $id_destinatario = "B";  // Sustituye esto con el valor real que deseas insertar en id_destinatario
 */        
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


















    /* // Actualizar una convocatoria existente por ID
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
    } */

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

    // Borrar una convocatoria por ID
    public static function borrarConvocatoria($id) {
        $conexion = db::entrar();

        $sql = "DELETE FROM convocatoria WHERE id=:id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
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
