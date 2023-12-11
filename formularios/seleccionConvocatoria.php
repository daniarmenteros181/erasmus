<?php

require_once '../repositorio/db.php'; 
require_once '../helpers/sesion.php'; 



sesion::iniciaSesion();

class seleccionConvocatoria {

    public static function comenzar() {

        // Obtener la ID del candidato (puedes ajustar cómo obtienes esto según tu aplicación)
        $idConvo = isset($_GET['idConvo']) ? intval($_GET['idConvo']) : null;
        $idCandidato = isset($_GET['idCandidato']) ? intval($_GET['idCandidato']) : null;
          
        // Mostrar el formulario con los datos del candidato
        ?>

        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Editar Candidato</title>
            <script src="../js/solicitud.js"></script>
        </head>
        <body>
        <h2>Editar Candidato</h2>

        <form id="candidatoForm">
        <label for="dni">DNI:</label>
        <input type="text" id="dni" name="dni"><br>

        <label for="fechaNac">Fecha de Nacimiento:</label>
        <input type="date" id="fechaNac" name="fechaNac"><br>

        <label for="apellidos">Apellidos:</label>
        <input type="text" id="apellidos" name="apellidos"><br>

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre"><br>

        <label for="tlf">Teléfono:</label>
        <input type="text" id="tlf" name="tlf"><br>

        <label for="correo">Correo:</label>
        <input type="email" id="correo" name="correo"><br>

        <label for="domicilio">Domicilio:</label>
        <input type="text" id="domicilio" name="domicilio"><br>
        

        <label for="fk_destinatario">ID Destinatario:</label>
        <input type="text" id="fk_destinatario" name="fk_destinatario"><br>

        <label for="contrasenia">Contraseña:</label>
        <input type="password" id="contrasenia" name="contrasenia"><br>

        <label for="rol">Rol:</label>
        <input type="text" id="rol" name="rol"><br>

        <input type="hidden" id="idCandidato" name="id" value="<?php echo $idCandidato; ?>">


        <input type="submit" name="Actualizar" value="Actualizar">
        <input type="submit" name="DescargarPDF" value="Descargar PDF">
        <br>
        
    </form>

    </body>


    </html>
    <?php
     
             
        }
                      
    } 

seleccionConvocatoria::comenzar();

?>
