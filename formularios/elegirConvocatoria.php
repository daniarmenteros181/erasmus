<?php


class elegirConvocatoria{


    public static function comenzar() {
        mostrarMenu::mostrarMenuAlumno();



 convocatoriaRepo::mostrarTodasConvocatoriasEnTabla();


}
}

elegirConvocatoria::comenzar();



?>