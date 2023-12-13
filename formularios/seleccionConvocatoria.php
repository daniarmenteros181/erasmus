<?php

require_once '../repositorio/db.php'; 
require_once '../helpers/sesion.php'; 
require_once './mostrarMenu.php'; 


use Dompdf\Dompdf;


sesion::iniciaSesion();

class seleccionConvocatoria {


    public static function comenzar() {

        mostrarMenu::mostrarMenuAlumno();


        // Verificar si se envió el formulario
      /*   if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['descargarPDF'])) {
                // Descargar el PDF automáticamente
                self::descargarPDF();
            }
        } */

        // Obtener la ID del candidato 
        $idConvo = isset($_GET['idConvo']) ? intval($_GET['idConvo']) : null;
        $idCandidato = isset($_GET['idCandidato']) ? intval($_GET['idCandidato']) : null;
          
        // Mostrar el formulario 
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

        <form id="candidatoForm" method="post" action="">
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

<!--         Paso al js los id del candidato y convocatoria-->        
        <input type="hidden" id="idCandidato" name="id" value="<?php echo $idCandidato; ?>">
        <input type="hidden" id="idConvo" name="idConvo" value="<?php echo $idConvo; ?>">



        <input type="submit" name="Actualizar" value="Crear">
        <input type="submit" name="descargarPDF" value="Descargar PDF">

        <br>
        
    </form>

    </body>


    </html>
    <?php
     
             
        }


        public static function descargarPDF(/* $candidato */) {
            // Código para generar el PDF con los datos del candidato y descargarlo
            require_once '../vendor/autoload.php';
    
            // Obtener datos de la convocatoria
           /*  $idConvoo = $candidato['idConvoo'];  // Ajusta esto según cómo estén almacenados los datos en tu base de datos
            $convocatoria = convocatoriaRepo::obtenerDatosConvocatoria($idConvoo); */
     
            $html = '
            <html>
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <title>Datos del Candidato</title>
            </head>
            <body>
                <h2>Datos del Candidato</h2>
                <p>ID: ' . $candidato['id'] . '</p>
                <p>DNI: ' . $candidato['dni'] . '</p>
                <p>Fecha de Nacimiento: ' . $candidato['fechaNac'] . '</p>
                <p>Nombre: ' . $candidato['nombre'] . '</p>
                <p>Apellidos: ' . $candidato['apellidos'] . '</p>
                <p>Domicilio: ' . $candidato['domicilio'] . '</p>
                <p>Convocatoria: ' . $convocatoria['idConvoo'] . '</p>
    
    
                <!-- Resto de los campos -->
            </body>
            </html>';
    
            $mipdf = new Dompdf();
            $mipdf->set_paper("A4", "portrait");
            $mipdf->load_html($html);
            $mipdf->render();
    
            // Obtén el contenido del PDF generado
            $pdf = $mipdf->output();
    
            // Configura el nombre del archivo
            $filename = "Candidato_" . $candidato['id'] . ".pdf";
    
            // Descargar el PDF al navegador
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            header('Content-Length: ' . strlen($pdf));
            header('Content-Transfer-Encoding: binary');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            ob_clean();
            flush();
            echo $pdf;
            exit;
        }

        
                      
    } 

seleccionConvocatoria::comenzar();





?>



