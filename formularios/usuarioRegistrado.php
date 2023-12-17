<?php

class usuarioRegistrado{


    public static function comenzar() {
      mostrarMenu::mostrarMenuAlumno();


      $nombreUsuario = sesion::leerSesion('nombreUsuario');


if (funcionesLogin::estarLogeado()) {

   sesion::guardaSesion('nombreUsuario',$_SESSION["nombreUsuario"]=$nombreUsuario);


} else {
    echo("mal");
}


}
}

usuarioRegistrado::comenzar();


?>
<?php

?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menú de Convocatorias</title>
   <link rel="stylesheet" href="../estilos/user.css">
 
</head>
<body>


  <img id="primero" src="../imagenes/logue.png" alt="">


</body>
</html>




