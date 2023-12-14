<?php
 if (isset($_GET['menu'])) {
    if ($_GET['menu'] == "inicio") {
        require_once './formularios/inicio.php';

    }if ($_GET['menu'] == "login") {
        require_once './formularios/login.php';
     
    }if ($_GET['menu'] == "registro") {
        require_once './formularios/registro.php';
     
    } if ($_GET['menu'] == "crearConvocatoria") {
        require_once './formularios/convocatoria.php';
     
    } if ($_GET['menu'] == "usuario") {
        require_once './formularios/usuarioRegistrado.php';
     
    }if ($_GET['menu'] == "admin") {
        require_once './formularios/adminRegistrado.php';
     
    }if ($_GET['menu']=="administrarConvocatorias"){
        require_once './formularios/administrarConvocatorias.php';

    }   if ($_GET['menu']=="hacerExam"){
        require_once './examen/index.php';

    }   if ($_GET['menu']=="adminitrar"){
        require_once './formularios/confirmarAlumnos.php';

    }if ($_GET['menu']=="verConvocatorias"){
        require_once './formularios/verConvocatorias.php';

    }if ($_GET['menu']=="elegirConvocatoria"){
        require_once './formularios/elegirConvocatoria.php';

    }if ($_GET['menu']=="seleccionConvocatoria"){
        require_once './formularios/seleccionConvocatoria.php';

    }
    if ($_GET['menu']=="eliminacion"){
        require_once './formularios/borrarConvocatoriaClass.php';

    }
    
}else {
    // Si no se proporciona el parámetro 'menu', carga la sección de "inicio" por defecto, que es una imagen 
     require_once './formularios/inicio.php';

}

?>
