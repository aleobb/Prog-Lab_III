var a=1;
alert("El valor de la variable a es: "+a);
a = "hola mundo";
alert("Ahora el valor de la variable a es: "+a);

var a = "1";
if(a==1){//acá entra porque no compara tipo
    alert("entro");
}
else{
    alert("NO entro!");
}

if(a===1){//aca no entra porque sí compara tipo con el triple =
    alert("entro por tipo");
}
else{
    alert("NO entro por tipo");
}
/*Tipos de variables primitivos:
number
string
boolean
undefined

Tipos de variables complejos:
object
function
null (es un objeto) el tipo primitivo de null es undefined
date
math
custom
*/

