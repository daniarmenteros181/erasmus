<?php

class registro{


     public static function comenzar() {
    
    
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Recoger los datos del formulario
            $dni = $_POST["dni"];
            $nombre = $_POST["nombre"];
            $apellidos = $_POST["apellidos"];
            $contra = $_POST["contra"];
            $fechaNac = $_POST["fechaNac"];
            $fk_destinatario = $_POST["fk_destinatario"];
            $telefono = $_POST["telefono"];
            $correo = $_POST["correo"];
            $domicilio = $_POST["domicilio"];
        
            
        
            $dniTutor = $_POST["dniTutor"];
            $nombreTutor = $_POST["nombreTutor"];
            $apellidosTutor = $_POST["apellidosTutor"];
            $tutorTelefono = $_POST["tutorTelefono"];
            $domicilioTutor = $_POST["domicilioTutor"];
         
            // Llamada a la función para crear un nuevo candidato
            CandidatosRepo::crearCandidatoo($dni, $fechaNac, $apellidos, $nombre, $telefono, $correo, $domicilio,$fk_destinatario, $contra, 'usuario');

        
    
            
        }
        
    }
    }
    }
    
    registro::comenzar();



 




?>


<!DOCTYPE html>
<html>
<head>
    <title>Registro </title>
    <script src="../js/candidatoTutor.js"></script>
     <link rel="stylesheet" href="../estilos/estilosLogin.css">
 </head>
<body>

    <div id="coge">
    <h1>Registro</h1>

    <form id="miFormulario" method="post" action="">
    <div id="seccion1">

        <label for="dni">Dni:</label>
        <input type="text" id="dni" name="dni"><br><br>

        <label for="nombre">Nombre :</label>
        <input type="text" id="nombre" name="nombre"><br><br>

        <label for="apellidos">Apellidos:</label>
        <input type="text" id="apellidos" name="apellidos"><br><br>

        <label for="contra">Contraseña:</label>
        <input type="text" id="contra" name="contra"><br><br>

        

        
        <label for="fk_destinatario">Curso:</label>
         <select id="fk_destinatario" name="fk_destinatario">
         <?php
        // Obtén la lista de IDs y nombres de destinatarios
        $destinatarios = DestinatarioRepo::leerDatosDestinatarios();

        // Genera las opciones del formulario
        foreach ($destinatarios as $destinatario) {
            $idDestinatario = $destinatario['cod_grupo'];
            $nombreDestinatario = $destinatario['nombre'];
            echo "<option value=\"$idDestinatario\">$nombreDestinatario</option>";
        }
        ?>
        </select>
        <br><br>

    </div>

    <div id="seccion2" style="display: none;">

        <label for="telefono">Telefono:</label>
        <input type="number" id="telefono" name="telefono"><br><br>

        <label for="correo">Correo:</label>
        <input type="text" id="correo" name="correo"><br><br>

        <label for="domicilio">Domicilio:</label>
        <input type="text" id="domicilio" name="domicilio"><br><br>
        <label for="fechaNac">Fecha de Nacimiento:</label>


        <input type="date" id="fechaNac" name="fechaNac" onchange="mostrarFormularioTutor();" required><br><br>

        
        <div id="formularioTutor" style="display: none;">
        <h2>Datos del Tutor</h2>

<!--         este el formulario de tutor que solo se muestra cuando un candidato es menor de edad -->        


        <label for="dniTutor">Dni:</label>
        <input type="text" id="dniTutor" name="dniTutor"><br><br>

        <label for="nombreTutor">Nombre del Tutor:</label>
        <input type="text" id="nombreTutor" name="nombreTutor"><br><br>

        <label for="apellidosTutor">Apellidos del Tutor:</label>
        <input type="text" id="apellidosTutor" name="apellidosTutor"><br><br>

        <label for="tutorTelefono">Teléfono del Tutor:</label>
        <input type="number" id="tutorTelefono" name="tutorTelefono"><br><br>

        <label for="domicilioTutor">Domicilio del Tutor:</label>
        <input type="number" id="domicilioTutor" name="domicilioTutor"><br><br>

    </div>


    </div>
    <input type="button" value="Anterior" id="anterior" onclick="mostrarSeccion('seccion1')">
    <input type="button" value="Siguiente" id="siguiente" onclick="mostrarSeccion('seccion2')">
    <input type="submit" value="Entrar" name="entrar">
     
    </form>

    <script>
         function mostrarSeccion(seccion) {
        var seccion1 = document.getElementById('seccion1');
        var seccion2 = document.getElementById('seccion2');

        if (seccion === 'seccion1') {
            seccion1.style.display = 'block';
            seccion2.style.display = 'none';
        } else if (seccion === 'seccion2') {
            seccion1.style.display = 'none';
            seccion2.style.display = 'block';
        }
    }
    </script>


    </div>
    </body>
    
</html>