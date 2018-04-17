<?php
/*
    Aplicación Nº 11 (Potencias de números) 
    Mostrar por pantalla las primeras 4 potencias de los números del uno 1 al 4 (hacer una función 
    que las calcule invocando la función pow).
*/



echo "Potencias de 1:".potencias(1,4);
echo "<br>Potencias de 2:".potencias(2,4);
echo "<br>Potencias de 3:".potencias(3,4);
echo "<br>Potencias de 4:".potencias(4,4);

// Funcion que recibe un numero base y la cantidad de veces que se quiere realizar la potencia de esa base
function potencias($base, $cant)
{
    $retorno ="";

    for($i=1;$i<=$cant;$i++)
    {
        $retorno = " ".$retorno.pow($base, $i)." -";
    }

    return $retorno;

}

?>