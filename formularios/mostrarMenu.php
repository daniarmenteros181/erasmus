<?php
class mostrarMenu{

//Clase con funciones estaticas para cuando se loguea alguien, muestre un menu dependiendo de quien se haya logueado

//Menu de Administrador
     public static function mostrarMenuAdmin(){
        ?>
        <!DOCTYPE html>
    <html>
    <head>
        <title>Admin</title>
        <link rel="stylesheet" href="../estilos/estilosNav.css">

    </head>
    <body>
    
        <form id="miFormulario" method="post" action="">
        <div class="menu">
            <nav>
            <a href="?menu=administrarConvocatorias">Administrar Convocatorias</a>
            <a href="?menu=crearConvocatoria">Crear Convocatoria</a>
            </nav> 
        </div>
        </form>
    </body>
    </html>
    <?php
    } 

    
//Menu de alumno
public static function mostrarMenuAlumno(){
?>
<!DOCTYPE html>
<html>
<head>
<title>Alumno</title>
<link rel="stylesheet" href="../estilos/estilosNav.css">

</head>
<body> 
    <form id="miFormulario" method="post" action="">
        
        <nav>
        <a href="?menu=verConvocatorias">Ver Convocatorias</a>
        <a href="?menu=elegirConvocatoria">Crear Solicitd </a>
        </nav>
    </form>
</body>
</html>
<?php
}



}
