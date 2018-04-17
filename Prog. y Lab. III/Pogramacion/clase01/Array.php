<?php
include "Alumno.php";
//w3schools o php.com metodos de ordenamiento
	
	$ArrayTest = array(10,8,30);

	//print("<br></br>");
	$ArrayTest[] = 1000;
	$ArrayTest["apellido"] = "Lopez";
	$ArrayTest["Alumno"] = New Alumno();
	$ArrayTest[] = new Alumno();
	$ArrayTest[] = "A";
	$ArrayTest[33] = "Z";
	$ArrayTest[10] = "B";

	var_dump($ArrayTest);

	ksort($ArrayTest); //ordenar matrices asociativas en orden ascendente, de acuerdo con la clave
	print("<br></br>");
	print("<br></br>");
	var_dump($ArrayTest);
?>