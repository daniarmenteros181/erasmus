<?php

 require_once '../repositorio/convocatoriaRepo.php'; 
require_once '../repositorio/candidatosConvocatoriaRepo.php'; 
require_once '../repositorio/candidatosRepo.php'; 
require_once '../repositorio/db.php'; 
require_once '../helpers/sesion.php';  

sesion::iniciaSesion();

class seleccionConvocatoria {

    public static function comenzar() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            if (isset($_POST['crear'])) {
                // Procesar creación de candidato
                self::procesarCreacion();
            } elseif (isset($_POST['Actualizar'])) {
                // Procesar actualización de candidato
                self::procesarActualizacion();
            } else {
                echo "Error al procesar la solicitud.";
            }
        }


        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $idConvo = $_POST['id'];

            // Obtener datos existentes de la convocatoria
            echo("convocatoria:  ,$idConvo");





            $id = convocatoriaRepo::obtenerIdCandidato();


              // Obtener los datos del candidato por ID
            $candidato = CandidatosRepo::leerCandidatoPorId($id);

            if ($candidato) {
                // Mostrar el formulario con los datos del candidato
                ?>

                <!DOCTYPE html>
                <html lang="es">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Editar Candidato</title>
                </head>
                <body>
                    <h2>Editar Candidato</h2>

                    <form method="post" action="">
                        <input type="hidden" name="id" value="<?php echo $candidato['id']; ?>">

                        <label for="dni">DNI:</label>
                        <input type="text" id="dni" name="dni" value="<?php echo $candidato['dni']; ?>"><br>

                        <label for="fechaNac">Fecha de Nacimiento:</label>
                        <input type="date" id="fechaNac" name="fechaNac" value="<?php echo $candidato['fechaNac']; ?>"><br>

                        <label for="apellidos">Apellidos:</label>
                        <input type="text" id="apellidos" name="apellidos" value="<?php echo $candidato['apellidos']; ?>"><br>

                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" value="<?php echo $candidato['nombre']; ?>"><br>

                        <label for="tlf">Teléfono:</label>
                        <input type="text" id="tlf" name="tlf" value="<?php echo $candidato['tlf']; ?>"><br>

                        <label for="correo">Correo:</label>
                        <input type="email" id="correo" name="correo" value="<?php echo $candidato['correo']; ?>"><br>

                        <label for="domicilio">Domicilio:</label>
                        <input type="text" id="domicilio" name="domicilio" value="<?php echo $candidato['domicilio']; ?>"><br>

                       
                        <label for="fk_destinatario">ID Destinatario:</label>
                        <input type="text" id="fk_destinatario" name="fk_destinatario" value="<?php echo $candidato['fk_destinatario']; ?>"><br>

                        <label for="contrasenia">Contraseña:</label>
                        <input type="password" id="contrasenia" name="contrasenia" value="<?php echo $candidato['contrasenia']; ?>"><br>

                        <label for="rol">Rol:</label>
                        <input type="text" id="rol" name="rol" value="<?php echo $candidato['rol']; ?>"><br>

                        <input type="submit" name="Actualizar" value="Actualizar">
                    </form>
                </body>
                </html>

                <?php
            }
             

                        echo "Crear una solicitud para la convocatoria $idConvo con dni de candidato $id";

                        echo "<td>";
                        echo "<form method='post' action=''>";  
                        echo "<input type='hidden' name='id_convo' value='$idConvo'>";
                        echo "<input type='hidden' name='id_candidato' value='$id'>";
                        echo "<input type='submit' name='crear' value='Crear'>";
                        echo "</form>";
                        echo "</td>";
        } 
    }


    private static function procesarCreacion() {
        // Obtener valores necesarios del formulario
        $idConvo = $_POST['id_convo'];
        $idCandidatos = $_POST['id_candidato'];

        // Insertar en la tabla candidatosconvocatoria
        candidatosConvocatoriaRepo::insertarCandidatoConvocatoria($idCandidatos, $idConvo);
        echo "Solicitud creada correctamente.";
    }


    private static function procesarActualizacion() {
        try {
            // Obtener datos del formulario
            $id = $_POST['id'];
            $dni = $_POST['dni'];
            $fechaNac = $_POST['fechaNac'];
            $apellidos = $_POST['apellidos'];
            $nombre = $_POST['nombre'];
            $tlf = $_POST['tlf'];
            $correo = $_POST['correo'];
            $domicilio = $_POST['domicilio'];
            $fk_destinatario = $_POST['fk_destinatario'];
            $contrasenia = $_POST['contrasenia'];
            $rol = $_POST['rol'];
            
            // Actualizar candidato
            candidatosRepo::actualizarCandidato($id, $dni, $fechaNac, $apellidos, $nombre, $tlf, $correo, $domicilio, $fk_destinatario, $contrasenia, $rol);
            
            // Redirigir después de la actualización
          /*   header("Location: ?menu:elegirConvocatoria"); // Reemplaza NOMBRE_DE_TU_PAGINA con el nombre de tu página
            exit(); */
        } catch (Exception $e) {
            echo "Error al actualizar el candidato: " . $e->getMessage();
        }
    }
}

seleccionConvocatoria::comenzar();

?>
