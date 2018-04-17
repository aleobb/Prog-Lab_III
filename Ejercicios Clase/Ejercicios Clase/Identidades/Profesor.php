<?php

//include "Profesor.php";

Class Profesor extends Persona implements IMostrable

{
    public $materias;
    
    public $dias;
    
    public function __construct($materias, $dias, $nombre, $apellido, $dni, $direccion)
    {
        parent::__construct($nombre, $apellido, $dni, $direccion);
        $this->materias = $materias;
        $this->dias = $dias;
    }

    public function getMaterias()
    {
        return $this->$materias;
    }
    public function setMaterias($materias)
    {
        $this->materias = $materias;
    }


    public function getDias()
    {
        return $this->$dias;
    }
    public function setDias($dias)
    {
        $this->dias = $dias;
    }

    public function mostrarHtml()
    {
        return "Nombre: ".$this->nombre."<br>Apellido: ".$this->apellido."<br>Dni: ".$this->dni."<br>Direccion: ".$this->direccion->mostrarHtml()."<br>";
    }



}

?>