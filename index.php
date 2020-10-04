<?php
   require_once "/usr/local/lib/php/vendor/autoload.php";
   require_once "bd.php";
   
   $loader = new \Twig\Loader\FilesystemLoader('templates');
   $twig = new \Twig\Environment($loader);
   
   session_start();

   $mysqli = conexionDB();

   $variablesParaTwig = [];

   if (isset($_SESSION['nickUsuario'])) {
        $variablesParaTwig['user'] = getUser($mysqli, $_SESSION['nickUsuario']);
    }
    else{
        $_SESSION['rol'] = 0;
    }

    $variablesParaTwig['rol'] = $_SESSION['rol'];

    $mysqli->close();
    
    echo $twig->render('index.html', $variablesParaTwig);
?>
