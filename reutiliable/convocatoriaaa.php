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

 }
 convocatoria::comenzar();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Registro </title>
<!--     <link rel="stylesheet" href="../estilos/crearConvocatoria.css">
 -->
 </head>
<body>

    <h1>Convocatoria</h1>

    <form id="miFormulario" method="post" action="" >

    <div id="datos">


   
        <label for="movilidades">Movilidades:</label>
        <input type="text" id="movilidades" name="movilidades"><br><br>

        <label for="tipo">Tipo:</label>
        <select id="tipo" name="tipo">
            <option value="corta">Corta</option>
            <option value="larga">Larga</option>
        </select>
        <br><br>


        <label for="id_destinatario">Destinatario:</label>
         <select id="id_destinatario" name="id_destinatario">
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
 


        <label for="fk_proyecto">fk_proyecto:</label>
        <select id="fk_proyecto" name="fk_proyecto"><br><br>

                <?php
        // Obtén la lista de códigos y nombres de proyectos
        $proyectos = ProyectoRepo::leerCodigosYNombresProyectos();

        // Genera las opciones del formulario
        foreach ($proyectos as $proyecto) {
            $codProyecto = $proyecto['cod_proyecto'];
            $nombreProyecto = $proyecto['nombre'];
            echo "<option value=\"$codProyecto\">$nombreProyecto</option>";
        }
        ?>
        <br>
        </select>
        <input type="button" value="Siguiente" name="siguiente" onclick="mostrarElementosBaremo()">

        

        
    </div>
       

    <div id="elementosBaremo " style="display: none;">


        <label for="nivelIdioma">Nivel de Idioma:</label>
        <input type="checkbox" id="nivelIdioma" name="nivelIdioma" value="nivelIdioma">

        <label for="entrevista">Entrevista:</label>
        <input type="checkbox" id="entrevista" name="entrevista" value="entrevista">

        <label for="notas">Notas:</label>
        <input type="checkbox" id="notas" name="notas" value="notas">

        <label for="requisito">Requisito:</label>
        <input type="checkbox" id="requisito" name="requisito" value="requisito">


        <input type="button" value="Anterior" name="anterior" onclick="mostrarDatos()">
        <input type="button" value="Siguiente" name="siguiente" onclick="mostrarFechas()">







        


    </div>

    <div id="fechas" style="display: none;">

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

            <input type="button" value="Anterior" name="anterior" onclick="mostrarElementosBaremo()">
        
    
    </div>

    <br>
        <input type="submit" value="Entrar" name="entrar">
        <br>

     


        <br>



        
    </form>


     <script>

      /*   function siguiente1() {
            document.getElementById('datos').style.display = 'none';
            document.getElementById('elementosBaremo').style.display = 'block';
            document.getElementById('fechas').style.display = 'block';

        }

        function siguiente2() {
        document.getElementById('datos').style.display = 'none';
        document.getElementById('fechas').style.display = 'none';
        document.getElementById('ElementosBaremo').style.display = 'block';
    }

        function atras2() {
            document.getElementById('datos').style.display = 'block';
            document.getElementById('fechas').style.display = 'none';
            document.getElementById('ElementosBaremo').style.display = 'none';
        } */

        
        function mostrarElementosBaremo() {
        document.getElementById('datos').style.display = 'none';
        document.getElementById('elementosBaremo').style.display = 'block';
        document.getElementById('fechas').style.display = 'none';
    }

    function mostrarDatos() {
        document.getElementById('datos').style.display = 'block';
        document.getElementById('elementosBaremo').style.display = 'none';
        document.getElementById('fechas').style.display = 'none';
    }

    function mostrarFechas() {
        document.getElementById('datos').style.display = 'none';
        document.getElementById('elementosBaremo').style.display = 'none';
        document.getElementById('fechas').style.display = 'block';
    }

    function atras2() {
        mostrarDatos();
    }

    function siguiente2() {
        mostrarFechas();
    }

    function atras3() {
        mostrarElementosBaremo();
    }

    function siguiente3() {
        // Puedes agregar lógica adicional o enviar el formulario aquí
        alert('Formulario enviado');
    }

    </script> 
    </body>
</html>