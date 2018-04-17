<?php

include "FiguraGeometrica.php";

class Rectangulo extends FiguraGeometrica
{
    
    private $_ladoUno;
    private $_ladoDos;

    function __construct($l1, $l2)
    {
        $this->_ladoUno = $l1;
        $this->_ladoDos = $l2;
        $this->CalcularDatos();
    }

    public function Dibujar(){
        echo "Triangulito de: " . $this->_ladoUno . " x " . $this->_ladoDos;
        echo "Superficie: " . $this->_superficie . " /// Perimetro: " . $this->_perimetro;
    }

    public function CalcularDatos(){
        $this->_superficie = $this->_ladoUno * $this->_ladoDos;
        $this->_perimetro = ($this->_ladoDos * 2) + ($this->_ladoUno *2);
    }

    public function ToString(){
        return $this->Dibujar();
    }

    
}


?>