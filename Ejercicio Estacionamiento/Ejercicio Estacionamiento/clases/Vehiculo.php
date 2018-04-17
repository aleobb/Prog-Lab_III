<?php

class Vehiculo
{

	private $patente; 
	private $horaIngreso;

    public function __construct($patente, $horaIngreso)
    {
        $this->patente = $patente;
        $this->horaIngreso = $horaIngreso;
	}
	

	public function getPatente()
    {
        return $this->patente;
    }
    public function setPatente($patente)
    {
        $this->patente = $patente;
	}
	
	
    public function getHoraIngreso()
    {
        return $this->horaIngreso;
    }
    public function setHoraIngreso($horaIngreso)
    {
        $this->horaIngreso = $horaIngreso;
    }


	public function estacionar()
	{
		//guarda 1 por linea
		return true; //false

	}

	public function sacar($patente)
	{
		return $this->$importe;
	}


	public static function traerTodos()
	{
		$archivo=fopen("archivos/estacionados.txt", "r");
		while(!feof($archivo))
		{
			fgets($archivo);
		}
		fclose($ar);



		return $this->getPatente();//trae un listado de vehiculos estacionados
	}

	public static guardar($listado)
	{
		$archivo=fopen("archivos/estacionados.txt", "a+");//escribe y mantiene la informacion existente		
		//$ahora=date("Y-m-d H:i:s"); 
		//$renglon=$patente."=>".$ahora."\n";
		fwrite($archivo, $listado); 		 
		fclose($archivo);
	}

	//no existe el metodo estacionar

	//metodo estacionar lo cambiamos por el metodo guardar


}

}


?>