<?php

sesion::iniciaSesion();

class verConvocatorias{


    public static function comenzar() {
/* candidatosConvocatoriaRepo::obtenerCandidatosConvocatoria();
 */

 $nombreUsuario = sesion::leerSesion('nombreUsuario');



 if (funcionesLogin::estarLogeado()) {
     // El usuario está logueado, muestra el contenido protegido aquí.
    echo "¡Bienvenido  $nombreUsuario  , esto es administrar examenes ";
 
 
    sesion::guardaSesion('nombreUsuario',$_SESSION["nombreUsuario"]=$nombreUsuario);
 
 
 
 } else {
     // El usuario no está logueado, redirige a la página de inicio de recuperar contraseña.
     echo("mal");
 }

/*  convocatoriaRepo::mostrarConvocatoriasDichas();
 */



/*  $id = convocatoriaRepo::obtenerIdDestinatario();
 */
/*  echo($id);
 */


/*  $id = convocatoriaRepo::obtenerIdDestinatario();
 *//* $convocatorias = convocatoriaRepo::obtenerConvocatoriasDichas($id); */

// Muestra las convocatorias en una tabla
/* echo "<table border='1'>";
echo "<tr><th>ID</th><th>Movilidades</th>...</tr>";

foreach ($convocatorias as $fila) {
    echo "<tr>";
    echo "<td>" . $fila['id'] . "</td>";
    echo "<td>" . $fila['movilidades'] . "</td>";
    // ... Muestra otras columnas
    echo "</tr>";
}

echo "</table>"; */

$id = convocatoriaRepo::obtenerIdDestinatario();
$convocatorias = convocatoriaRepo::obtenerConvocatoriasDichas($id);

// Muestra las convocatorias en una tabla
echo "<table border='1'>";
echo "<tr><th>ID</th><th>Movilidades</th>...</tr>";

foreach ($convocatorias as $fila) {
    echo "<tr>";
    echo "<td>" . $fila['id'] . "</td>";
    echo "<td>" . $fila['movilidades'] . "</td>";
    // ... Muestra otras columnas
    echo "</tr>";
}

echo "</table>";




}
}



verConvocatorias::comenzar();



?>