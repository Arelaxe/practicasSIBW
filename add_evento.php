<?php
   require_once "/usr/local/lib/php/vendor/autoload.php";
   require_once "bd.php";
   
   $loader = new \Twig\Loader\FilesystemLoader('templates');
   $twig = new \Twig\Environment($loader);

   $mysqli = conexionDB();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nombre = $_POST['nombre'];
        $lugar = $_POST['lugar'];
        $fecha = $_POST['fecha'];
        $descripcion = $_POST['descripcion'];
        $web = $_POST['web'];
        $facebook = $_POST['facebook'];
        $twitter = $_POST['twitter'];
        
        AddEvento($mysqli, $nombre, $lugar, $fecha, $descripcion, $web, $facebook, $twitter);

        header ("Location: lista_eventos.php");

        exit();
    }

    $mysqli->close();
    
    echo $twig->render('add_evento.html',[]);
?>