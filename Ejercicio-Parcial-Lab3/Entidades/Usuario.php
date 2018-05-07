<?php
class Usuario
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
	private $email; //id de la clase
 	private $nombre;
	private $perfil; // únicos valores admitidos: "admin", "user"
	private $edad;
	private $clave;
	  
//--------------------------------------------------------------------------------//


//--------------------------------------------------------------------------------//
//--GETTERS Y SETTERS
	public function GetEmail()
	{
		return $this->email;
	}
	public function GetNombre()
	{
		return $this->nombre;
	}
	public function GetPerfil()
	{
		return $this->perfil;
	}
	public function GetEdad()
	{
		return $this->edad;
	}
	public function GetClave()
	{
		return $this->clave;
	}


	public function SetEmail($valor)
	{
		$this->email = trim($valor,"\n\r");
	}
	public function SetNombre($valor)
	{
		$this->nombre = trim($valor,"\n\r");
	}
	public function SetPerfil($valor)
	{
		$this->perfil = trim($valor,"\n\r");
	}
	public function SetEdad($valor)
	{
		$this->edad = trim($valor,"\n\r");
	}
	public function SetClave($valor)
	{
		$this->clave = trim($valor,"\n\r");
	}

//--------------------------------------------------------------------------------//


//--------------------------------------------------------------------------------//
//--CONSTRUCTOR
	public function __construct($email=NULL, $nombre=NULL, $perfil=NULL, $edad=NULL, $clave=NULL)
	{
		if($email !== NULL && $nombre !== NULL && $perfil !== NULL && $edad !== NULL && $clave !== NULL){
			$this->email = trim($email,"\n\r");
			$this->nombre = trim($nombre,"\n\r");
			$this->perfil = trim($perfil,"\n\r"); 
			$this->edad = trim($edad,"\n\r");
			$this->clave = trim($clave,"\n\r");
		}
	}
//--------------------------------------------------------------------------------//


//--------------------------------------------------------------------------------//
//--NAME AND PATH 
/*
public function GetNameAndPathFoto($FileKey=NULL, $path=NULL, $arrayNombre=NULL)
{
	if($path===NULL)
		$path = "Fotos/";  // '\' 
	
	$nombre = $this->email."-".$this->nombre;
	if($arrayNombre!==NULL)
	{
		$nombre = $arrayNombre[0];
		for($i=1; $i<count($arrayNombre); $i++)
		{
			$nombre = $nombre."-".$arrayNombre[$i];
		}
	}
	
	$FileKey = Usuario::FileKey($FileKey); // Si el parametro no es recibido le doy un valor por defecto

	$ext = Archivo::ObtenerExtension($FileKey);

	return $path.$nombre.".".$ext;
}
//--------------------------------------------------------------------------------//
*/

//--------------------------------------------------------------------------------//
//--TO STRING	
  	public function ToString($separadorDeCampos=NULL)
	{
		$separadorDeCampos=Usuario::SeparadorDeCampos($separadorDeCampos);

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
		$arr[] = $this->nombre;
		$arr[] = $this->perfil;
		$arr[] = $this->edad;
		$arr[] = $this->clave;

		return $arr;
	}
//--------------------------------------------------------------------------------//


//--------------------------------------------------------------------------------//
//--METODOS DE CLASE
/*
	private static function FileKey($FileKey)
	{
		if($FileKey===NULL)
			return "archivo";
		return $FileKey;
	}
	*/
	public static function NewUsuario($arr)
	{
		for ($i=0;$i<count($arr);$i++){
			if($arr[$i]!==NULL)
				$arr[$i] = trim($arr[$i],"\n\r");
		}
		return new Usuario($arr[0],$arr[1],$arr[2],$arr[3],$arr[4]);
	}


	public static function StringNameAndPathArchivoBD($stringNameAndPathArchivoBD=NULL)
	{
		if($stringNameAndPathArchivoBD===NULL)
			//return "ruta/nombre.extension";  //establezco un valor por defecto
			return "Archivos/Usuarios.txt";
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
		if( !is_a($obj,"Usuario") ) { return Usuario::Retorno(FALSE, "Error"); } // Si el objeto no es del tipo que necesito salgo y retorno "Falso"

		//Verifico que no esté ingresado:
		$retorno = Usuario::BuscarPorId($obj->GetEmail(), $stringNameAndPathArchivoBD, $separadorDeCampos);
		if($retorno["Exito"] == TRUE)
		{
			$retorno["Mensaje"] = "Imposible agregar Usuario. Ya se encuentra en los registros. \n";
			return $retorno;
		}

		//$ListaDeRegistrosAux = array(); // Creo un array auxiliar
		$ListaDeRegistrosAux[0] = $obj; // y le cargo el objeto 
		// ya que la funcion ActualizarArchivoDB recibe un array

		// Subo el archivo asociado al objeto Usuario: 
/*		$retorno = Archivo::Subir($obj->GetFoto(),$FileKey);

		if ( $retorno["Exito"] )
		{*/
			$exito = Usuario::ActualizarArchivoDB($ListaDeRegistrosAux,"a",$stringNameAndPathArchivoBD,$separadorDeCampos);
			$retorno = Usuario::Retorno($exito, "Agregar", $retorno["Mensaje"] );
		//}
		return $retorno;
	}


	public static function Modificar($obj,$FileKey=NULL,$stringNameAndPathArchivoBD=NULL,$separadorDeCampos=NULL)
	{	
		//Controlo y valido parametros recibidos
		if( !is_a($obj,"Usuario") ) { return Usuario::Retorno(FALSE, "Error"); } // Si el objeto no es del tipo que necesito salgo y retorno "Falso"

		//Verifico que esté ingresado:
		$retorno = Usuario::BuscarPorId($obj->GetEmail(), $stringNameAndPathArchivoBD, $separadorDeCampos);
		if($retorno["Exito"] == FALSE) // Si no se encontró salgo y retorno "Falso".
		{
			$retorno["Mensaje"] = "Imposible modificar Usuario. No se ha podido encontrar en los registros. \n";
			return $retorno;
		}

//		$pathArchivoAborrar = ($retorno["Registros"][ $retorno["Indice"] ])->GetFoto();  //guardo el path del archivo asociado a borrar
		$ListaDeRegistrosLeidos = $retorno["Registros"];
		$ListaDeRegistrosLeidos[ $retorno["Indice"] ] = $obj; //donde estaba el registro a modificar guardo el registro ya modificado

/*		// Borro el anterior archivo asociado al objeto Usuario: 
		$retorno = Archivo::Borrar($pathArchivoAborrar);
		// Subo el nuevo archivo asociado al objeto Usuario: 
		$retorno = Archivo::Subir($obj->GetFoto(),$FileKey);
*/
		if ( $retorno["Exito"] )
		{
			$exito = Usuario::ActualizarArchivoDB($ListaDeRegistrosLeidos,"w",$stringNameAndPathArchivoBD,$separadorDeCampos);
			$retorno = Usuario::Retorno($exito, "Modificar", $retorno["Mensaje"] );
		}
		return $retorno;
	}


	public static function Eliminar($email,$stringNameAndPathArchivoBD=NULL,$separadorDeCampos=NULL)
	{
		//Controlo y valido parametros recibidos
		if($email === NULL) { return Usuario::Retorno(FALSE, "Error"); } // Si id de la búsqueda es nulo salgo y retorno "Falso"
					
		//Verifico que esté ingresado:
		$retorno = Usuario::BuscarPorId($email, $stringNameAndPathArchivoBD, $separadorDeCampos);
		if($retorno["Exito"] == FALSE) // Si no se encontró salgo y retorno "Falso".
		{
			$retorno["Mensaje"] = "Imposible eliminar Usuario. No se ha podido encontrar en los registros. \n";
			return $retorno;
		}

//		$pathArchivoAborrar = ($retorno["Registros"][ $retorno["Indice"] ])->GetFoto();  //guardo el path del archivo asociado a borrar
		
		// $ListaDeRegistrosLeidos = $retorno["Registros"];
		// array_splice($ListaDeRegistrosLeidos,$retorno["Indice"],1); //Genero otro array sin el registro a eliminar
		$ListaDeRegistrosLeidos=array();
		for($i=0; $i<count($retorno["Registros"]); $i++)
		{
			if( $i==$retorno["Indice"] )
				continue; // con esto paso a la siguiente iteración salteando la copia de dicho registro al array auxiliar
			$ListaDeRegistrosLeidos[] = $retorno["Registros"][$i]; 
		}

		//BORRO EL ARCHIVO ASOCIADO A Usuario
//		$retorno = Archivo::Borrar($pathArchivoAborrar);

		if ( $retorno["Exito"] )
		{
			$exito = Usuario::ActualizarArchivoDB($ListaDeRegistrosLeidos,"w",$stringNameAndPathArchivoBD,$separadorDeCampos);
			$retorno = Usuario::Retorno($exito, "Eliminar", $retorno["Mensaje"] );
		}
		return $retorno;		
	}


	public static function TraerTodosLosRegistros($stringNameAndPathArchivoBD=NULL,$separadorDeCampos=NULL)
	{
		//Controlo y valido parametros recibidos
		$stringNameAndPathArchivoBD = Usuario::StringNameAndPathArchivoBD($stringNameAndPathArchivoBD);
		$separadorDeCampos = Usuario::SeparadorDeCampos($separadorDeCampos);

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
				$ListaDeRegistrosLeidos[] = Usuario::NewUsuario($arrayObjetos);
			}
		}
		//CIERRO EL ARCHIVO
		fclose($archivo);
		
		return $ListaDeRegistrosLeidos;
	}


	public static function BuscarPorId($email, $stringNameAndPathArchivoBD=NULL, $separadorDeCampos=NULL)
	{
		//Controlo y valido parametros recibidos
		if($email === NULL) { return Usuario::Retorno(FALSE, "Error"); } // Si id de la búsqueda es nulo salgo y retorno "Falso"
		$ListaDeRegistrosLeidos = Usuario::TraerTodosLosRegistros($stringNameAndPathArchivoBD,$separadorDeCampos);

		$retorno["Registros"] = $ListaDeRegistrosLeidos;
		$retorno["Exito"] = FALSE;
		$retorno["Mensaje"] = "Usuario NO encontrado en los registros. ";

		for($i=0; $i<count($ListaDeRegistrosLeidos); $i++)
		{
			if( $ListaDeRegistrosLeidos[$i]->GetEmail() == $email ) //busco por id
			{  
				$retorno["Exito"] = TRUE;
				$retorno["Mensaje"] = "Usuario encontrado. \n";
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
		$stringNameAndPathArchivoBD = Usuario::StringNameAndPathArchivoBD($stringNameAndPathArchivoBD);
		$separadorDeCampos = Usuario::SeparadorDeCampos($separadorDeCampos);

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
					$msgAux = "Usuario se pudo ".$operacion." exitosamente!!! \n";
				else
					$msgAux = "ERROR. Usuario NO se pudo ".$operacion." \n";
				break;
			
			case "Leer":
				if($exito)
					$msgAux = "Archivo de Usuarios leido exitosamente!!! \n";
				else
					$msgAux = "Ocurrio un error al leer el archivo de Usuarios. No pudo ser leido. \n";
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