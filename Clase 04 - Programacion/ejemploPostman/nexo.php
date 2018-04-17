<?php

/* $ListaDeAlumnosLeidos = array();
var_dump($ListaDeAlumnosLeidos); */

require_once ("Entidades/alumno.php");
require_once ("Entidades/archivo.php");

//var_dump($_POST);
//var_dump($_FILES);

$queHago = isset($_POST['queHago']) ? $_POST['queHago'] : NULL;

//$nombreAlumno = $_POST['nombre'];
//$legajoAlumno = $_POST['legajo'];

//var_dump($queHago);

/* *********** siempre le pegamos a nexo y por postman// cambia el metodo y los paramtros********** **/

switch($queHago){
	
	case "Subir":

		$respuestaDeSubir = Archivo::Subir($_POST['legajo'],$_POST['nombre']);

		if(!$respuestaDeSubir["Exito"]){
			echo "error " .$respuestaDeSubir["Mensaje"];
			break;
		}
		$archivo = $respuestaDeSubir["PathTemporal"];
		echo "Bien " ;
		
		$legajo = isset($_POST['legajo']) ? $_POST['legajo'] : NULL;
		$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : NULL;
		//$archivo = $res["PathTemporal"];

		$p = new Alumno($legajo, $nombre, $archivo);
		
	//	$p = new Alumno(666, "Jamon del diablo",$archivo );

		if(!Alumno::Guardar($p)){
			echo "Error al generar archivo";
			break;
		}
	

	
		
		break;
		
	case "eliminar":
		$legajo = isset($_POST['legajo']) ? $_POST['legajo'] : NULL;
	
		if(!Alumno::Eliminar($legajo)){
			$mensaje = "Lamentablemente ocurrio un error y no se pudo escribir en el archivo.";
		}
		else{
			$mensaje = "El archivo fue escrito correctamente. PRODUCTO eliminado CORRECTAMENTE!!!";
		}
	
		echo $mensaje;
		
		break;
		
	default:
		echo ":(";
}
?>