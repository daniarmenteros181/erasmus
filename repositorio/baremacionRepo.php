<?php


class BaremacionRepo {

    // Crear un nuevo registro de baremacion
    public static function crearBaremacion($fkCandidatosBaremacion, $fkConvocatoriasBaremacion, $fkItemBaremo, $notas) {
        $conexion = db::entrar();

        $sql = "INSERT INTO baremacion (fk_candidatos_baremacion, fk_convocatorias_baremacion, fk_item_baremo, notas) VALUES (?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("iiis", $fkCandidatosBaremacion, $fkConvocatoriasBaremacion, $fkItemBaremo, $notas);
        $stmt->execute();
        $stmt->close();
    }

   

     // Actualizar una baremacion existente por ID
     public static function actualizarBaremacion($id, $fk_candidatos_baremacion, $fk_convocatorias_baremacion, $fk_item_baremo, $notas, $url) {
        $conexion = db::entrar();

        $sql = "UPDATE baremacion SET fk_candidatos_baremacion=:fk_candidatos_baremacion, fk_convocatorias_baremacion=:fk_convocatorias_baremacion, fk_item_baremo=:fk_item_baremo, notas=:notas, url=:url  WHERE id=:id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':fk_candidatos_baremacion', $fk_candidatos_baremacion);
        $stmt->bindParam(':fk_convocatorias_baremacion', $fk_convocatorias_baremacion);
        $stmt->bindParam(':fk_item_baremo', $fk_item_baremo);
        $stmt->bindParam(':notas', $notas);
        $stmt->bindParam(':url', $url);


        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
    }



    // Borrar un registro de baremacion por ID
    public static function borrarBaremacion($id) {
        $conexion = db::entrar();

        $sql = "DELETE FROM baremacion WHERE id=?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }

  


    public static function leerBaremacionPorId($id) {
        $conexion = db::entrar();

        $sql = "SELECT * FROM baremacion WHERE id=:id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    /* // Leer todos los registros de baremacion
    public static function leerTodasLasBaremaciones() {
        $conexion = db::entrar();

        $result = $conexion->query("SELECT * FROM baremacion");
        $baremaciones = $result->fetch_all(MYSQLI_ASSOC);
        return $baremaciones;
    } */


    /* public static function leerTodasLasBaremaciones() {
        $conexion = db::entrar();

        $sql = "SELECT * FROM baremacion";
        $stmt = $conexion->prepare($sql);
        // Ejecutar la consulta
        $stmt->execute();
        $baremaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $baremaciones;
    }  */

   
    

      // Leer todas las convocatorias
      public static function leerTodasLasBaremaciones() {
        $conexion = db::entrar();

        $sql = "SELECT * FROM baremacion";
        $stmt = $conexion->prepare($sql);
        $stmt->execute();
        $baremaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $baremaciones  ;
    } 









     //Funcion que llama al metodo que trae las convocatorias, y la muestra en una tabla 
     public static  function mostrarBaremacionCrud() {
        $baremaciones = self::leerTodasLasBaremaciones();

    

        // Comenzar la tabla
        echo "<table border='1'>";

        // Encabezados de la tabla
        echo "<tr><th>ID</th><th>fk_candidatos_baremacion</th><th>fk convocatorias baremacion</th><th>Fk item Baremo</th><th>Notas</th><th>URL</th><th></th></tr>";
        echo " <link rel='stylesheet' href='../estilos/estilosTablas.css'>";

        echo "<h2>Todas las Solicitudes</h2>";

        // Mostrar resultados en la tabla
        foreach ($baremaciones as $fila) {
            echo "<tr>";
            echo "<td>" . $fila['id'] . "</td>";
            echo "<td>" . $fila['fk_candidatos_baremacion'] . "</td>";
            echo "<td>" . $fila['fk_convocatorias_baremacion'] . "</td>";
            echo "<td>" . $fila['fk_item_baremo'] . "</td>";
            echo "<td>" . $fila['notas'] . "</td>";
            echo "<td>" . $fila['url'] . "</td>";
           
      

        echo "<td>";
            echo "<form method='post' action='?menu=edicionBaremacion'>";  
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
