<?php

class funcionesLogin{

#esta logueado(le pregunta a sesion si tiene clave que se llama users)
    public static function estarLogeado(){

    if (isset($_SESSION['nombreUsuario'])) {
        return true;
    } else {
        return false;
    }
    

}

// Función para verificar el inicio de sesión en la base de datos
 public static function existeUsuario($nombreUsuario, $contra) {
    
    // Conectar a la base de datos utilizando la clase db
    $conexion = db::entrar();

    // Consultar la base de datos para encontrar un usuario con el nombre proporcionado
    $stmt = $conexion->prepare("SELECT * FROM candidatos WHERE nombre = ? AND contrasenia = ?");

    $stmt->bindParam(1, $nombreUsuario);
    $stmt->bindParam(2, $contra);
    $stmt->execute();

    $candidatos = $stmt->fetch(PDO::FETCH_ASSOC);



    // Verificar si se encontró un usuario con ese nombre y contraseña
    if ($candidatos) {
         $rol = $candidatos['rol'];

        return $rol;
    }

    return false;
}

public static function login($nombreUsuario, $contra) {

    if (isset($_POST["entrar"])) {
        $rol = funcionesLogin::existeUsuario($nombreUsuario, $contra);

        if ($rol) {
            sesion::guardaSesion('nombreUsuario', $nombreUsuario);


            // Redirigir al usuario según su rol
            if ($rol === 'usuario') {

                    header('Location:?menu=usuario');

            }  elseif ($rol === 'admin') {
               header('Location:?menu=admin');
            } else {
                header('Location:?menu=espera');
            }
        } else {
            // Las credenciales son incorrectas, mostrar un mensaje de error
            echo "Acceso denegado. Nombre o contraseña incorrectos.";
        }
    }
}

    public static function crearUsuario(){

    return new Usuario($nombreUsuario,$contra,$rol);


}



}



?>