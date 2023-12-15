
<?php

class seleccionConvocatoria {


    public static function comenzar() {

        mostrarMenu::mostrarMenuAlumno();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $idConvo = $_POST['id'];
        
        
           $idCandidato = convocatoriaRepo::obtenerIdCandidato();
                                 
        } 

?>

        <!DOCTYPE html>
        <html lang="es">
        <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Editar Candidato</title>
        <script src="../js/solicitud.js"></script>
        <link rel="stylesheet" href="../estilos/crearSolicitud.css">
        </head>
        
        <body>

        <form id="candidatoForm" method="post" action="">
            
        <h2>Editar Candidato</h2>


        <div class="form-column" id="firstColumn">

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

     

        </div>

        <div class="form-column" id="segundo">

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

<!--         Paso al js los id del candidato y convocatoria-->        
        <input type="hidden" id="idCandidato" name="id" value="<?php echo $idCandidato; ?>">
        <input type="hidden" id="idConvo" name="idConvo" value="<?php echo $idConvo; ?>">


        </div>
        <input type="submit" name="Actualizar" value="Crear">
        <input type="submit" name="descargarPDF" value="Descargar PDF">

        <br>

        <div id="contenedorItemBaremos">

        </div>
    </form>
    </body>
    </html>
    <?php
     
             
        }

        
                      
    } 

seleccionConvocatoria::comenzar();





?>



