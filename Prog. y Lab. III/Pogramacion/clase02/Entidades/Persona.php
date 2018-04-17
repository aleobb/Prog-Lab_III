<?php

    include_once "Imostrable.php";
    include_once "Direccion.php";
    

    class Persona implements imostrable
    {
        private $nombre;
        private $apellido;
        private $dni;
        private $direccion;


        public function __construct($aNombre, $aApellido, $aDni,$aDireccion)
        {
            $this->nombre = $aNombre;
            $this->apellido = $aApellido;
            $this->dni = $aDni;
            $this->direccion = $aDireccion;
        }
        
        public function setNombre($nombre)
        {
            $this->nombre = $nombre;
        }
        public function getNombre()
        {
            return $this->nombre;
        }


        public function setapellido($apellido)
        {
            $this->apellido = $apellido;
        }
        public function getapellido()
        {
            return $this->apellido;
        }

        
        public function setdni($dni)
        {
            $this->dni = $dni;
        }
        
        public function getdni()
        {
            return $this->dni;
        }

        public function setdireccion($direccion)
        {
            $this->direccion = $direccion;
        }
        
        public function getdireccion()
        {
            return $this->direccion;
        }

        public function mostrarhtml()
        {
            return "<p>Nombre: $this->nombre $this->apellido.<br> Dni:. $this->dni.<br>Direccion:".$this->direccion->mostrarhtml()."</p>";
            
        }
    }

?>