<?php


class Principal
{
    public static function main()
    {
        
   
        require_once 'cargador.php';


        // Obtener la conexión a la base de datos
        $conexion = db::entrar();

        // Verificar la conexión (en caso de error)
        if (!$conexion) {
            die("Error de conexión a la base de datos");
        }

       


       /*  $convocatoriaRepo = new ConvocatoriaRepo($conexion);
        $movilidades = "3";
        $tipo = "Corta";
        $fechaInicio = "2005-11-23";  // Formato correcto para MySQL
        $fechaFin = "2005-11-23";     // Formato correcto para MySQL
        $fechaInicioPrueba = "2002-11-23";
        $fechaFinPrueba = "2004-11-23";
        $fechaInicioDefinitiva = "2006-11-23";
        $fk_proyecto = "2";
        $convocatoriaRepo->crearConvocatoria($movilidades, $tipo, $fechaInicio, $fechaFin, $fechaInicioPrueba, $fechaFinPrueba, $fechaInicioDefinitiva, $fk_proyecto); */




         $candidatoRepo = new CandidatosRepo($conexion);

        $dni = "12345678R";
        $fechaNac = "2000-01-01";  // Formato correcto para MySQL
        $apellidos = "Apellido";
        $nombre = "Nombre";
        $tlf = "123456789";
        $correo = "correo@example.com";
        $domicilio = "Calle Principal";
/*          $fk_tutor = "12345648Z";  // ID del tutor existente
 */          $fk_destinatario = "B";  // ID del destinatario existente
        $contrasenia = "contrasena_segura";
        $rol ="Alumno";

        candidatosRepo::crearCandidatoo($dni, $fechaNac, $apellidos, $nombre, $tlf, $correo, $domicilio,$fk_destinatario, $contrasenia,$rol);
  
 




   /*    $cod_grupo = "D";
      $nombre = "DAWEB"; 
      DestinatarioRepo::crearDestinatario($cod_grupo, $nombre); */








        /* // Crear una instancia del repositorio DestinatarioConvocatoriaRepo
        $repo = new DestinatarioConvocatoriaRepo($conexion);

        // Supongamos que tienes los ID de convocatoria y destinatario
        $idConvocatoria = 2;
        $idDestinatario = "B";

        // Llamar al método para crear la asociación
        $repo->crearDestinatarioConvocatoria($idConvocatoria, $idDestinatario);


 */



        /*$cod_grupo = "B";
        $nombre ="DAA"; */







       /*  $cod_proyecto = "5";
        $nombre = "Nombre";
        $fechaInicio = "23/11/2005";
        $fechaFin = "23/11/2006";
        proyectoRepo::crearProyecto($cod_proyecto, $nombre, $fechaInicio, $fechaFin);  */    




        /* $id = "6";
        proyectoRepo::borrarProyecto($id);   */   




      /*   $dni = "12345678O";
        $nombre = "Alexander";
        $apellidos = "alex";
        $tlf = "047384912";
        $domicilio = "Calle Principal";
        tutorRepo::crearTutor($dni,$nombre,$apellidos,$tlf,$domicilio); */  



         /*  $tutorRepo->borrarProyecto($id);
           $tutorRepo->crearNivelIdioma($niveles);        

             $tutorRepo->crearDestinatario(  $cod_grupo,$nombre );
  */

}
               
}
Principal::main();








?>
