<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("bd.php");
   
    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    $mysqli = conexionDB();
    
    if (isset($_GET['ev'])) {
        $idEv = $_GET['ev'];
    } else {
        $idEv = -1;
    }
       
    $evento = getEvento($idEv,$mysqli);
    $mysqli->close();

    echo $twig->render('evento_imprimir.html',['evento' => $evento]);
?>