<?php

class Facturados 
{

	private $vehiculo; 
	private $horaSalida;
	private $importe;

    public function __construct($vehiculo, $horaSalida)
    {
        $this->vehiculo = $vehiculo;
		$this->horaSalida = $horaSalida;
	}
	

	public function getVehiculo()
    {
        return $this->vehiculo;
    }
    public function setVehiculo($vehiculo)
    {
        $this->vehiculo = $vehiculo;
	}

	
    public function getHoraSalida()
    {
        return $this->horaSalida;
    }
    public function setHoraSalida($horaSalida)
    {
        $this->horaSalida = $horaSalida;
	}
	
	
    public function getImporte()
    {
        return $this->importe;
    }
    public function setImporte($importe)
    {
        $this->importe = $importe;
    }


}


?>