<?php



//Lo que tengo que hacer es dividir el formulario en tres y cada vez que le de a siguiente o anterior me lo vaya mostrando 
 class convocatoria{

    public static function comenzar(){

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Recoger los datos del formulario
            $movilidades = $_POST["movilidades"];
            $tipo = $_POST["tipo"];
            $fechaInicio = $_POST["fechaInicio"];
            $fechaFin = $_POST["fechaFin"];
            $fechaInicioPrueba = $_POST["fechaInicioPrueba"];
            $fechaFinPrueba = $_POST["fechaFinPrueba"];
            $fechaInicioDefinitiva = $_POST["fechaInicioDefinitiva"];
            $fk_proyecto = $_POST["fk_proyecto"];
            $id_destinatario = $_POST["id_destinatario"];                
        
            // Llamada a la función para crear un nuevo candidato
            convocatoriaRepo::crearConvocatoria($movilidades, $tipo, $fechaInicio, $fechaFin, $fechaInicioPrueba, $fechaFinPrueba, $fechaInicioDefinitiva, $fk_proyecto,$id_destinatario);
        
        }


    }

    public static function crearConvocatoria($movilidades, $tipo, $fechaInicio, $fechaFin, $fechaInicioPrueba, $fechaFinPrueba, $fechaInicioDefinitiva, $fk_proyecto) {
        $conexion = db::entrar();
    
        try {
            $conexion->beginTransaction();
    
            // Paso 1: Insertar en la tabla convocatoria
            $sql = "INSERT INTO convocatoria (movilidades, tipo, fechaInicio, fechaFin, fechaInicioPrueba, fechaFinPrueba, fechaInicioDefinitiva, fk_proyecto) VALUES (:movilidades, :tipo, :fechaInicio, :fechaFin, :fechaInicioPrueba, :fechaFinPrueba, :fechaInicioDefinitiva, :fk_proyecto)";
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':movilidades', $movilidades);
            $stmt->bindParam(':tipo', $tipo);
            $stmt->bindParam(':fechaInicio', $fechaInicio);
            $stmt->bindParam(':fechaFin', $fechaFin);
            $stmt->bindParam(':fechaInicioPrueba', $fechaInicioPrueba);
            $stmt->bindParam(':fechaFinPrueba', $fechaFinPrueba);
            $stmt->bindParam(':fechaInicioDefinitiva', $fechaInicioDefinitiva);
            $stmt->bindParam(':fk_proyecto', $fk_proyecto, PDO::PARAM_INT);
    
    
            $stmt->execute();
    
            // Paso 2: Obtener la última ID insertada
            $idConvocatoria = $conexion->lastInsertId();
    
            // Paso 3: Insertar en la tabla destinatarioconvocatoria
            $sqlDestinatario = "INSERT INTO destinatarioconvocatoria (id_convocatoria, id_destinatario) VALUES (:id_convocatoria, :id_destinatario)";
            $stmtDestinatario = $conexion->prepare($sqlDestinatario);
            
            // Establecer el valor deseado para id_destinatario
    /*         $id_destinatario = "B";  // Sustituye esto con el valor real que deseas insertar en id_destinatario
     */        
            $stmtDestinatario->bindParam(':id_convocatoria', $idConvocatoria, PDO::PARAM_INT);
            $stmtDestinatario->bindParam(':id_destinatario', $id_destinatario);
            $stmtDestinatario->execute();
    
            // Paso 4: Confirmar la transacción
            $conexion->commit();
        } catch (Exception $e) {
            // Paso 5: Manejar cualquier excepción y realizar un rollback si es necesario
            $conexion->rollBack();
            echo "Error: " . $e->getMessage();
        } finally {
            // Paso 6: Cerrar los cursores
            $stmt->closeCursor();
            $stmtDestinatario->closeCursor();
        }
    }
    



 }
 convocatoria::comenzar();




?>


<!DOCTYPE html>
<html>
<head>
    <title>Registro </title>
    <link rel="stylesheet" href="../estilos/crearConvocatoria.css">

 </head>
<body>

    <div id="coge">
    <h1>Convocatoria</h1>

    <form id="miFormulario" method="post" action="">

        <label for="movilidades">Movilidades:</label>
        <input type="text" id="movilidades" name="movilidades"><br><br>

        <label for="tipo">Tipo :</label>
        <input type="text" id="tipo" name="tipo"><br><br>

        <label for="fechaInicio">fechaInicio:</label>
        <input type="date" id="fechaInicio" name="fechaInicio"><br><br>

        <label for="fechaFin">fechaFin:</label>
        <input type="date" id="fechaFin" name="fechaFin"><br><br>

        <label for="fechaInicioPrueba">fechaInicioPrueba:</label>
            <input type="date" id="fechaInicioPrueba" name="fechaInicioPrueba" ><br><br>

        <label for="fechaFinPrueba">fechaFinPrueba:</label>
        <input type="date" id="fechaFinPrueba" name="fechaFinPrueba"><br><br>

        <label for="fechaInicioDefinitiva">fechaInicioDefinitiva:</label>
        <input type="date" id="correo" name="fechaInicioDefinitiva"><br><br>

        <label for="fk_proyecto">fk_proyecto:</label>
        <input type="text" id="fk_proyecto" name="fk_proyecto"><br><br>

        <label for="id_destinatario">Destinatario:</label>
        <input type="text" id="id_destinatario" name="id_destinatario" ><br><br>

        


        <input type="submit" value="Entrar" name="entrar">
        <br>



        
    </form>


    </div>
    </body>
</html>