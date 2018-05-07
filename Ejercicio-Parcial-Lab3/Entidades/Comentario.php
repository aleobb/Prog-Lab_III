<?php
class Comentario
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
	private $email; //id de la clase
 	private $titulo; //id de la clase
	private $comentario;
	private $pathImgComent;	  
//--------------------------------------------------------------------------------//


//--------------------------------------------------------------------------------//
//--GETTERS Y SETTERS
	public function GetEmail()
	{
		return $this->email;
	}
	public function GetTitulo()
	{
		return $this->titulo;
	}
	public function GetComentario()
	{
		return $this->comentario;
	}
	public function GetPathImgComent()
	{
		return $this->pathImgComent;
	}


	public function SetEmail($valor)
	{
		$this->email = trim($valor,"\n\r");
	}
	public function SetTitulo($valor)
	{
		$this->titulo = trim($valor,"\n\r");
	}
	public function SetComentario($valor)
	{
		$this->comentario = trim($valor,"\n\r");
	}
	public function SetPathImgComent($valor)
	{
		$this->pathImgComent = trim($valor,"\n\r");
	}

//--------------------------------------------------------------------------------//


//--------------------------------------------------------------------------------//
//--CONSTRUCTOR
	public function __construct($email=NULL, $titulo=NULL, $comentario=NULL, $pathImgComent=NULL)
	{
		if($email !== NULL && $titulo !== NULL && $comentario !== NULL){
			$this->email = trim($email,"\n\r");
			$this->titulo = trim($titulo,"\n\r");
			$this->comentario = trim($comentario,"\n\r"); 
			if($pathImgComent===NULL)
				$pathImgComent=$this->GetNameAndPathImg();
			$this->pathImgComent = trim($pathImgComent,"\n\r"); // Si no hay imagen asociada guarda "Sin Imagen"
		}
	}
//--------------------------------------------------------------------------------//


//--------------------------------------------------------------------------------//
//--NAME AND PATH 
public function GetNameAndPathImg($FileKey=NULL, $path=NULL, $arrayName=NULL)
{
	if($path===NULL)
		$path = "ImagenesDeComentario/";  // '\' 
	
	$name = $this->titulo;
	if($arrayName!==NULL) //entra aca si quiero generar el name del arch por con los strings de un array.
	{
		$name = $arrayName[0]; 
		for($i=1; $i<count($arrayName); $i++)
		{
			$name = $name."-".$arrayName[$i];
		}
	}
	
	$FileKey = Comentario::FileKey($FileKey); // Si el parametro no es recibido le doy un valor por defecto

	$ext = Archivo::ObtenerExtension($FileKey);

	return $path.$name.".".$ext;
}
//--------------------------------------------------------------------------------//


//--------------------------------------------------------------------------------//
//--TO STRING	
  	public function ToString($separadorDeCampos=NULL)
	{
		$separadorDeCampos=Comentario::SeparadorDeCampos($separadorDeCampos);

		$thisArray = $this->ToArray();
		$retorno = $thisArray[0];
		for($i=1; $i<count($thisArray); $i++)
			$retorno = $retorno.$separadorDeCampos.$thisArray[$i];

	  	return $retorno."\r\n";
	}
//--------------------------------------------------------------------------------//
//--------------------------------------------------------------------------------//
//--TO ARRAY
	public function ToArray()
	{
		$arr = array();
		$arr[] = $this->email;
		$arr[] = $this->titulo;
		$arr[] = $this->comentario;
		$arr[] = $this->pathImgComent;

		return $arr;
	}
//--------------------------------------------------------------------------------//


//--------------------------------------------------------------------------------//
//--METODOS DE CLASE

	private static function FileKey($FileKey)
	{
		if($FileKey===NULL)
			return "imagen";
		return $FileKey;
	}
	
	public static function NewComentario($arr)
	{
		for ($i=0;$i<count($arr);$i++){
			if($arr[$i]!==NULL)
				$arr[$i] = trim($arr[$i],"\n\r");
		}
		return new Comentario($arr[0],$arr[1],$arr[2],$arr[3]);
	}


	public static function StringNameAndPathArchivoBD($stringNameAndPathArchivoBD=NULL)
	{
		if($stringNameAndPathArchivoBD===NULL)
			//return "ruta/titulo.extension";  //establezco un valor por defecto
			return "Archivos/Comentario.txt";
		return $stringNameAndPathArchivoBD;
	}

	public static function SeparadorDeCampos($separadorDeCampos=NULL)
	{
		if($separadorDeCampos===NULL)
			return ",";  //establezco un valor por defecto
		return $separadorDeCampos;
	}


	public static function Agregar($obj,$FileKey=NULL, $stringNameAndPathArchivoBD=NULL, $separadorDeCampos=NULL)
	{
		//Controlo y valido parametros recibidos
		if( !is_a($obj,"Comentario") ) { return Comentario::Retorno(FALSE, "Error"); } // Si el objeto no es del tipo que necesito salgo y retorno "Falso"

		$retorno["Mensaje"] = "";
		$retorno["Exito"] = TRUE;
/*		//Verifico que no esté ingresado:
		$retorno = Comentario::BuscarPorId($obj->GetEmail(), $stringNameAndPathArchivoBD, $separadorDeCampos);
		if($retorno["Exito"] == TRUE)
		{
			$retorno["Mensaje"] = "Imposible agregar Comentario. Ya se encuentra en los registros. \n";
			return $retorno;
		}
*/
		//$ListaDeRegistrosAux = array(); // Creo un array auxiliar
		$ListaDeRegistrosAux[0] = $obj; // y le cargo el objeto 
		// ya que la funcion ActualizarArchivoDB recibe un array

		// Subo el archivo asociado al objeto Comentario: 
		if( $obj->GetPathImgComent($FileKey) !== "Sin Imagen" )
 			$retorno = Archivo::Subir($obj->GetPathImgComent($FileKey),$FileKey);

		if ( $retorno["Exito"] )
		{
			$exito = Comentario::ActualizarArchivoDB($ListaDeRegistrosAux,"a",$stringNameAndPathArchivoBD,$separadorDeCampos);
			$retorno = Comentario::Retorno($exito, "Agregar", $retorno["Mensaje"] );
		}
		return $retorno;
	}


	public static function Modificar($obj,$FileKey=NULL,$stringNameAndPathArchivoBD=NULL,$separadorDeCampos=NULL)
	{	
		//Controlo y valido parametros recibidos
		if( !is_a($obj,"Comentario") ) { return Comentario::Retorno(FALSE, "Error"); } // Si el objeto no es del tipo que necesito salgo y retorno "Falso"

		//Verifico que esté ingresado:
		$retorno = Comentario::BuscarPorId($obj->GetEmail(), $stringNameAndPathArchivoBD, $separadorDeCampos);
		if($retorno["Exito"] == FALSE) // Si no se encontró salgo y retorno "Falso".
		{
			$retorno["Mensaje"] = "Imposible modificar Comentario. No se ha podido encontrar en los registros. \n";
			return $retorno;
		}

		$pathArchivoAborrar = ($retorno["Registros"][ $retorno["Indice"] ])->GetImg();  //guardo el path del archivo asociado a borrar
		$ListaDeRegistrosLeidos = $retorno["Registros"];
		$ListaDeRegistrosLeidos[ $retorno["Indice"] ] = $obj; //donde estaba el registro a modificar guardo el registro ya modificado

		// Borro el anterior archivo asociado al objeto Comentario: 
		$retorno = Archivo::Borrar($pathArchivoAborrar);
		// Subo el nuevo archivo asociado al objeto Comentario: 
		$retorno = Archivo::Subir($obj->GetImg(),$FileKey);

		if ( $retorno["Exito"] )
		{
			$exito = Comentario::ActualizarArchivoDB($ListaDeRegistrosLeidos,"w",$stringNameAndPathArchivoBD,$separadorDeCampos);
			$retorno = Comentario::Retorno($exito, "Modificar", $retorno["Mensaje"] );
		}
		return $retorno;
	}


	public static function Eliminar($email,$stringNameAndPathArchivoBD=NULL,$separadorDeCampos=NULL)
	{
		//Controlo y valido parametros recibidos
		if($email === NULL) { return Comentario::Retorno(FALSE, "Error"); } // Si id de la búsqueda es nulo salgo y retorno "Falso"
					
		//Verifico que esté ingresado:
		$retorno = Comentario::BuscarPorId($email, $stringNameAndPathArchivoBD, $separadorDeCampos);

		if($retorno["Exito"] == FALSE) // Si no se encontró salgo y retorno "Falso".
		{
			$retorno["Mensaje"] = "Imposible eliminar Comentario. No se ha podido encontrar en los registros. \n";
			return $retorno;
		}
		
		$pathArchivoAborrar = ($retorno["Registros"][ $retorno["Indice"] ])->GetPathImgComent();  //guardo el path del archivo asociado a borrar 

		// $ListaDeRegistrosLeidos = $retorno["Registros"];
		// array_splice($ListaDeRegistrosLeidos,$retorno["Indice"],1); //Genero otro array sin el registro a eliminar
		$ListaDeRegistrosLeidos=array();
		for($i=0; $i<count($retorno["Registros"]); $i++)
		{
			if( $i==$retorno["Indice"] )
				continue; // con esto paso a la siguiente iteración salteando la copia de dicho registro al array auxiliar
			$ListaDeRegistrosLeidos[] = $retorno["Registros"][$i]; 
		}

		//BORRO EL ARCHIVO ASOCIADO A Comentario
//		$retorno = Archivo::Borrar($pathArchivoAborrar);

		$nameAndPathDestino = Archivo::changeNameAndPath($pathArchivoAborrar,"-".date("Y-m-d"),"backUpFotos");
		echo $nameAndPathDestino."\n";
		$retorno = Archivo::Mover($pathArchivoAborrar, $nameAndPathDestino );

		if ( $retorno["Exito"] )
		{
			$exito = Comentario::ActualizarArchivoDB($ListaDeRegistrosLeidos,"w",$stringNameAndPathArchivoBD,$separadorDeCampos);
			$retorno = Comentario::Retorno($exito, "Eliminar", $retorno["Mensaje"] );
		}
		return $retorno;		
	}


	public static function TraerTodosLosRegistros($stringNameAndPathArchivoBD=NULL,$separadorDeCampos=NULL)
	{
		//Controlo y valido parametros recibidos
		$stringNameAndPathArchivoBD = Comentario::StringNameAndPathArchivoBD($stringNameAndPathArchivoBD);
		$separadorDeCampos = Comentario::SeparadorDeCampos($separadorDeCampos);

        $ListaDeRegistrosLeidos = array();

        //Leo todos los registros del archivo
		$archivo = fopen($stringNameAndPathArchivoBD, "r");
		
		while(!feof($archivo))
		{
			$archAux = fgets($archivo);
			$arrayObjetos = explode($separadorDeCampos, $archAux); 
			//http://www.w3schools.com/php/func_string_explode.asp
			$arrayObjetos[0] = trim($arrayObjetos[0]);
			if($arrayObjetos[0] != ""){
				$ListaDeRegistrosLeidos[] = Comentario::NewComentario($arrayObjetos);
			}
		}
		//CIERRO EL ARCHIVO
		fclose($archivo);
		
		return $ListaDeRegistrosLeidos;
	}


	public static function BuscarPorId($email, $stringNameAndPathArchivoBD=NULL, $separadorDeCampos=NULL)
	{
		//Controlo y valido parametros recibidos
		if($email === NULL) { return Comentario::Retorno(FALSE, "Error"); } // Si id de la búsqueda es nulo salgo y retorno "Falso"
		$ListaDeRegistrosLeidos = Comentario::TraerTodosLosRegistros($stringNameAndPathArchivoBD,$separadorDeCampos);

		$retorno["Registros"] = $ListaDeRegistrosLeidos;
		$retorno["Exito"] = FALSE;
		$retorno["Mensaje"] = "Comentario NO encontrado en los registros. ";

		for($i=0; $i<count($ListaDeRegistrosLeidos); $i++)
		{
			if( $ListaDeRegistrosLeidos[$i]->GetEmail() == $email ) //busco por id
			{  
				$retorno["Exito"] = TRUE;
				$retorno["Mensaje"] = "Comentario encontrado. \n";
				$retorno["Indice"] = $i;
				$retorno["Objeto"] = $ListaDeRegistrosLeidos[$i];
				break;
			}
			$ListaDeRegistrosAux[$i] = $ListaDeRegistrosLeidos[$i];
		}

		return $retorno;
	}


	public static function ActualizarArchivoDB($ListaDeRegistros,$modoAperturaArchivo,$stringNameAndPathArchivoBD=NULL,$separadorDeCampos=NULL)
	{
		$retorno = TRUE;

		//Controlo y valido parametros recibidos
		if( $ListaDeRegistros===NULL || $modoAperturaArchivo===NULL )
			return FALSE;
		$stringNameAndPathArchivoBD = Comentario::StringNameAndPathArchivoBD($stringNameAndPathArchivoBD);
		$separadorDeCampos = Comentario::SeparadorDeCampos($separadorDeCampos);

		//ABRO EL ARCHIVO
		$ar = fopen($stringNameAndPathArchivoBD, $modoAperturaArchivo);

		//ESCRIBO EN EL ARCHIVO
		foreach($ListaDeRegistros AS $item)
		{
			$cant = fwrite($ar, $item->ToString($separadorDeCampos) );
			
			if($cant < 1) //Verifico que se haya guardado el registro. Si no lo pudo hacer salgo del foreach y devuelo false (no se pudo realizar correctamente la actualización del archivo)
			{
				$retorno = FALSE;
				break;
			}
		}
		
		//CIERRO EL ARCHIVO
		fclose($ar);

		return $retorno;
	}

	public static function GetComentariosFiltrados($paramDeBusqueda)
	{
		$ListaDeRegistrosLeidos = Comentario::TraerTodosLosRegistros();

		$retorno = "";
		foreach($ListaDeRegistrosLeidos as $item)
		{
			$param1 = ( $paramDeBusqueda["email"] === NULL || $item->GetEmail() == $paramDeBusqueda["email"] );
			$param2 = ( $paramDeBusqueda["titulo"] === NULL || $item->GetTitulo() == $paramDeBusqueda["titulo"] );
			if( $param1 && $param2 )
				$retorno = $retorno.$item->ToString();
		}
		if($retorno == "")
			$retorno = "No existen comentarios que cumpla con los parametros de busqueda.";
		return $retorno;
	}

	private static function Retorno($exito, $operacion, $msgAppend=NULL)
	{
		$retorno["Exito"] = $exito;
		if( $msgAppend === NULL ) { $msgAppend=""; }

		switch ($operacion)
		{
			case "Error":
					$msgAux = "Ha ocurrido un error. La informacion es incompleta, erronea y/o existe un error de sintaxis.";
				break;

			case "Agregar":
			case "Eliminar":
			case "Modificar":
			case "Copiar":
				if($exito)
					$msgAux = "Comentario se pudo ".$operacion." exitosamente!!! \n";
				else
					$msgAux = "ERROR. Comentario NO se pudo ".$operacion." \n";
				break;
			
			case "Leer":
				if($exito)
					$msgAux = "Archivo de Comentarios leido exitosamente!!! \n";
				else
					$msgAux = "Ocurrio un error al leer el archivo de Comentarios. No pudo ser leido. \n";
				break;

			default:
				$msgAux ="Error. Caso no contemplado";
				break;
		}
		$retorno["Mensaje"] = $msgAppend.$msgAux;

		return $retorno;
	}




//--------------------------------------------------------------------------------//

}