<?php


class CandidatosConvocatoriaRepo {
    

    public static function obtenerCandidatosConvocatoria() {
        $conexion = db::entrar();
    
        $sql = "SELECT * FROM candidatosconvocatoria";
        $stmt = $conexion->prepare($sql);
        $stmt->execute(); // Ejecutar la consulta
    
        $candidatosConvocatoria = [];
    
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $candidatosConvocatoria[] = $row;
            echo "ID: " . $row['id'] . ", Nombre: " . $row['id_convocatoria'] . ", Otros Campos: " . $row['id_candidatos'] . "<br>";

        }
        return $candidatosConvocatoria;
    }
    



    


    // Obtener un registro de candidatos_convocatoria por ID
    public static function obtenerCandidatoConvocatoriaPorId($id) {
        $conexion = db::entrar();

        $sql = "SELECT * FROM candidatosconvocatoria WHERE id = :id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Editar un registro de candidatos_convocatoria por ID
    public static function editarCandidatoConvocatoriaPorId($id, $nuevoIdConvocatoria, $nuevoIdCandidato) {
        $conexion = db::entrar();

        $sql = "UPDATE candidatosconvocatoria SET id_convocatoria = :nuevo_id_convocatoria, id_candidatos = :nuevo_id_candidato WHERE id = :id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':nuevo_id_convocatoria', $nuevoIdConvocatoria);
        $stmt->bindParam(':nuevo_id_candidato', $nuevoIdCandidato);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    // Eliminar un registro de candidatos_convocatoria por ID
    public static function eliminarCandidatoConvocatoriaPorId($id) {
        $conexion = db::entrar();

        $sql = "DELETE FROM candidatosconvocatoria WHERE id = :id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

     /* public static function insertarCandidatoConvocatoria($idCandidatos, $idConvocatoria) {
        
        $conexion = db::entrar();
    
        $sql = "INSERT INTO candidatosconvocatoria (id_candidatos, id_convocatoria) VALUES (:id_candidatos, :id_convocatoria)";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id_candidatos', $idCandidato, PDO::PARAM_INT);
        $stmt->bindParam(':id_convocatoria', $idConvocatoria, PDO::PARAM_INT);
        $stmt->execute();
    
        $stmt->closeCursor();
    }  */

    public static function insertarCandidatoConvocatoria($idCandidatos, $idConvocatoria) {
        $conexion = db::entrar();
    
        $sql = "INSERT INTO candidatosconvocatoria (id_candidatos, id_convocatoria) VALUES (:id_candidatos, :id_convocatoria)";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id_candidatos', $idCandidatos, PDO::PARAM_INT); // Corregir aquí
        $stmt->bindParam(':id_convocatoria', $idConvocatoria, PDO::PARAM_INT);
        $stmt->execute();
    
/*         $stmt->closeCursor();
 */    }
    
    
    
}

?>
