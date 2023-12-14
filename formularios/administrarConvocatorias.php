<?php

class administrarConvocatorias{

    public static function comienzo(){
        mostrarMenu::mostrarMenuAdmin();

        convocatoriaRepo::mostrarConvocatoriasCrud(); 


    }

}


administrarConvocatorias::comienzo();


?>
