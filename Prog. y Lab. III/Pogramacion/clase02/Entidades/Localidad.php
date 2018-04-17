<?php
    include_once "Imostrable.php";

    class Localidad implements imostrable
    {
        private $codigoPostal;
        private $nombre;

        public function __construct($aCP,$aNombre)
        {
            $this->codigoPostal = $aCP;
            $this->nombre = $aNombre;
        }


        public function setnombre($nombre)
        {
            $this->nombre = $nombre;
        }

        public function getnombre()
        {
            return $this->nombre;
        }

        public function setcodigoPostal($codigoPostal)
        {
            $this->codigoPostal = $codigoPostal;
        }
        public function getcodigoPostal()
        {
            return $this->codigoPostal;
        }

        public function mostrarhtml()
        {
            return $this->nombre." , CP: ".$this->codigoPostal;
        }
    }

    

?>