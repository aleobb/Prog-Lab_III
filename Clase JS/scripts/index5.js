var nums = [3,2,5,6,9,0]; //asi se declaran arrays y me doy cuenta que es un array por los corchetes

var nums = [3,2,"5",6,9,0]; // es un array de distintos tipos de datos

var nums = [3,2,"5",6,null,function funcionHola(param1,param2){ return arguments[0]+arguments[1]; }]; //arguments es palabra reservada y es un array de todos los parametros que llegaron
var nums = [3,2,"5",6,null,function funcionHola(param1,param2){ return param1+param2; }]; //esto es lo mismo que la linea anterior

nums[6](1,2); //acá nums[6] es igual a funcionHola

