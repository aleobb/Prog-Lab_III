<?php
    include_once "Imostrable.php";

    class Profesor extends Persona
    {
        private $materias;
        private $dias;

        public function __construct($aMaterias, $aDias, $aNombre, $aApellido, $aDni)
        {
            parent::__construct($aNombre,$aApellido,$aDni);
            $this->materias = $aMaterias;
            $this->dias = $aDias;
        }


        public function setdias($dias)
        {
            $this->dias = $dias;
        }

        public function getdias()
        {
            return $this->dias;
        }

        public function setmaterias($materias)
        {
            $this->materias = $materias;
        }
        public function getmaterias()
        {
            return $this->materias;
        }

        public function mostrarhtml()
        {
            return "Dias ".$this->dias.", Materias: ".$this->materias;
        }
    }

    

?>