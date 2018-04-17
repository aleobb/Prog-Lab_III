
<?php

include_once "Entidades/Persona.php";
include_once "Entidades/Localidad.php";
include_once "Entidades/Direccion.php";
include_once "Entidades/Alumno.php";
include_once "Entidades/Profesor.php";

$localidad1 = new Localidad(1832,"Lomas de Zamora");
$localidad2 = new Localidad(1421, "Avellaneda");
$localidad3 = new Localidad(3212, "Quilmes");

$direccion1 = new Direccion("Av. Mire",1022,$localidad2);
$direccion2 = new Direccion("Laureano Oliver",956, $localidad1);
$direccion3 = new Direccion("Av. Corrientes", 468 , $localidad3);

$alumno1 = new Alumno(1451,"21/10/2020","pepe","perez","38304484",$direccion1);
$alumno2 = new Alumno(1452, "08/12/2019","Juan","Aguirre", 42152232, $direccion2);
$alumno3 = new Alumno(1453, "15/05/2021", "Hernan", "Abalsamo",35212468,$direccion3);

$array = Array($alumno1, $alumno2, $alumno3);

foreach($array as $alumno)
{
    var_dump($alumno->mostrarhtml());
    echo "<br><br>-------------------------------<br><br>";
}


?>
