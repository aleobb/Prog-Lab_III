<?php

    include_once "Imostrable.php";
    include_once "Localidad.php";

     class Direccion implements imostrable
    {
        private $calle;
        private $altura;
        private $Localidad;

        public function __construct($aCalle,$aAltura,$aLocalidad)
        {
            $this->calle = $aCalle;
            $this->altura = $aAltura;
            $this->Localidad = $aLocalidad;
        }
        public function setcalle($calle)
        {
            $this->calle = $calle;
        }
        public function getcalle()
        {
            return $this->calle;
        }

        public function setaltura($altura)
        {
            $this->altura = $altura;
        }
        public function getaltura()
        {
            return $this->altura;
        }

        public function setlocalidad($localidad)
        {
            $this->localidad = $localidad;
        }
        public function getlocalidad()
        {
            return $this->localidad;
        }

        public function mostrarhtml()
        {
            return (string)"$this->calle $this->altura, ".$this->Localidad->mostrarhtml();
        }
    }

    

?>