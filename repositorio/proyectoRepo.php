<?php


class ProyectoRepo {

    public static function crearProyecto($cod_proyecto, $nombre, $fechaInicio, $fechaFin) {
        $conexion = db::entrar(); 
    
        $sql = "INSERT INTO proyecto (cod_proyecto, nombre, fechaInicio, fechaFin) VALUES (:cod_proyecto, :nombre, :fechaInicio, :fechaFin)";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':cod_proyecto', $cod_proyecto);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':fechaInicio', $fechaInicio);
        $stmt->bindParam(':fechaFin', $fechaFin);
        $stmt->execute();
        $stmt->closeCursor();
        }

    
 
    // Actualizar un proyecto existente por ID
    public static function actualizarProyecto($id, $cod_proyecto, $nombre, $fechaInicio, $fechaFin) {
        $conexion = db::entrar(); 

        $sql = "UPDATE proyecto SET cod_proyecto=:cod_proyecto, nombre=:nombre, fechaInicio=:fechaInicio, fechaFin=:fechaFin WHERE id=:id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':cod_proyecto', $cod_proyecto);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':fechaInicio', $fechaInicio);
        $stmt->bindParam(':fechaFin', $fechaFin);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
    }

    // Borrar un proyecto por ID
    public static function borrarProyecto($id) {
        $conexion = db::entrar(); 

        $sql = "DELETE FROM proyecto WHERE id=:id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
    }

    // Leer un proyecto por ID
    public static function leerProyectoPorId($id) {
        $conexion = db::entrar(); 

        $sql = "SELECT * FROM proyecto WHERE id=:id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->close();
        return $result;
    }

    // Leer todos los proyectos
    public static function leerTodosLosProyectos() {
        $conexion = db::entrar(); 

        $sql = "SELECT * FROM proyecto";
        $stmt = $conexion->prepare($sql);
        $proyectos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $proyectos;
    } 
}

?>
