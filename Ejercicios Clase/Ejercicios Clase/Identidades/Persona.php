<?php

include_once "Identidades\Direccion.php";

Class Persona implements IMostrable

{
    private $nombre;
    private $apellido;
	private $dni;
	private $direccion;

    public function __construct($nombre, $apellido, $dni, $direccion)
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->dni = $dni;
        $this->direccion = $direccion;
    }


    public function getNombre()
    {
        return $this->nombre;
    }
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }


    public function getApellido()
    {
        return $this->apellido;
    }
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    public function getDni()
    {
        return $this->dni;
    }
    public function setDni($dni)
    {
        $this->dni = $dni;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }

    public function mostrarHtml()
    {
        return "Nombre: ".$this->nombre."<br>Apellido: ".$this->apellido."<br>Dni: ".$this->dni."<br>Direccion: ".$this->direccion->mostrarHtml()."<br>";
    }





    
    
}

?>