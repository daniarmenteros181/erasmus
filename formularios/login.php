<?php

class login{

    public static function comenzar() {
    
    
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $nombreUsuario = $_POST["nombre"];
        $contra = $_POST["contra"];
        funcionesLogin::login($nombreUsuario,$contra);
        
    }
    }
    }
    
    login::comenzar();

?>


<!DOCTYPE html>
<html>
<head>
    <title>Inicio Sesion </title>
    <link rel="stylesheet" href="../estilos/estilosLogin.css">
</head>
<body>

    <div id="coge">
    <h1>Inicio Sesion</h1>

    <form id="miFormulario" method="post" action="">

        <label for="nombre">Usuario:</label>
        <input type="text" id="nombre" name="nombre"><br><br>

        <label for="contra">Contraseña:</label>
        <input type="text" id="contra" name="contra"><br><br>



        <input type="submit" value="Entrar" name="entrar">
        <br>

        <a href="?menu=registro">Registrarse</a>

        
    </form>
    </div>
    </body>
</html>