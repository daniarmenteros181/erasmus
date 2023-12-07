<?php

class DestinatarioRepo {


    // Crear un nuevo destinatario
    public static function crearDestinatario($cod_grupo, $nombre) {
        $conexion = db::entrar();

        $sql = "INSERT INTO destinatario (cod_grupo, nombre) VALUES (:cod_grupo, :nombre)";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':cod_grupo', $cod_grupo);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->execute();
        $stmt->closeCursor();
    }

    /* // Actualizar un destinatario existente por ID
    public static function actualizarDestinatario($cod_grupo, $nombre) {
        $conexion = db::entrar();

        $sql = "UPDATE destinatario SET cod_grupo=:cod_grupo, nombre=:nombre WHERE id=:id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':cod_grupo', $cod_grupo);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
    } */

    // Borrar un destinatario por ID
    public static function borrarDestinatario($id) {
        $conexion = db::entrar();

        $sql = "DELETE FROM destinatario WHERE id=:id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
    }

    // Leer un destinatario por ID
    public static function leerDestinatarioPorId($id) {
        $conexion = db::entrar();

        $sql = "SELECT * FROM destinatario WHERE id=:id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->close();
        return $result;
    }

    // Leer todos los destinatarios
    public static function leerTodosLosDestinatarios() {
        $conexion = db::entrar();

        $sql = "SELECT * FROM destinatario";
        $stmt = $conexion->prepare($sql);
        $destinatarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $destinatarios;
    }

    /* // Leer todos los destinatarios y obtener ID y nombre
    public static function leerIdsYNombresDestinatarios() {
        $conexion = db::entrar();

        $sql = "SELECT cod_grupo, nombre FROM destinatario";
        $stmt = $conexion->prepare($sql);
        $stmt->execute();

        $destinatarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt->closeCursor();

        return $destinatarios;
    } */

    // Leer todos los destinatarios y obtener ID, código de grupo y nombre
    public static function leerDatosDestinatarios() {
        $conexion = db::entrar();

        $sql = "SELECT cod_grupo, nombre FROM destinatario";
        $stmt = $conexion->prepare($sql);
        $stmt->execute();

        $destinatarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt->closeCursor();

        return $destinatarios;
    }


}

?>
