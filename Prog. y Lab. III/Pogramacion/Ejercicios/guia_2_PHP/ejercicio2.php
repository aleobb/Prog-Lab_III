<?php

/*
    Aplicación Nº 12 (Invertir palabra) 
    Realizar el desarrollo de una función que reciba un Array de caracteres y que invierta el orden     
    de las letras del Array. 
    Ejemplo: Se recibe la palabra “HOLA” y luego queda “ALOH”.
*/

    $array = "HOLA";
    $arrayInv = "string invertido: ";
    $count = strlen($array);
    
    for($i=$count ;$i>-1; $i--)
    {
        $arrayInv = $arrayInv.$array[$i];
    }

    echo $arrayInv;
?>