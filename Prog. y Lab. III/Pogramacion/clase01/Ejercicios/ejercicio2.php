<?php

/*
    Aplicación Nº 2 (Mostrar fecha y estación) 
    Obtenga la fecha actual del servidor (función date) y luego imprímala dentro de la página con 
    distintos formatos (seleccione los formatos que más le guste). Además indicar que estación del 
    año es. Utilizar una estructura selectiva múltiple.
 */   

    $date = date('H:i:s, d/m/Y', time());

    echo "$date";
    
?>