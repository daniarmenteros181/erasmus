<?php
class TutorRepo {
    
  

    public static function crearTutor($dni, $nombre, $apellidos, $tlf, $domicilio) {
        $conexion = db::entrar();
        $sql = "INSERT INTO tutor (dni, nombre, apellidos, tlf, domicilio) VALUES (:dni, :nombre, :apellidos, :tlf, :domicilio)";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':dni', $dni);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellidos', $apellidos);
        $stmt->bindParam(':tlf', $tlf);
        $stmt->bindParam(':domicilio', $domicilio);
        $stmt->execute();
        $stmt->closeCursor();
    }

    // Actualizar un tutor existente por ID
    public static function actualizarTutor($id, $dni, $nombre, $apellidos, $tlf, $domicilio) {
        $conexion = db::entrar();
        $sql = "UPDATE tutor SET dni=:dni, nombre=:nombre, apellidos=:apellidos, tlf=:tlf, domicilio=:domicilio WHERE id=:id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':dni', $dni);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellidos', $apellidos);
        $stmt->bindParam(':tlf', $tlf);
        $stmt->bindParam(':domicilio', $domicilio);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
    }

    // Borrar un tutor por ID
    public static function borrarTutor($id) {
        $conexion = db::entrar();
        $sql = "DELETE FROM tutor WHERE id=:id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
    }

    // Leer un tutor por ID
    public static function leerTutorPorId($id) {
        $conexion = db::entrar();
        $sql = "SELECT * FROM tutor WHERE id=:id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $result;
    }

    // Leer todos los tutores
    public static function leerTodosLosTutores() {
        $conexion = db::entrar();
        $sql = "SELECT * FROM tutor";
        $stmt = $conexion->query($sql);
        $tutores = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $tutores;
    }
}
