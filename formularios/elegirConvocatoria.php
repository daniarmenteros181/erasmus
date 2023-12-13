<?php


class elegirConvocatoria{


    public static function comenzar() {
        mostrarMenu::mostrarMenuAlumno();



 convocatoriaRepo::mostrarConvocatoriasEnTablaSolo();


}
}

elegirConvocatoria::comenzar();



?>