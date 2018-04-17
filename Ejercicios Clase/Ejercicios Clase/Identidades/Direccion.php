<?php

include_once "Identidades\Localidad.php";

class Direccion implements IMostrable
{
	private $calle;
	private $altura;
	private $localidad;

    public function __construct($calle, $altura, $localidad)
    {
        $this->calle = $calle;
        $this->altura = $altura;
        $this->localidad = $localidad;
    }

    /*  No me sirve hacer esto porque en php no te podés asegurar de recibir una localidad ni de nada que se recibe
    public function __construct($calle, $altura, $codigoPostal, $nombreLocalidad)
    {
        $this->calle = $calle;
        $this->altura = $altura;
        $this->localidad = new Localidad($codigoPostal, $nombreLocalidad);
    }*/

    public function getCalle()
    {
        return $this->$calle;
    }
    public function setCalle($calle)
    {
        $this->calle = $calle;
    }

    public function getAltura()
    {
        return $this->$altura;
    }
    public function setAltura($altura)
    {
        $this->nombre = $altura;
    }

    public function getLocalidad()
    {
        return $this->$localidad;
    }
    public function setLocalidad($localidad)
    {
        $this->localidad = $localidad;
    }

    public function mostrarHtml()
    {
        return "Calle: ".$this->calle."<br>Altura: ".$this->altura."<br>".$this->localidad->mostrarHtml()."<br>";
    }

}

?>