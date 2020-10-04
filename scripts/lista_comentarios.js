document.getElementById('comments').style.display = 'none';

var obj = $("#comments").text().trim();
var comentarios = obj.split("\n");

for(var i = 0; i < comentarios.length; i++){
    var comentario = "<div class=\"comentario\">";
    var cat = comentarios[i].split("\t");
    comentario += "<p class=\"nombre-comentario\"> <strong>" + cat[0] + "</strong> <a href=\"borrar_comentario.php?id="
                +cat[5]+"\"><img class=\"icon\" src=/img/borrar.png /></a><a href=\"editar_comentario.php?id="+cat[5]+"\"><img class=\"icon\" src=/img/editar.png /></a></p>";
    comentario += "<p class=\"fecha-comentario\"> <strong>" + cat[2] + " " + cat[3] + "</strong> </p>";
    comentario += "<p class=\"texto-comentario\">" + cat[1] + "</p>"
    if (cat[6] == "1"){
        comentario += "<p> <i> Mensaje editado por el moderador </i> <p>"
    }
    comentario += "<p> Comentario en el evento: " + cat[4] + "</p>";
    comentario += "<hr>";
    comentario += "</div>";
    
    document.getElementById('tabla-principal').innerHTML += comentario;
}    