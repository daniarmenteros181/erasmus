<?php

sesion::iniciaSesion();

class verConvocatorias{


    public static function comenzar() {


 $nombreUsuario = sesion::leerSesion('nombreUsuario');



 if (funcionesLogin::estarLogeado()) {
     // El usuario está logueado, muestra el contenido protegido aquí.
    echo "¡Bienvenido  $nombreUsuario  , esto es administrar examenes ";
 
 
    sesion::guardaSesion('nombreUsuario',$_SESSION["nombreUsuario"]=$nombreUsuario);
 
 
 
 } else {
     // El usuario no está logueado, redirige a la página de inicio de recuperar contraseña.
     echo("mal");
 }



 $id = convocatoriaRepo::obtenerIdCandidato();
 $convocatorias = convocatoriaRepo::obtenerConvocatoriasDichas($id);





}
}



verConvocatorias::comenzar();



?>