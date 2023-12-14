<?php

class elegirConvocatoria {
    public static function comenzar() {
        mostrarMenu::mostrarMenuAlumno();

        // Obtener el cod_grupo
        $cod_grupo = convocatoriaRepo::obtenerCodGrupo();


        if ($cod_grupo !== null) {
            // Mostrar convocatorias para el destinatario en la tabla
            convocatoriaRepo::mostrarConvocatoriasPorDestinatarioEnTabla($cod_grupo);
        } else {
            // Manejar el caso donde no se encuentra el cod_grupo
            echo "Error: No se encontró el cod_grupo.";
        }
    }
}

elegirConvocatoria::comenzar();




?>