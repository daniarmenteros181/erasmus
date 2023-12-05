<?php

class NivelesIdiomasRepo {


    // Crear un nuevo nivel de idioma
    public static function crearNivelIdioma($niveles) {
        $conexion = db::entrar();
        $sql = "INSERT INTO niveles_idiomas (niveles) VALUES (:niveles)";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':niveles', $niveles);
        $stmt->execute();
        $stmt->closeCursor();
    }

    public static function actualizarNivelIdioma($id, $niveles) {
        $conexion = db::entrar();
        $sql = "UPDATE niveles_idiomas SET niveles=:niveles WHERE id=:id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':niveles', $niveles);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
    }

    public static function borrarNivelIdioma($id) {
        $conexion = db::entrar();
        $sql = "DELETE FROM niveles_idiomas WHERE id=:id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
    }

    public static function leerNivelIdiomaPorId($id) {
        $conexion = db::entrar();
        $sql = "SELECT * FROM niveles_idiomas WHERE id=:id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $result;
    }

    public static function leerTodosLosNivelesIdiomas() {
        $conexion = db::entrar();
        $sql = "SELECT * FROM niveles_idiomas";
        $stmt = $conexion->query($sql);
        $nivelesIdiomas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $nivelesIdiomas;
    }
}

?>
