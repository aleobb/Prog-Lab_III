<?php
require "Alumno.php"; // algo que necesita si o si para funcionar. Si el nombre esta mal o el archivo no existe tira fatal error
require_once "Alumno.php"; // Si ya existe no lo usa

for($i=0;$i<20;$i++)
	{ 
		include "Repetidor.php";
	}
//include"Alumno.php"; // incluyo algo que voy a utilizar

/*
	$nombre = " Jose";
	echo "Hola Mundo php $nombre";
	$sueldo = 10.333;
	printf("<br>sueldo : %f</br>", $sueldo);
	print("nombre: $nombre");
*/

/*
	$miarray = array(1,2,3); // Creador de arrays
	var_dump($miarray);
	
	$segundoArray[33] = "Hola";
	$segundoArray["nombre"] = "Maria";
	
	var_dump($segundoArray);

	$tercerArray = array("Edad"=> 19,21,54); // Creador de arrays
	var_dump($tercerArray);
*/

	

	$elAlumno = new Alumno();

	$elAlumno->nombre = "Pepe";
	$elAlumno->legajo = 666;
	$elAlumno->mail = "No Tengo";
	

	$otro = $elAlumno;
	$otro->nombre = "Juan";

	var_dump($elAlumno);
?>