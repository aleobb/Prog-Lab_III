<?php
class Archivo{

	private static function FileKey($FileKey)
	{
		if($FileKey===NULL)
			return "archivo";
		return $FileKey;
	}

	public static function ObtenerNombre($FileKey=NULL)
	{
		$FileKey = Archivo::FileKey($FileKey); // Si el parametro no es recibido le doy un valor por defecto
		return pathinfo($_FILES[$FileKey]["name"],PATHINFO_FILENAME);
	}
	
	public static function ObtenerExtension($FileKey=NULL)
	{
		$FileKey = Archivo::FileKey($FileKey); // Si el parametro no es recibido le doy un valor por defecto
		return pathinfo($_FILES[$FileKey]["name"],PATHINFO_EXTENSION);
	}

	public static function Subir($stringNameAndPathDestino,$FileKey=NULL)
	{	
		$FileKey = Archivo::FileKey($FileKey); // Si el parametro no es recibido le doy un valor por defecto

		$exito = move_uploaded_file($_FILES[$FileKey]["tmp_name"], trim($stringNameAndPathDestino) ) ;
		
		return Archivo::Retorno($exito, "Subir");  //Retorna un array de Resultado y Mensaje de la operación
	}

	public static function Borrar($stringNameAndPath)
	{
		$exito = unlink(trim($stringNameAndPath));

		return Archivo::Retorno($exito, "Borrar");  //Retorna un array de Resultado y Mensaje de la operación
	}

	public static function Mover($stringNameAndPathOrigen, $stringNameAndPathDestino)
	{
        if( copy($stringNameAndPathOrigen, $stringNameAndPathDestino) )
			$exito = unlink($stringNameAndPathOrigen);
        else
			$exito = FALSE;
			
		return Archivo::Retorno($exito, "Mover");  //Retorna un array de Resultado y Mensaje de la operación
	}

	public static function Copiar($stringNameAndPathOrigen, $stringNameAndPathDestino)
	{
		$exito = copy($stringNameAndPathOrigen, $stringNameAndPathDestino);

		return Archivo::Retorno($exito, "Copiar");  //Retorna un array de Resultado y Mensaje de la operación
	}

	public static function changeNameAndPath($stringNameAndPath,$nameAppend,$newPath=NULL)
	{
		$aux = explode('/',$stringNameAndPath);
		$newNameAndPath[] = $aux[0];
		$aux = explode('.',$aux[1]);
		$newNameAndPath = array_merge($newNameAndPath,$aux);
		$newNameAndPath[1] = $newNameAndPath[1].$nameAppend;

		if( $newPath !== NULL )
			$newNameAndPath[0] = $newPath;
			
		return $newNameAndPath[0]."/".$newNameAndPath[1].".".$newNameAndPath[2];
	}

	private static function Retorno($exito, $operacion)
	{
		$retorno["Exito"] = $exito;
		switch ($operacion)
		{
			case "Subir":
				if($exito)
					$retorno["Mensaje"] = "Archivo subido exitosamente!!! \n";
				else
					$retorno["Mensaje"] = "Ocurrio un error al subir el archivo. No pudo guardarse. \n";
				break;
			case "Borrar":
				if($exito)
					$retorno["Mensaje"] = "Archivo eliminado exitosamente!!! \n";
				else
					$retorno["Mensaje"] = "Ocurrio un error al borrar el archivo. El archivo no pudo ser eliminado. \n";
				break;
			case "Mover":
				if($exito)
					$retorno["Mensaje"] = "Archivo movido exitosamente!!! \n";
				else
					$retorno["Mensaje"] = "Ocurrio un error al mover el archivo. El archivo no pudo ser movido. \n";
				break;
			case "Copiar":
				if($exito)
					$retorno["Mensaje"] = "Archivo copiado exitosamente!!! \n";
				else
					$retorno["Mensaje"] = "Ocurrio un error al copiar el archivo. El archivo no pudo ser copiado. \n";
				break;
		}
		return $retorno;
	}


	// http://php.net/manual/es/function.pathinfo.php :
	// pathinfo ( string $path [, int $options = PATHINFO_DIRNAME | PATHINFO_BASENAME | PATHINFO_EXTENSION | PATHINFO_FILENAME ] )
	
	/*
	public static function Validar()
	{
		//INDICO CUAL SERA EL DESTINO DEL ARCHIVO SUBIDO
		$tipoArchivo = pathinfo($_FILES["archivo"]["name"], PATHINFO_EXTENSION);

		$destino = "archivos/fotos/".$legajoAlumno."-".$nombreAlumno.".".$tipoArchivo;

		//VERIFICO EL TAMAÑO MAXIMO QUE PERMITO SUBIR
		if ($_FILES["archivo"]["size"] > 500000) {
			$retorno["Exito"] = FALSE;
			$retorno["Mensaje"] = "El archivo es demasiado grande. Verifique!!!";
			return $retorno;
		}

		//OBTIENE EL TAMAÑO DE UNA IMAGEN, SI EL ARCHIVO NO ES UNA
		//IMAGEN, RETORNA FALSE
		$esImagen = getimagesize($_FILES["archivo"]["tmp_name"]);

		if($esImagen === FALSE) {//NO ES UNA IMAGEN
			$retorno["Exito"] = FALSE;
			$retorno["Mensaje"] = "S&oacute;lo son permitidas IMAGENES.";
			return $retorno;
		}
		else {// ES UNA IMAGEN

			//SOLO PERMITO CIERTAS EXTENSIONES
			if($tipoArchivo != "jpg" && $tipoArchivo != "jpeg" && $tipoArchivo != "gif"
				&& $tipoArchivo != "png") {
				$retorno["Exito"] = FALSE;
				$retorno["Mensaje"] = "S&oacute;lo son permitidas imagenes con extensi&oacute;n JPG, JPEG, PNG o GIF.";
				return $retorno;
			}
		}
	}*/
	



}
?>