
<?php



//Lo que tengo que hacer es dividir el formulario en tres y cada vez que le de a siguiente o anterior me lo vaya mostrando 
 class convocatoria{


    public static function comenzar(){
        mostrarMenu::mostrarMenuAdmin();


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
            $requisito = isset($_POST["requisito"]) ? 1 : 0;
            //Para las notas
            $notas = isset($_POST["notas"]) ? 1 : 0;
            $notaMaxima = $_POST["notaMaxima"];   
            $valorMinimo = $_POST["valorMinimo"];   
            
            //Para entrevista
            $entrevista = isset($_POST["entrevista"]) ? 1 : 0;
            $notaMaximaEntrevista = $_POST["notaMaximaEntrevista"];   
            $valorMinimoEntrevista = $_POST["valorMinimoEntrevista"]; 


              //Para entrevista
              $valorNivelIdioma = isset($_POST["valorNivelIdioma"]) ? 1 : 0;
             
            

              //Aporte alumno de Idioma
              $aporteAlumnoIdioma = isset($_POST["aporteAlumnoIdioma"]) ? 1 : 0;

               //Aporte alumno de Entrevista
               $aporteAlumnoEntrevista = isset($_POST["aporteAlumnoEntrevista"]) ? 1 : 0;

                //Aporte alumno de Notas
              $aporteAlumnoNotas = isset($_POST["aporteAlumnoNotas"]) ? 1 : 0;



        
            // Llamada a la función para crear un nuevo candidato
            convocatoriaRepo::crearConvocatoria($movilidades, $tipo, $fechaInicio, $fechaFin, $fechaInicioPrueba, $fechaFinPrueba, $fechaInicioDefinitiva, $fk_proyecto,$id_destinatario ,$requisito ,$notas,$notaMaxima,$valorMinimo,$entrevista,$notaMaximaEntrevista,$valorMinimoEntrevista,$valorNivelIdioma,$aporteAlumnoIdioma,$aporteAlumnoNotas,$aporteAlumnoEntrevista);
        
        }

    }

 }
 convocatoria::comenzar();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Dividido</title>
         <link rel="stylesheet" href="../estilos/crearConvocatoria.css">

           <link rel="stylesheet" href="../js/convo.js">


    
</head>
<body>

<form id="miFormularioConvo" method="post" action="">

    <div id="datos">
        <h1>Creacion de convocatoria</h1>

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

        <input type="button" value="Siguiente" name="siguiente3" onclick="mostrarElementosBaremo()">

    </div>








        
    <div id="elementosBaremo" style="display: none;">


        <label for="valorNivelIdioma">Nivel de Idioma:</label>
        <input type="checkbox" id="valorNivelIdioma" name="valorNivelIdioma" value="valorNivelIdioma" onchange="mostrarCamposNivelIdioma(this)">

          <!-- Nuevos campos para mostrar cuando se selecciona "Nivel de Idioma" -->
    <div id="camposNivelIdioma" style="display: none;">
        
        <!-- Mostrar campos para cada nivel -->
        

        <label for="valorNivelIdiomaA1">Valor Nivel A1:</label>
        <input type="text" id="valorNivelIdiomaA1" name="valorNivelIdiomaA1"><br><br>

        <label for="valorNivelIdiomaA2">Valor Nivel A2:</label>
        <input type="text" id="valorNivelIdiomaA2" name="valorNivelIdiomaA2"><br><br>

        <label for="valorNivelIdiomaB1">Valor Nivel B1:</label>
        <input type="text" id="valorNivelIdiomaB1" name="valorNivelIdiomaB1"><br><br>

        <label for="valorNivelIdiomaB2">Valor Nivel B2:</label>
        <input type="text" id="valorNivelIdiomaB2" name="valorNivelIdiomaB2"><br><br>

        <label for="valorNivelIdiomaC1">Valor Nivel C1:</label>
        <input type="text" id="valorNivelIdiomaC1" name="valorNivelIdiomaC1"><br><br>

        <label for="valorNivelIdiomaC2">Valor Nivel C2:</label>
        <input type="text" id="valorNivelIdiomaC2" name="valorNivelIdiomaC2"><br><br>

        <label for="aporteAlumnoIdioma">Aporte Alumno:</label>
        <input type="checkbox" id="aporteAlumnoIdioma" name="aporteAlumnoIdioma" value="aporteAlumno">
        <hr>

    </div>
     



        <label for="entrevista">Entrevista:</label>
        <input type="checkbox" id="entrevista" name="entrevista" value="entrevista" onchange="mostrarCamposEntrevista(this)">

        <!-- Nuevos campos para mostrar cuando se selecciona "Entrevista" -->
        <div id="camposEntrevista" style="display: none;">
            <label for="notaMaximaEntrevista">Nota Máxima:</label>
            <input type="text" id="notaMaximaEntrevista" name="notaMaximaEntrevista"><br><br>

            <label for="valorMinimoEntrevista">Valor Mínimo:</label>
            <input type="text" id="valorMinimoEntrevista" name="valorMinimoEntrevista"><br><br>

            <label for="aporteAlumnoEntrevista">Aporte Alumno:</label>
            <input type="checkbox" id="aporteAlumnoEntrevista" name="aporteAlumnoEntrevista" value="aporteAlumno">

            <label for="ficheroIdoneidadEntrevista">Fichero de Idoneidad:</label>
            <input type="checkbox" id="ficheroIdoneidadEntrevista" name="ficheroIdoneidadEntrevista" value="ficheroIdoneidad">
            <hr>

        </div>

        

        <label for="notas">Notas:</label>
        <input type="checkbox" id="notas" name="notas" value="notas" onchange="mostrarCamposNotas(this)">

         <!-- Nuevos campos para mostrar cuando se selecciona "Notas" -->
        <div id="camposNotas" style="display: none;">
            <label for="notaMaxima">Nota Máxima:</label>
            <input type="text" id="notaMaxima" name="notaMaxima"><br><br>

            <label for="valorMinimo">Valor Mínimo:</label>
            <input type="text" id="valorMinimo" name="valorMinimo"><br><br>

            <label for="aporteAlumnoNotas">Aporte Alumno:</label>
            <input type="checkbox" id="aporteAlumnoNotas" name="aporteAlumnoNotas" value="aporteAlumno">

            <label for="ficheroIdoneidad">Fichero de Idoneidad:</label>
            <input type="checkbox" id="ficheroIdoneidadNotas" name="ficheroIdoneidadNotas" value="ficheroIdoneidad">
            <hr>

        </div> 

        <label for="requisito">Requisito:</label>
        <input type="checkbox" id="requisito" name="requisito" value="requisito" >


    <input type="button" value="Anterior" name="anterior" onclick="mostrarDatos()">
    <input type="button" value="Siguiente" name="siguiente" onclick="mostrarFechas()">
</div>

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
        <input type="submit" value="Entrar" id="entrar"name="entrar">
    </div>
</form>




<script>

    
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



    function mostrarCamposEntrevista(checkbox) {
        var camposEntrevista = document.getElementById('camposEntrevista');
        camposEntrevista.style.display = checkbox.checked ? 'block' : 'none';
    }

    function mostrarCamposNotas(checkbox) {
        var camposNotas = document.getElementById('camposNotas');
        camposNotas.style.display = checkbox.checked ? 'block' : 'none';
    }

    function mostrarCamposRequisito(checkbox) {
        var camposRequisito = document.getElementById('camposRequisito');
        camposRequisito.style.display = checkbox.checked ? 'block' : 'none';
    }

    function mostrarCamposNivelIdioma(checkbox) {
        var camposNivelIdioma = document.getElementById('camposNivelIdioma');
        camposNivelIdioma.style.display = checkbox.checked ? 'block' : 'none';
    }
</script>

</body>
</html>
