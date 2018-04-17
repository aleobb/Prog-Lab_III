<?php
//var_dump($_POST);

//var_dump($_FILES);

$destino="archivos/".$_FILES["archivo"]["name"];

move_uploaded_file($_FILES["archivo"]["tmp_name"],$destino);

//echo $destino;

$arrayNombre = explode('.',$_FILES["archivo"]["name"]);
var_dump($arrayNombre);
$extension=array_pop($arrayNombre);
var_dump($extension);
//hay otra forma y es con end del array

$tipoDeArchivo= pathinfo($_FILES["archivo"]["name"],PATHINFO_EXTENSION);
var_dump($tipoDeArchivo);
?>