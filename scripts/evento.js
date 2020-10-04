document.getElementById('prohibidas').style.display = 'none';
document.getElementById('comments').style.display = 'none';
document.getElementById('rol').style.display = 'none';

var obj = $("#comments").text().trim();
var comentarios = obj.split("\n");
var rol = $("#rol").text().trim();

if($("#comments").text() != ""){
    for(var i = 0; i < comentarios.length; i++){
        var comentario = "<div class=\"comentario\">";
        var cat = comentarios[i].split("\t");
        comentario += "<p class=\"nombre-comentario\"> <strong>" + cat[1] + "</strong>"; 
        if(rol!="1" && rol!="0"){
            comentario  += "<a href=\"borrar_comentario.php?id=" + cat[0]
                    + "\"><img class=\"icon\" src=/img/borrar.png /></a><a href=\"editar_comentario.php?id="+cat[0]+"\"><img class=\"icon\" src=/img/editar.png /></a>";
        }
        comentario += "</p><p class=\"fecha-comentario\"> <strong>" + cat[3] + " " + cat[4] + "</strong> </p>";
        comentario += "<p class=\"texto-comentario\">" + cat[2] + "</p>";
        if (cat[5] == "1"){
            comentario += "<p> <i> Mensaje editado por el moderador </i> <p>";
        }
        comentario += "<hr>";
        comentario += "</div>";
        
        document.getElementById('zona-comentarios').innerHTML += comentario;
    } 
}