<?php

class ItemBaremoRepo {



    // Crear un nuevo item de baremo
    public static function crearItemBaremo($nombre) {
        $conexion = db::entrar();

        $sql = "INSERT INTO itembaremo (nombre) VALUES (:nombre)";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->execute();
        $stmt->closeCursor();
    }

    // Actualizar un item de baremo existente por ID
    public static function actualizarItemBaremo($id, $nombre) {
        $conexion = db::entrar();

        $sql = "UPDATE itembaremo SET nombre=:nombre WHERE id=:id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
    }

    // Borrar un item de baremo por ID
    public static function borrarItemBaremo($id) {
        $conexion = db::entrar();

        $sql = "DELETE FROM itembaremo WHERE id=:id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
    }

    // Leer un item de baremo por ID
    public static function leerItemBaremoPorId($id) {
        $conexion = db::entrar();

        $sql = "SELECT * FROM itembaremo WHERE id=:id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->close();
        return $result;
    }

    // Leer todos los items de baremo
    public static function leerTodosLosItemsBaremo() {
        $conexion = db::entrar();

        $sql = "SELECT * FROM itembaremo";
        $stmt = $conexion->prepare($sql);
        $itemsBaremo = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $itemsBaremo;
    }
}

?>
