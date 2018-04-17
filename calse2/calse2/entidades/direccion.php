<?php 
require_once "iMostrable.php";
class Direccion implements iMostrable
{
    private $Calle;
    private $Altura;
    private $Localidad;

public function getCalle()
{
return $this->Calle;
}
public function setCalle($Calle)
{
    $this->Calle=$Calle;
}
public function getAltura()
{
return $this->Altura;
}
public function setAltura($valor)
{
    $this->Altura=$valor;
}
public function getLocalidad()
{
return $this->Localidad;
}
public function setLocalidad($valor)
{
    $this->Localidad=$valor;
}
function __construct($cal,$alt,$Loc)
{
$this->Calle=$cal;
$this->Altura=$alt;
$this->Localidad=$Loc;
}

public function mostrarHtml()
{   echo "Direccion: "."<br>";
    echo "Calle: ".$this->Calle."  ".$this->Altura."<br>";
    $this->Localidad->mostrarHtml();
    
}
}
?>