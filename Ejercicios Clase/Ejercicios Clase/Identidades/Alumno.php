<?php
//include "Persona.php";

Class Alumno extends Persona implements IMostrable
{
	public $legajo;
    public $fechaInscripcion;
    
    public function __construct($legajo, $fechaInscripcion, $nombre, $apellido, $dni, $direccion)
    {
        parent::__construct($nombre, $apellido, $dni, $direccion);
        $this->legajo = $legajo;
        $this->fechaInscripcion = $fechaInscripcion;
    }

    public function getLegajo()
    {
        return $this->$legajo;
    }
    public function setLegajo($legajo)
    {
        $this->legajo = $legajo;
    }


    public function getFechaInscripcion()
    {
        return $this->$fechaInscripcion;
    }
    public function setFechaInscripcion($fechaInscripcion)
    {
        $this->fechaInscripcion = $fechaInscripcion;
    }




}

?>