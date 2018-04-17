<?php

//include "IMostrable.php";

Class Localidad implements IMostrable

{
	public $codigoPostal;
    public $nombre;
    
    public function __construct($codigoPostal, $nombre)
    {
        $this->codigoPostal = $codigoPostal;
        $this->nombre = $nombre;
    }

    public function getCodigoPostal()
    {
        return $this->codigoPostal;
    }
    public function setCodigoPostal($codigoPostal)
    {
        $this->codigoPostal = $codigoPostal;
    }


    public function getNombre()
    {
        return $this->nombre;
    }
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function mostrarHtml()
    {
        return "Codigo Postal: ".$this->getCodigoPostal()."<br>Nombre Localidad: ".$this->getNombre()."<br>";
    }
    


}

?>