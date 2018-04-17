<?php 
require_once "persona.php";
require_once "iMostrable.php";
class Profesor extends Persona implements iMostrable
{
    private $Materias;
    private $Dias;
    
    public function getMaterias()
    {
        return $this->Materias;
    }
    public function setMaterias($mat)
    {
        $this->Materias=$mat;
    }

    public function getDias()
    {
        return $this->Dias;
    }
    public function setDias($dia)
    {
        $this->Dias=$dia;
    }
    //constructor
    function __construct($nom,$ape,$dni,$dire,$mats,$dias)
    {
        parent::__construct($nom,$ape,$dni,$dire);
        $this->Materias=$mats;
        $this->Dias=$dias;
    }
    public function mostrarHtml()
    {
        parent::mostrarHtml();
        echo "<h3>Datos del Profesor</h3>";
        echo "--------------<br>Materias: <br>";
        foreach ($this->Materias as $value) 
        {
            echo $value."<br>";
        }
            echo "--------------<br>Dias: <br>";
        foreach ($this->Dias as $value) 
        {
            echo $value."<br>";
        }
    }
}

?>