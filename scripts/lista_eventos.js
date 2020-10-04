$(document).ready(function(){
    var busqueda;
    $("#texto_busqueda").focus();

    $("#texto_busqueda").keyup(function(e){
        busqueda = $("#texto_busqueda").val();

        $.ajax({
            data: {busqueda},
            url: 'busqueda.php',
            type: 'POST',
            error: function(resp){
                console.log('error');
            },
            success: function(respuesta) {
                procesaRepuestaAjax(respuesta);
            }
        });
    });
});


function procesaRepuestaAjax(respuesta) {
    document.getElementById("resultados_busqueda").innerHTML = "";
    res = "<ol>";
    
    for (i = 0; i < respuesta.length; i++) {
        res += "<li> <a href=\"/evento.php?ev=" + respuesta[i].id + "\">" + respuesta[i].nombre + "</a> </li>";
    }

    document.getElementById("resultados_busqueda").innerHTML = res;
}