<?php


class ConvocatoriaBaremoIdiomaRepo {
    

    // Crear una asociación entre convocatoria, baremo, idioma y nivel
    public static function crearConvocatoriaBaremoIdioma($fkNivelesIdiomas, $fkConvocatoriaBaremo, $valor) {
        $conexion = db::entrar();

        $sql = "INSERT INTO convocatoriabaremoidioma (fk_niveles_idiomas, fk_convocatoria_baremo, valor) VALUES (?, ?, ?)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("iss", $fkNivelesIdiomas, $fkConvocatoriaBaremo, $valor);
        $stmt->execute();
        $stmt->close();
    }

    // Actualizar una asociación entre convocatoria, baremo, idioma y nivel
    public static function actualizarConvocatoriaBaremoIdioma($id, $fkNivelesIdiomas, $fkConvocatoriaBaremo, $valor) {
        $conexion = db::entrar();

        $sql = "UPDATE convocatoriabaremoidioma SET fk_niveles_idiomas=?, fk_convocatoria_baremo=?, valor=? WHERE id=?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("issi", $fkNivelesIdiomas, $fkConvocatoriaBaremo, $valor, $id);
        $stmt->execute();
        $stmt->close();
    }

    // Borrar una asociación entre convocatoria, baremo, idioma y nivel por ID
    public static function borrarConvocatoriaBaremoIdioma($id) {
        $conexion = db::entrar();

        $sql = "DELETE FROM convocatoriabaremoidioma WHERE id=?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }

    // Leer una asociación entre convocatoria, baremo, idioma y nivel por ID
    public static function leerConvocatoriaBaremoIdiomaPorId($id) {
        $conexion = db::entrar();

        $sql = "SELECT * FROM convocatoriabaremoidioma WHERE id=?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $convocatoriaBaremoIdioma = $result->fetch_assoc();
        $stmt->close();
        return $convocatoriaBaremoIdioma;
    }

    // Leer todas las asociaciones entre convocatoria, baremo, idioma y nivel
    public static function leerTodasLasConvocatoriasBaremoIdioma() {
        $conexion = db::entrar();

        $result = $conexion->query("SELECT * FROM convocatoriabaremoidioma");
        $convocatoriasBaremoIdioma = $result->fetch_all(MYSQLI_ASSOC);
        return $convocatoriasBaremoIdioma;
    }
}

?>
