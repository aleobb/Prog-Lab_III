<?php 
//profesor tiene un array de materias y un array de dias
require_once "persona.php";
require_once "iMostrable.php";
class Alumno extends Persona implements iMostrable
{
    private $Legajo;
    private $FechaInscripcion;
    //get y set legajo
    public function getLegajo()
    {
        return $this->Legajo;
    }
    public function setLegajo($Leg)
    {
        $this->Legajo=$Leg;
    }
    //get y set de fecha
    public function getFechaInscripcion()
    {
        return $this->FechaInscripcion;
    }
    public function setFechaInscripcion($fecha)
    {
        $this->FechaInscripcion=$fecha;
    }
    //constructor
    function __construct($nom,$ape,$dni,$dire,$leg,$fecha)
    {
        parent::__construct($nom,$ape,$dni,$dire);
        $this->Legajo=$leg;
        $this->FechaInscripcion=$fecha;
    }
    public function mostrarHtml()
    {
        parent::mostrarHtml();
        echo "<h3>Datos del Alumno: </h3>";
        echo "legajo: ".$this->Legajo."<br>"."fecha de inscripcion: ".$this->FechaInscripcion->format("d-m-Y")."<br>";
    }
}


?>