<?php
abstract class FiguraGeometrica 
{
    protected $_color;
    protected $_perimetro;
    protected $_superficie;

    function __contruct($color, $perimetro, $superficie)
    {
        $_color = "Rojo";
        $_perimetro = $perimetro;
        $_superficie = $superficie;
    }

    public function getColor(){
        return $_color;
    }

    public function setColor($color){
        $_color = $color;
    }

    function ToString(){
        return "Color: ".$_color."<br> Perimetro: ".$perimetro."<br> Superficie: ".$_superficie;
    }

    public abstract function Dibujar();

    protected abstract function CalcularDatos();
}


?>