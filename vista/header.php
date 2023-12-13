<?php



sesion::iniciaSesion();
if(funcionesLogin::estarLogeado()){
    //Si se presiona el boton de out, cierra la sesion y te lleva al inicio
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Verifica si se presionó el botón "borrar"
    if (isset($_POST["out"])) {
       
        sesion::cierraSesion();
       header('Location: ?menu=login'); 
       
    
   }
   }

?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./estilos/estilosPrincipal.css">
         <title>Document</title>
    </head>
    <body>
    <header>
      
                 
            <div id="primer">
                   
                    <div id="deBtn">              
                        <div>
                        <a href="?menu=inicio" class="btn">Inicio</a>

                        </div>
                        
                    </div>
            </div>
            
            <div id="ter">
            <div id="quien">
                        <?php

                        $nombreUsuario = sesion::leerSesion('nombreUsuario');
                        echo "¡Bienvenido, $nombreUsuario!";

                        ?>
                        

            </div>

            <div id="cuar">
            <form method="post" action="">
                <input type="submit" class="out" value="out" id="cierre" name="out">
            </form>


            </div>

            </div>   
                  
    </header>    
    </body>
    </html>
 <?php

}else{
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./estilos/estilosPrincipal.css">
        <title>Document</title>
    </head>
    <body>
    <header>
       <div id="seg">
                <img src="./imagenes/olalla_logo.jpg" id="ola" alt="">
            </div>

            <div id="primer">
                   
                    <div id="deBtn">
                        <div>
                        <a href="?menu=login" class="btn">Login </a>

                        </div>
                        <div>
                        <a href="?menu=inicio" class="btn">Inicio</a>

                        </div>
                    </div>
            </div>

            <div id="ter">
            </div> 
            
    </header>

    </body>
    </html>
    <?php

}
?>






        




