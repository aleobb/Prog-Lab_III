<?php
include "Identidades\IMostrable.php";

//include_once "Identidades\Localidad.php";
include_once "Identidades\Persona.php";
include_once "Identidades\Direccion.php";

include_once "Identidades\Alumno.php";
include_once "Identidades\Profesor.php";


$localidad = new Localidad("1834","Temperley");
$direccion = new Direccion("j.Rosso","698",$localidad);
$persona = new Persona("ale","ben","26010377",$direccion);


//echo "hola mundo";
echo "<br>";
//echo $persona->getNombre();


echo "<br>";
echo $persona->mostrarHtml();
echo "<br>";
echo "<br>";
echo "<br>";


echo "<br><br>";



$alumno = new Alumno(24774,"2017-03-15","Calos","Perez",30955466,$direccion);
$alumno->mostrarHtml();
echo "<br><br>";
$profesor = new Profesor("Matematicas","Viernes","Kuda","dario",20955466,$direccion);
$profesor->mostrarHtml();
$profesor->setmaterias("fisica");
$profesor->setdias("jueves");
echo "<br><br>";
$profesor->Mostrarhtml();





//$nombre = "hola";

//echo $nombre;

// quilmes, avellaneda, lanus

?>