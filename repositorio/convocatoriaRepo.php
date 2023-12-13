<?php


class convocatoriaRepo {


 public static function crearConvocatoria($movilidades, $tipo, $fechaInicio, $fechaFin, $fechaInicioPrueba, $fechaFinPrueba, $fechaInicioDefinitiva, $fk_proyecto,$id_destinatario,$requisito,$notas,$notaMaxima,$valorMinimo,$entrevista,$notaMaximaEntrevista,$valorMinimoEntrevista,$valorNivelIdioma) {
    $conexion = db::entrar();

    try {
        $conexion->beginTransaction();

        



        // Insertar en la tabla convocatoria
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


        $stmt->execute();

        //  Obtener la última ID insertada
        $idConvocatoria = $conexion->lastInsertId();

        // Insertar en la tabla destinatarioconvocatoria
        $sqlDestinatario = "INSERT INTO destinatarioconvocatoria (id_convocatoria, id_destinatario) VALUES (:id_convocatoria, :id_destinatario)";
        $stmtDestinatario = $conexion->prepare($sqlDestinatario);
        
      
        $stmtDestinatario->bindParam(':id_convocatoria', $idConvocatoria, PDO::PARAM_INT);
        $stmtDestinatario->bindParam(':id_destinatario', $id_destinatario);
        
        $stmtDestinatario->execute();


    // Insertar en la tabla convocatoriabaremo para Requisito
    if ($requisito) {
        $infoRequisito = self::obtenerInfoItemBaremo("Requisito");
        $sqlConvoBaremoRequisito = "INSERT INTO convocatoriabaremo (id_convocatoria, requisito, fk_item_baremo) VALUES (:id_convocatoria, :requisito, :fk_item_requisito)";
        $stmtConvoBaremoRequisito = $conexion->prepare($sqlConvoBaremoRequisito);
        $stmtConvoBaremoRequisito->bindParam(':id_convocatoria', $idConvocatoria, PDO::PARAM_INT);
        $stmtConvoBaremoRequisito->bindParam(':requisito', $requisito);
        $stmtConvoBaremoRequisito->bindParam(':fk_item_requisito', $infoRequisito['id'], PDO::PARAM_INT);

        $stmtConvoBaremoRequisito->execute();
    }

    // Insertar en la tabla convocatoriabaremo para Notas
    if ($notas) {
        $infoNotas = self::obtenerInfoItemBaremo("Notas");
        $sqlConvoBaremoNotas = "INSERT INTO convocatoriabaremo (id_convocatoria,  fk_item_baremo, notaMaxima, valorMinimo) VALUES (:id_convocatoria, :fk_item_notas, :notaMaxima, :valorMinimo)";
        $stmtConvoBaremoNotas = $conexion->prepare($sqlConvoBaremoNotas);
        $stmtConvoBaremoNotas->bindParam(':id_convocatoria', $idConvocatoria, PDO::PARAM_INT);
        $stmtConvoBaremoNotas->bindParam(':fk_item_notas', $infoNotas['id'], PDO::PARAM_INT);
        $stmtConvoBaremoNotas->bindParam(':notaMaxima', $notaMaxima, PDO::PARAM_INT);
        $stmtConvoBaremoNotas->bindParam(':valorMinimo', $valorMinimo, PDO::PARAM_INT);     
        
        $stmtConvoBaremoNotas->execute();
    }

    // Insertar en la tabla convocatoriabaremo para Entrevista
    if ($entrevista) {
        $infoEntrevista = self::obtenerInfoItemBaremo("Entrevista");
        $sqlConvoBaremoEntrevista = "INSERT INTO convocatoriabaremo (id_convocatoria, fk_item_baremo, notaMaxima, valorMinimo) VALUES (:id_convocatoria, :fk_item_entrevista, :notaMaximaEntrevista, :valorMinimoEntrevista)";
        $stmtConvoBaremoEntrevista = $conexion->prepare($sqlConvoBaremoEntrevista);
        $stmtConvoBaremoEntrevista->bindParam(':id_convocatoria', $idConvocatoria, PDO::PARAM_INT);
        $stmtConvoBaremoEntrevista->bindParam(':fk_item_entrevista', $infoEntrevista['id'], PDO::PARAM_INT);
        $stmtConvoBaremoEntrevista->bindParam(':notaMaximaEntrevista', $notaMaximaEntrevista, PDO::PARAM_INT);
        $stmtConvoBaremoEntrevista->bindParam(':valorMinimoEntrevista', $valorMinimoEntrevista, PDO::PARAM_INT);

        $stmtConvoBaremoEntrevista->execute();
    }

    if ($valorNivelIdioma) {
        // Realizar operaciones específicas cuando $valorNivelIdioma es verdadero
        $infoNivelIdioma = self::obtenerInfoItemBaremo("Nivelidioma");
        $sqlConvoBaremoNivelIdioma = "INSERT INTO convocatoriabaremo (id_convocatoria, fk_item_baremo) VALUES (:id_convocatoria, :fk_item_nivel_idioma)";
        $stmtConvoBaremoNivelIdioma = $conexion->prepare($sqlConvoBaremoNivelIdioma);
        $stmtConvoBaremoNivelIdioma->bindParam(':id_convocatoria', $idConvocatoria, PDO::PARAM_INT);
        $stmtConvoBaremoNivelIdioma->bindParam(':fk_item_nivel_idioma', $infoNivelIdioma['id'], PDO::PARAM_INT);
     
        $stmtConvoBaremoNivelIdioma->execute();
   



        // Insertar en la tabla convocatoriabaremoIdioma
        // Obtener el último ID insertado en la tabla convocatoriabaremo
        $fk_convocatoria_Baremo = $conexion->lastInsertId();
        $sqlConvoBaremoIdioma = "INSERT INTO convocatoriabaremoidioma (fk_niveles_idiomas, fk_convocatoria_Baremo,valor) VALUES (:fk_niveles_idiomas, :fk_convocatoria_Baremo,:valor)";
        $stmtConvoBaremoIdioma = $conexion->prepare($sqlConvoBaremoIdioma);


        // Asignar valor para cada nivel de idioma
        $nivelesIdioma = [
            "A1" => $_POST["valorNivelIdiomaA1"],
            "A2" => $_POST["valorNivelIdiomaA2"],
            "B1" => $_POST["valorNivelIdiomaB1"],
            "B2" => $_POST["valorNivelIdiomaB2"],
            "C1" => $_POST["valorNivelIdiomaC1"],
            "C2" => $_POST["valorNivelIdiomaC2"]
        ];

        foreach ($nivelesIdioma as $nivel => $valor) {
            // Obtener el ID del nivel de idioma desde la tabla nivelesidiomas
            $idNivelIdioma = self::obtenerIdNivelIdiomaDesdeTabla($nivel);
    
            // Asignar parámetros y ejecutar la inserción
            $stmtConvoBaremoIdioma->bindParam(':fk_niveles_idiomas', $idNivelIdioma, PDO::PARAM_INT);
            $stmtConvoBaremoIdioma->bindParam(':fk_convocatoria_Baremo', $fk_convocatoria_Baremo, PDO::PARAM_INT);
            $stmtConvoBaremoIdioma->bindParam(":valor", $valor, PDO::PARAM_INT);
    
            $stmtConvoBaremoIdioma->execute();
        }
} 
    

        // Confirmar la transacción
        $conexion->commit();
    } catch (Exception $e) {
        // Manejar cualquier excepción y realizar un rollback si es necesario
        $conexion->rollBack();
        echo "Error: " . $e->getMessage();
    } finally {
        $stmt->closeCursor();
    }
}

public static function obtenerIdNivelIdiomaDesdeTabla($nivel)
{
    // Implementa la lógica para obtener el ID del nivel de idioma desde la tabla nivelesidiomas

    $conexion = db::entrar();

    $sql = "SELECT id FROM nivelesidiomas WHERE niveles = :nivel";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':nivel', $nivel, PDO::PARAM_STR);
    $stmt->execute();

    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    // Cierra la conexión si es necesario
    // $conexion = null;

    if ($resultado) {
        return $resultado['id'];
    } else {
        // Manejar el caso en que el nivel no se encuentre en la tabla
        // Puedes lanzar una excepción o devolver un valor por defecto según tus necesidades
        return null;
    }
}






public static function obtenerInfoItemBaremo($nombreItem) {
    // Conéctate a la base de datos (ajusta según tu configuración)
    $conexion = db::entrar();

    // Consulta para obtener la información del ítem del baremo
    $sql = "SELECT id, nombre FROM itembaremo WHERE nombre = :nombre";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':nombre', $nombreItem, PDO::PARAM_STR);
    $stmt->execute();

    // Obtiene el resultado como un array asociativo
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    // Devuelve la información del ítem del baremo o false si no se encuentra
    return $resultado ? $resultado : false;
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

        // Eliminar la convocatoria de la tabla convocatoria
        $sqlBorrarConvocatoria = "DELETE FROM convocatoria WHERE id=:id";
        $stmtBorrarConvocatoria = $conexion->prepare($sqlBorrarConvocatoria);
        $stmtBorrarConvocatoria->bindParam(':id', $id, PDO::PARAM_INT);
        $stmtBorrarConvocatoria->execute();
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
            echo "<form method='post' action='../formularios/obtencion.php'>";  
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
