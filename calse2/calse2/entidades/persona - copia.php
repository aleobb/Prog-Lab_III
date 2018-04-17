<?php 
require_once "iMostrable.php";
 class Persona implements iMostrable
{
    private $Nombre;
    private $Apellido;
    private $DNI;
    private $Direccion;

    public function getNombre()
    {
    return $this->Nombre;
    }
    public function setNombre($valor)
    {
        $this->Nombre=$valor;
    }
    public function getApellido()
    {
    return $this->Apellido;
    }
    public function setApellido($valor)
    {
        $this->Apellido=$valor;
    }
    public function getDNI()
    {
    return $this->DNI;
    }
    public function setDNI($valor)
    {
        $this->DNI=$valor;
    }

    public function getDireccion()
    {
    return $this->Direccion;
    }
    public function setDireccion($valor)
    {
        $this->Direccion=$valor;
    }
    function __construct($nom,$ape,$dni,$dir)
    {
        $this->Nombre=$nom;
        $this->Apellido=$ape;
        $this->DNI=$dni;
        $this->Direccion=$dir;
    }
    public function mostrarHtml()
    {
        echo "<h1>Persona</h1>";
        echo "<p>Nombre: $this->Nombre<br>Apellido: $this->Apellido<br>DNI: $this->DNI<br></p>";
        echo $this->Direccion->mostrarHtml();
    }
}
?>