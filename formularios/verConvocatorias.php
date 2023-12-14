<?php


class verConvocatorias{

    public static function comenzar() {


 $nombreUsuario = sesion::leerSesion('nombreUsuario');
 mostrarMenu::mostrarMenuAlumno();




 if (funcionesLogin::estarLogeado()) { 
    sesion::guardaSesion('nombreUsuario',$_SESSION["nombreUsuario"]=$nombreUsuario);
 

 
 } else {
     echo("mal");
 }


//Funcion para obtener el id del candidato logueado
 $id = convocatoriaRepo::obtenerIdCandidato();
 //Funcion que pinta la tabla de las Solicitudes que ha presentado un candidato
 $convocatorias = convocatoriaRepo::tablaSolicitudes($id);

}
}


verConvocatorias::comenzar();


?>