<?php


class ConvocatoriaBaremoRepo {
    

    // Crear un nuevo registro de convocatoria baremo
    public static function crearConvocatoriaBaremo($requisito, $notaMaxima, $fkConvocatoria, $fkItemBaremo, $valorMinimo,$aportaAlumno) {
        $conexion = db::entrar();

        $sql = "INSERT INTO convocatoria_baremo (requisito, nota_maxima, fk_convocatoria, fk_item_baremo, valor_minimo,aportaAlumno) VALUES (?, ?, ?, ?, ?,?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("siiid", $requisito, $notaMaxima, $fkConvocatoria, $fkItemBaremo, $valorMinimo,$aportaAlumno);
        $stmt->execute();
        $stmt->close();
    }

    // Actualizar un registro de convocatoria baremo por ID
    public static function actualizarConvocatoriaBaremo($id, $requisito, $notaMaxima, $fkConvocatoria, $fkItemBaremo, $valorMinimo,$aportaAlumno) {
        $conexion = db::entrar();

        $sql = "UPDATE convocatoria_baremo SET requisito=?, nota_maxima=?, fk_convocatoria=?, fk_item_baremo=?, valor_minimo=?, aportaAlumno=? WHERE id=?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("siiidi", $requisito, $notaMaxima, $fkConvocatoria, $fkItemBaremo, $valorMinimo,$aportaAlumno, $id);
        $stmt->execute();
        $stmt->close();
    }

    // Borrar un registro de convocatoria baremo por ID
    public static function borrarConvocatoriaBaremo($id) {
        $conexion = db::entrar();

        $sql = "DELETE FROM convocatoria_baremo WHERE id=?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }

    // Leer un registro de convocatoria baremo por ID
    public static function leerConvocatoriaBaremoPorId($id) {
        $conexion = db::entrar();

        $sql = "SELECT * FROM convocatoria_baremo WHERE id=?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $convocatoriaBaremo = $result->fetch_assoc();
        $stmt->close();
        return $convocatoriaBaremo;
    }

    // Leer todos los registros de convocatoria baremo
    public static function leerTodasLasConvocatoriasBaremo() {
        $conexion = db::entrar();

        $result = $conexion->query("SELECT * FROM convocatoria_baremo");
        $convocatoriasBaremo = $result->fetch_all(MYSQLI_ASSOC);
        return $convocatoriasBaremo;
    }
}

?>
