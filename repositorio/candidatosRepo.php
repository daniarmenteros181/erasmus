<?php


class CandidatosRepo {

   // Crear un nuevo candidato  
   public static function crearCandidatoo($dni, $fechaNac, $apellidos, $nombre, $tlf, $correo, $domicilio,$fk_destinatario, $contrasenia, $rol) {
    $conexion = db::entrar();

    $sql = "INSERT INTO candidatos (dni, fechaNac, apellidos, nombre, tlf, correo, domicilio,fk_destinatario, contrasenia, rol) VALUES (:dni, :fechaNac, :apellidos, :nombre, :tlf, :correo, :domicilio,:fk_destinatario, :contrasenia, :rol)";
   
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':dni', $dni);
    $stmt->bindParam(':fechaNac', $fechaNac);
    $stmt->bindParam(':apellidos', $apellidos);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':tlf', $tlf);
    $stmt->bindParam(':correo', $correo);
    $stmt->bindParam(':domicilio', $domicilio);
    $stmt->bindParam(':fk_destinatario', $fk_destinatario);
    $stmt->bindParam(':contrasenia', $contrasenia);
    $stmt->bindParam(':rol', $rol);
    $stmt->execute();


    $stmt->closeCursor();
}

    // Crear un nuevo candidato  
    public static function crearCandidato($dni, $fechaNac, $apellidos, $nombre, $tlf, $correo, $domicilio, $fk_tutor, $fk_destinatario, $contrasenia, $rol) {
        $conexion = db::entrar();

        $sql = "INSERT INTO candidatos (dni, fechaNac, apellidos, nombre, tlf, correo, domicilio, fk_tutor, fk_destinatario, contrasenia, rol) VALUES (:dni, :fechaNac, :apellidos, :nombre, :tlf, :correo, :domicilio, :fk_tutor, :fk_destinatario, :contrasenia, :rol)";
       
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':dni', $dni);
        $stmt->bindParam(':fechaNac', $fechaNac);
        $stmt->bindParam(':apellidos', $apellidos);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':tlf', $tlf);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':domicilio', $domicilio);
        $stmt->bindParam(':fk_tutor', $fk_tutor, PDO::PARAM_INT);
        $stmt->bindParam(':fk_destinatario', $fk_destinatario, PDO::PARAM_INT);
        $stmt->bindParam(':contrasenia', $contrasenia);
        $stmt->bindParam(':rol', $rol);
        $stmt->execute();
        $stmt->closeCursor();
    }

    // Actualizar un candidato existente por ID
    public static function actualizarCandidato($id, $dni, $fechaNac, $apellidos, $nombre, $tlf, $correo, $domicilio, $fk_destinatario, $contrasenia, $rol) {
        $conexion = db::entrar();

        $sql = "UPDATE candidatos SET dni=:dni, fechaNac=:fechaNac, apellidos=:apellidos, nombre=:nombre, tlf=:tlf, correo=:correo, domicilio=:domicilio, fk_destinatario=:fk_destinatario, contrasenia=:contrasenia, rol=:rol WHERE id=:id";
        
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':dni', $dni);
        $stmt->bindParam(':fechaNac', $fechaNac);
        $stmt->bindParam(':apellidos', $apellidos);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':tlf', $tlf);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':domicilio', $domicilio);
       $stmt->bindParam(':fk_destinatario', $fk_destinatario, PDO::PARAM_INT);
        $stmt->bindParam(':contrasenia', $contrasenia);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':rol', $rol);
        $stmt->execute();
        $stmt->closeCursor();
    }

    // Borrar un candidato por ID
    public static function borrarCandidato($id) {
        $conexion = db::entrar();

        $sql = "DELETE FROM candidatos WHERE id=:id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
    }

    // Leer un candidato por ID
    public static function leerCandidatoPorId($id) {
        $conexion = db::entrar();

        $sql = "SELECT * FROM candidatos WHERE id=:id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
/*         $stmt->close();
 */
        return $result;
    }
    // Leer todos los candidatos
    public static function leerTodosLosCandidatos() {
        $conexion = db::entrar();

        $sql = "SELECT * FROM candidatos";
        $stmt = $conexion->prepare($sql);
        $candidatos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $candidatos;
    }
}




