<?php 
require_once "iMostrable.php";
class Localidad implements iMostrable
{
    private $CodigoPostal;
    private $Nombre;

public function getCodP()
{
    return $this->CodigoPostal;
}
public function setCodP($cp)
{
$this->CodigoPostal=$cp;
}

public function getNombre()
{
    return $this->Nombre;
}
public function setNombre($nom)
{
$this->Nombre=$nom;
}
function __construct($cp,$nom)
{
$this->CodigoPostal=$cp;
$this->Nombre=$nom;

}
public function mostrarHtml()
{
    echo "CP: ".$this->CodigoPostal."<br>"."Localidad: ".$this->Nombre."<br>";
}
}
?>