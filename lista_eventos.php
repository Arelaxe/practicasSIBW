<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";
    require_once "bd.php";
   
    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    session_start();

    $variablesparatwig['rol'] = $_SESSION['rol'];
    
    $mysqli = conexionDB();


    $mysqli->close();

    echo $twig->render('lista_eventos.html', $variablesparatwig);
?>