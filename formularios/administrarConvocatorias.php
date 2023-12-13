<?php

class administrarConvocatorias{

    


    public static function comienzo(){
        mostrarMenu::mostrarMenuAdmin();



                convocatoriaRepo::mostrarConvocatoriasEnTabla(); 



   


    }




}


administrarConvocatorias::comienzo();







?>
