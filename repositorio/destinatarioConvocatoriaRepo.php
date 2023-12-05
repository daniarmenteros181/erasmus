<?php

class DestinatarioConvocatoriaRepo {
    

    // Crear una nueva asociación entre destinatario y convocatoria
    public static function crearDestinatarioConvocatoria($idConvocatoria, $idDestinatario) {
        $conexion = db::entrar();

        $sql = "INSERT INTO destinatarioconvocatoria (id_convocatoria, id_destinatario) VALUES (:idConvocatoria, :idDestinatario)";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':idConvocatoria', $idConvocatoria, PDO::PARAM_INT);
        $stmt->bindParam(':idDestinatario', $idDestinatario, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
    }

    // Actualizar una asociación existente por ID (si es necesario)
    public static function actualizarDestinatarioConvocatoria($id, $idConvocatoria, $idDestinatario) {
        $conexion = db::entrar();

        $sql = "UPDATE destinatarioconvocatoria SET id_convocatoria=:idConvocatoria, id_destinatario=:idDestinatario WHERE id=:id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':idConvocatoria', $idConvocatoria, PDO::PARAM_INT);
        $stmt->bindParam(':idDestinatario', $idDestinatario, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
    }

    // Borrar una asociación por ID
    public static function borrarDestinatarioConvocatoria($id) {
        $conexion = db::entrar();

        $sql = "DELETE FROM destinatarioconvocatoria WHERE id=:id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
    }

   

    // Leer una asociación por ID
    public static function leerDestinatarioConvocatoriaPorId($id) {
        $conexion = db::entrar();

        $sql = "SELECT * FROM destinatarioconvocatoria WHERE id=:id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->close();
        return $result;
    }

    // Leer todas las asociaciones
    public static function leerTodasLasDestinatarioConvocatorias() {
        $conexion = db::entrar();

        $sql = "SELECT * FROM destinatarioconvocatoria";
        $stmt = $conexion->prepare($sql);
        $asociaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $asociaciones;
    }
}
?>
