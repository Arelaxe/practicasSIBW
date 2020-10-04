document.getElementById('usuarios').style.display = 'none';

var obj = $("#usuarios").text().trim();
var usuarios = obj.split("\n");

var lista = "<ol>";

for(var i = 0; i < usuarios.length; i++){
    lista +="<li>";
    lista += usuarios[i];
    lista += "</li>";
}

lista += "</ol>";

document.getElementById('tabla-principal').innerHTML += lista;