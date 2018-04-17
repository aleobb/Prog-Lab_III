
var nums = [3,2,50,6,9,0];
console.log(nums); //para ver la consola en el navegador Chrome con F12
nums.sort(function(a,b){ return a<b; }) //ordena alfabeticamente (no ordena numeros sino que convierte nros a strings y los ordena). Por eso hay que pasar un parametro function
console.log(nums); 


//------------------------

var obj = {}; //asi declaro un objeto (con las llaves) y lo verifico haciendo un typeof: typeof(casa);

var casa = {
    dueño : "Mariano", // los atributos los separamos con coma
    num_habitacines: 10,
    demoler: function(){ this.num_habitacines = this.num_habitacines - 1; }

} //todo lo que esta en entre las llaves lo llamamos json

casa.num_baños = 3;
console.log(casa.dueño);
console.log(casa.num_baños); //se agrega asi el campo al objeto
console.log(typeof(casa) ) ;

console.log(casa);


