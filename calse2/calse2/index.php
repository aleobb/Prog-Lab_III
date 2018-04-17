<?php 
include_once "entidades/direccion.php";
include_once "entidades/persona.php";
include_once "entidades/localidad.php";
include_once "entidades/Alumno.php";
include_once "entidades/Profesor.php";
$Avellenda=new Localidad(1823,"Avellaneda");
$Quilmes= new Localidad(2032,"Quilmes");
$Lanus=new Localidad(3050,"Lanus");
//direciones
$direccion1=new direccion("Ferre","812",$Avellenda);
$direccion2=new direccion("Ferre","850",$Avellenda);
$direccion3=new direccion("Belgrano","1093",$Avellenda);
$direccion4=new direccion("Larralde","100",$Quilmes);
$direccion5=new direccion("juan Domingo Peron","88",$Lanus);
$direccion6=new direccion("Ferre","900",$Lanus);

$fec1= new datetime("22 march 2013");
$fec2=new datetime("12 april 2014");
$fec3=new datetime("30 july 2016");
$dias1=array("jueves","viernes");
$materias1=array("matematica","JS");
$dias2=array("lunes","martes","miercoles");
$materias2=array("C#","Ingles","Laboratorio 2");
$Alumno1=new Alumno("Leon","casal",323232,$direccion1,22323,$fec1);
$Profesor1= new Profesor("Octavio","villegas",201223,$direccion2,$materias1,$dias2);
$Alumno2=new Alumno("Nicolas","valdez",402323223,$direccion3,091923,$fec2);
$Profesor2=new Profesor("Emilia","Ifran",23232332,$direccion4,$materias2,$dias1);
$Alumno3=new Alumno("chicha","Franes",92823923,$direccion5,92034,$fec3);
$Profesor3=new Profesor("Ricardo","fort",2929020,$direccion6,$materias1,$dias1);
$Escuela=array($Alumno1,$Profesor1,$Alumno2,$Profesor2,$Alumno3,$Profesor3);

foreach ($Escuela as $value) 
{
   $value->mostrarHtml();
}
//$miAlumno->mostrarHtml();

/* $miPersona=new Persona("Leon","Ifran",38268,$midireccion);
$miPersona->mostrarHtml();
$misdias=array("jueves","viernes");
$misMaterias=array("matematica","JS");
$fec= new datetime("22 march");
$miAlumno=new Alumno("Leon","casal",323232,$midireccion,22323,$fec);
$miAlumno->mostrarHtml();
$miProfesor=new Profesor("Leon","casal",323232,$midireccion,$misMaterias,$misdias);
$miProfesor->mostrarHtml(); */
//persona pasa a ser abstracta
//creamos 6 objetos de tipo alumno o profesor intercalados
//localidad: quilmes, avellaneda, lanus
//agregarlo a una lista o array y despues llamar con un foreach a mostrar html
?>