

function suma(param1, param2, micallback){ //callback no es palabra reservada pero usamos esa para entende el codigo
    if( typeof(micallback) == "function" )
    {
        micallback( parseInt(param1)+parseInt(param2) );
    } 
    return param1+param2;
}

var res = suma(1, 2, function(parametro){ alert(resultado); } ); //function(parametro) es la declaracion de una funcion generica que recibe un parametro llamado 'resultado'
// function sin el nombre de la funcion se puede hacer así porque no necesito el puntero a la funcion ( que es el nombre de la funcion)






//Pasado de otra forma el ejemplo:
function miFuncionLoca(resultado)
{
    alert(resultado);
    //n lineas de codigo
}


function suma(param1, param2, micallback)
{
    var rdosuma = parseInt(param1)+parseInt(param2);
    if( typeof(micallback) == "function" )
    {
        micallback( "el print del callback es: " + rdosuma );
        //aca micallback es como un delegado (una forma de llamar a miFuncionLoca)
    } 
    return rdosuma;
}

var res = suma(1, 2, miFuncionLoca );
alert ("print fuera: " + suma(1,2,miFuncionLoca) );//3