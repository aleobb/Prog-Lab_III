<?php
    include_once "Imostrable.php";

    class Alumno extends Persona
    {
        private $_legajo;
        private $_fechaIncrip;

        public function __construct($aLegajo, $aFechaInscrip, $aNombre, $aApellido, $aDni, $direccion)
        //parent::__construct($aNombre,$aApellido,$aDni,$aCalle,$aAltura,$aNombreLoc,$aCP);
        {
            parent::__construct($aNombre,$aApellido,$aDni, $direccion);
            $this->_legajo = $aLegajo;
            $this->_fechaIncrip = $aFechaInscrip;
        }
        
        public function setfechaIncrip($fechaIncrip)
        {
            $this->_fechaIncrip = $fechaIncrip;
        }

        public function getfechaIncrip()
        {
            return $this->_fechaIncrip;
        }

        public function setlegajo($legajo)
        {
            $this->_legajo = $legajo;
        }
        public function getlegajo()
        {
            return $this->_legajo;
        }

        public function mostrarhtml()
        {
            return  parent::mostrarhtml()."Fecha Inscripcion: ".$this->_fechaIncrip."<br>Legajo: ".$this->_legajo;
        }
    }

    

?>