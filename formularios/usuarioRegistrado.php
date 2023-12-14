<?php

class usuarioRegistrado{


    public static function comenzar() {
      mostrarMenu::mostrarMenuAlumno();


      $nombreUsuario = sesion::leerSesion('nombreUsuario');


if (funcionesLogin::estarLogeado()) {
    // El usuario está logueado, muestra el contenido protegido aquí.

   sesion::guardaSesion('nombreUsuario',$_SESSION["nombreUsuario"]=$nombreUsuario);


} else {
    // El usuario no está logueado, redirige a la página de inicio de recuperar contraseña.
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
<!--   <img src="./imagenes/erasmus.jpg" alt="">
 -->

  <img id="primero" src="../imagenes/bien.jpg" alt="">


</body>
</html>




