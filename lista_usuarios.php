<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";
    require_once "bd.php";
   
    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);
    
    $mysqli = conexionDB();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $usuario = $_POST['usuario'];
        $permisos = $_POST['permisos'];
        cambiarPermisos($mysqli, $usuario, $permisos);

        header ("Location: lista_usuarios.php");

       exit();
    }
       
    $codigo = getUsuarios($mysqli);

    echo $codigo;

    $mysqli->close();

    echo $twig->render('lista_usuarios.html');
?>