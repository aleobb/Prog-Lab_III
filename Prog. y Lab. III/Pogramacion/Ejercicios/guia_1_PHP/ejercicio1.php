<?php

/*
    Aplicacion 1: Confeccionar  un programa que sume todos los numeros enteros desde 1 mientras la suma no supere a 1000.
    Mostrar los numeros sumados y al finalizar y al finalizar el proceso indicar cuantos numeros se sumaron.
*/

    $cont = 0;
    $resultado = 0;

    while(($resultado + $cont) < 1000)
    {
        $resultado = $resultado + $cont;
        Echo "$cont - ";
        $cont++;
    }

    echo "Resultado es $resultado y fueron sumados $cont numeros";

?>