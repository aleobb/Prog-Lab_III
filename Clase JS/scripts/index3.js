// Funciones:
// palabra reservada function

function miFuncion(param1, param2){ //no empieza con mayuscula porque no es un metodo como en C#
// los parametros se reciben sin detallar el tipo:
// no se hace por ej. string param1, string param2

//retorno palabra reservada return
    return param1+param2;
}

//invocacion de la funcion:
var resultado = miFuncion(1,2);

alert(resultado);//3

alert(miFuncion); //muestra el contenido del puntero...?

var b = miFuncion;

alert(typeof(b));
alert(b(1,2));



