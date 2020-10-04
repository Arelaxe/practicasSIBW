<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";
    require_once "bd.php";
   
    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    $variablesParaTwig = [];

    session_start();

    $mysqli = conexionDB();

    if (isset($_GET['ev'])) {
        $idEv = $_GET['ev'];
        $_SESSION['Evento'] = $idEv;
    } else {
        $idEv = -1;
    }

    if (isset($_SESSION['nickUsuario'])) {
        $variablesParaTwig['user'] = getUser($mysqli, $_SESSION['nickUsuario']);
        $variablesParaTwig['rol'] = $_SESSION['rol'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $comentario = $_POST['comentario'];

            addComentario($mysqli, $comentario, $_SESSION['Evento']);

            header("Location: evento.php?ev=".$_SESSION['Evento']);
        }
    }
       
    $variablesParaTwig['evento'] = getEvento($idEv, $mysqli);
    $linea = getPalabrasProhibidas($mysqli);
    $comentarios = listaComentarios($mysqli, $idEv);

    echo $linea;
    echo $comentarios;
    
    $rol = "<div id=\"rol\">".$_SESSION['rol']."</div>";
    echo $rol;

    $mysqli->close();

    echo $twig->render('evento.html',$variablesParaTwig);
?>