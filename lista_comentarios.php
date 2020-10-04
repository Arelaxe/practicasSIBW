<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";
    require_once "bd.php";
   
    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    $mysqli = conexionDB();
       
    $codigo = getComentarios($mysqli);

    echo $codigo;

    $mysqli->close();

    echo $twig->render('lista_comentarios.html');
?>