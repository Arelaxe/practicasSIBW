function DespliegaMenu(){
    var cuadro_comentario = document.getElementById('panel-comentarios');

    if (cuadro_comentario.style.display=='block'){
        cuadro_comentario.style.display='none';
    }
    else{
        cuadro_comentario.style.display='block';
    }
}

function PalabrasCensuradas(){
    var obj = $("#prohibidas").text().trim();
    var censuradas = obj.split("\n");

    for(var i = 0; i < censuradas.length; i++){
        censuradas[i] = censuradas[i].trim();
    }
    var comentario = document.getElementById("comentario_enviado").value;

    for (var i=0; i<censuradas.length; i++){
        if (comentario.toLowerCase().includes(censuradas[i])){
            document.getElementById("comentario_enviado").value = document.getElementById("comentario_enviado").value.replace(censuradas[i],'*');
        }
    }
}