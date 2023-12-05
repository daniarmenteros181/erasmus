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

    // Actualizar un registro de baremacion por ID
    public static function actualizarBaremacion($id, $fkCandidatosBaremacion, $fkConvocatoriasBaremacion, $fkItemBaremo, $notas) {
        $conexion = db::entrar();

        $sql = "UPDATE baremacion SET fk_candidatos_baremacion=?, fk_convocatorias_baremacion=?, fk_item_baremo=?, notas=? WHERE id=?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("iiisi", $fkCandidatosBaremacion, $fkConvocatoriasBaremacion, $fkItemBaremo, $notas, $id);
        $stmt->execute();
        $stmt->close();
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

    // Leer un registro de baremacion por ID
    public static function leerBaremacionPorId($id) {
        $conexion = db::entrar();

        $sql = "SELECT * FROM baremacion WHERE id=?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $baremacion = $result->fetch_assoc();
        $stmt->close();
        return $baremacion;
    }

    // Leer todos los registros de baremacion
    public static function leerTodasLasBaremaciones() {
        $conexion = db::entrar();

        $result = $conexion->query("SELECT * FROM baremacion");
        $baremaciones = $result->fetch_all(MYSQLI_ASSOC);
        return $baremaciones;
    }
}

?>
